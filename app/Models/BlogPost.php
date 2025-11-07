<?php
// app/Models/BlogPost.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Support\Str;

class BlogPost extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'excerpt',
        'content',
        'featured_image',
        'author_name',
        'author_avatar',
        'category',
        'status',
        'is_featured',
        'view_count',
        'reading_time',
        'tags',
        'user_id',
        'published_at',
        'approval_status',
        'rejection_reason',
        'approved_at',
        'approved_by'
    ];

    protected $casts = [
        'tags' => 'array',
        'published_at' => 'datetime',
        'approved_at' => 'datetime',
        'is_featured' => 'boolean',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function approvedBy()
    {
        return $this->belongsTo(User::class, 'approved_by');
    }

    // Scope untuk posts yang approved dan published
    public function scopePublished($query)
    {
        return $query->where('status', 'published')
                    ->where('approval_status', 'approved')
                    ->whereNotNull('published_at')
                    ->where('published_at', '<=', now());
    }

    public function scopePendingApproval($query)
    {
        return $query->where('approval_status', 'pending')
                    ->where('status', 'published');
    }

    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    public function scopeByCategory($query, $category)
    {
        return $query->where('category', $category);
    }

    public function scopeByUser($query, $userId)
    {
        return $query->where('user_id', $userId);
    }

    // Accessor untuk reading time
    protected function readingTime(): Attribute
    {
        return Attribute::make(
            get: function ($value) {
                if ($value) return $value;
                
                $wordCount = str_word_count(strip_tags($this->content));
                return max(1, ceil($wordCount / 200));
            }
        );
    }

    // Method untuk generate excerpt jika tidak ada
    public function getExcerptAttribute($value)
    {
        if ($value) return $value;
        
        return Str::limit(strip_tags($this->content), 150);
    }

    // Method untuk check jika post bisa diedit oleh user
    public function canEdit($user)
    {
        return $user && ($user->id === $this->user_id || $user->role === 'admin');
    }

    // Method untuk approve post
    public function approve($approvedBy)
    {
        $this->update([
            'approval_status' => 'approved',
            'approved_at' => now(),
            'approved_by' => $approvedBy->id,
            'status' => 'published',
            'published_at' => now()
        ]);
    }

    // Method untuk reject post
    public function reject($rejectedBy, $reason)
    {
        $this->update([
            'approval_status' => 'rejected',
            'rejection_reason' => $reason,
            'approved_by' => $rejectedBy->id,
            'status' => 'draft'
        ]);
    }
}