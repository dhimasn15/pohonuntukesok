<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Schema;

class Donation extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'campaign_id',
        'amount',
        'status',
        // jika Anda punya kolom jumlah pohon di donations, tambahkan nama kolomnya seperti 'trees' atau 'quantity'
        'trees',
        'xendit_invoice_id',
        'external_id',
        'status',
        'donor_name',
        'donor_email',
        'message',
        'paid_at',
        'trees_count', // ensure trees_count can be mass assigned
    ];

    protected $attributes = [
        'trees_count' => 1,
        'status' => 'pending',
    ];

    protected $casts = [
        'amount' => 'decimal:2',
        'paid_at' => 'datetime',
        'trees_count' => 'integer',
    ];

    /**
     * Table name (optional if follows convention)
     */
    protected $table = 'donations';

    // Relationship to Campaign
    public function campaign(): BelongsTo
    {
        return $this->belongsTo(Campaign::class);
    }

    // Optional relation to FarmerPlant (if your schema has it)
    public function farmerPlant(): BelongsTo
    {
        return $this->belongsTo(FarmerPlant::class, 'farmer_plant_id');
    }

    /**
     * Mark donation as paid and update campaign progress.
     * Idempotent — safe to call multiple times.
     */
    public function markAsPaid()
    {
        // If already paid, do nothing
        if ($this->status === 'paid') {
            return $this;
        }

        return DB::transaction(function () {
            // Reload with lock to avoid race conditions
            $this->refresh();

            // Protect against concurrent processing
            $this->status = 'paid';
            if (property_exists($this, 'paid_at')) {
                $this->paid_at = now();
            }
            $this->save();

            // Update campaign counts with row lock
            $campaign = $this->campaign()->lockForUpdate()->first();

            if ($campaign) {
                // Ensure trees_count is an integer
                $inc = intval($this->trees_count ?: 0);
                if ($inc > 0) {
                    $campaign->increment('current_trees', $inc);
                }

                // Increment donors by 1 (or more complex logic if needed)
                $campaign->increment('total_donors', 1);

                // Recalculate percentage only if campaign stores it
                $attrs = $campaign->getAttributes();
                // prefer common field names total_trees or target_trees
                $total = $campaign->total_trees ?? $campaign->target_trees ?? null;

                if ($total && $total > 0 && array_key_exists('progress_percentage', $attrs)) {
                    // recompute using fresh value
                    $campaign->refresh();
                    $percent = ($campaign->current_trees / $total) * 100;
                    $campaign->progress_percentage = min(100, round($percent, 2));
                    $campaign->save();
                }
            }

            // Create FarmerPlantOrder if donation is tied to a farmer plant
            try {
                if ($this->farmerPlant) {
                    \Log::debug("Creating FarmerPlantOrder for donation {$this->id}");
                    \App\Models\FarmerPlantOrder::create([
                        'farmer_id'     => $this->farmerPlant->farmer_id ?? null,
                        'plant_type_id' => $this->farmerPlant->plant_type_id ?? null,
                        'quantity'      => intval($this->trees_count ?: 0),
                        'donation_id'   => $this->id,
                        'status'        => 'pending',
                    ]);
                }
            } catch (\Throwable $e) {
                // don't break the transaction for non-critical order creation; log for debugging
                Log::error("Failed to create FarmerPlantOrder for donation {$this->id}: " . $e->getMessage());
            }

            Log::info("Donation marked as paid: {$this->id}, campaign updated: " . ($campaign->id ?? 'n/a'));

            return $this->fresh();
        });
    }

    protected static function booted()
    {
        // Pastikan event ditangani pada create/update/delete
        static::created(function (Donation $donation) {
            static::updateCampaignStats($donation);
        });

        static::updated(function (Donation $donation) {
            static::updateCampaignStats($donation);
        });

        static::deleted(function (Donation $donation) {
            static::updateCampaignStats($donation);
        });
    }

    protected static function updateCampaignStats(Donation $donation)
    {
        if (empty($donation->campaign_id)) {
            return;
        }

        $campaignId = $donation->campaign_id;

        // Daftar status yang dianggap "sukses" / terbayar -- sesuaikan bila berbeda
        $successStatuses = ['success','completed','paid','settlement','approved'];

        // Hitung total amount hanya untuk donasi sukses
        $totalAmount = DB::table('donations')
            ->where('campaign_id', $campaignId)
            ->whereIn('status', $successStatuses)
            ->sum('amount');

        // Hitung donor unik hanya untuk donasi sukses (user_id bisa null untuk guest)
        $totalDonors = DB::table('donations')
            ->where('campaign_id', $campaignId)
            ->whereIn('status', $successStatuses)
            ->whereNotNull('user_id')
            ->distinct('user_id')
            ->count('user_id');

        // Hitung pohon terkumpul:
        // 1) Jika tabel donations punya kolom 'trees' atau 'quantity' gunakan penjumlahan tersebut
        $treeFieldCandidates = ['trees','tree_count','quantity','jumlah_pohon'];
        $treesCollected = 0;
        foreach ($treeFieldCandidates as $field) {
            if (Schema::hasColumn('donations', $field)) {
                $treesCollected = DB::table('donations')
                    ->where('campaign_id', $campaignId)
                    ->whereIn('status', $successStatuses)
                    ->sum($field);
                break;
            }
        }

        // 2) Jika belum terhitung dan campaign punya tree_price, hitung dari amount / tree_price
        $campaign = DB::table('campaigns')->where('id', $campaignId)->first();
        if ($treesCollected == 0 && $campaign) {
            $treePrice = null;
            if (isset($campaign->tree_price) && $campaign->tree_price > 0) {
                $treePrice = $campaign->tree_price;
            } elseif (Schema::hasColumn('campaigns','tree_price') && isset($campaign->tree_price)) {
                $treePrice = $campaign->tree_price;
            }

            if ($treePrice && $treePrice > 0) {
                // floor supaya tidak melebihi jumlah uang yang tersedia
                $treesCollected = (int) floor($totalAmount / $treePrice);
            }
        }

        // Candidate columns di tabel campaigns untuk diupdate
        $update = [];

        $collectedCandidates = ['collected_amount','collected','terkumpul','amount_collected'];
        foreach ($collectedCandidates as $c) {
            if (Schema::hasColumn('campaigns', $c)) {
                $update[$c] = $totalAmount;
                break;
            }
        }

        $donorCandidates = ['donors_count','donor_count','total_donors','jumlah_donatur'];
        foreach ($donorCandidates as $c) {
            if (Schema::hasColumn('campaigns', $c)) {
                $update[$c] = $totalDonors;
                break;
            }
        }

        $treesCandidates = ['trees_collected','pohon_terkumpul','collected_trees','jumlah_pohon_terkumpul'];
        foreach ($treesCandidates as $c) {
            if (Schema::hasColumn('campaigns', $c)) {
                $update[$c] = $treesCollected;
                break;
            }
        }

        // Hitung persen progress jika campaign punya goal/target
        $goalCandidates = ['goal_amount','goal','target_amount','target','funding_goal'];
        $progressCandidates = ['progress_percent','progress','percentage','percent'];

        $goalValue = null;
        foreach ($goalCandidates as $c) {
            if (Schema::hasColumn('campaigns', $c)) {
                $goalValue = $campaign->{$c} ?? null;
                break;
            }
        }

        if ($goalValue && $goalValue > 0) {
            $percent = round(min(100, ($totalAmount / $goalValue) * 100), 2);
            foreach ($progressCandidates as $pc) {
                if (Schema::hasColumn('campaigns', $pc)) {
                    $update[$pc] = $percent;
                    break;
                }
            }
        }

        // Lakukan update jika ada kolom yang harus diubah
        if (!empty($update)) {
            DB::table('campaigns')->where('id', $campaignId)->update($update);
        }
    }
}
