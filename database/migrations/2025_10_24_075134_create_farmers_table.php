<?php
// database/migrations/2024_01_01_create_farmers_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFarmersTable extends Migration
{
    public function up()
    {
        Schema::create('farmers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('nama_lengkap');
            $table->string('nik', 16)->unique();
            $table->string('no_telepon', 15);
            $table->text('alamat_lengkap');
            $table->string('kecamatan');
            $table->string('kabupaten');
            $table->string('provinsi');
            $table->string('foto_ktp');
            $table->string('foto_diri');
            $table->text('pengalaman_bertani');
            $table->text('jenis_tanaman_dikuasai');
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');
            $table->text('catatan_admin')->nullable();
            $table->timestamp('approved_at')->nullable();
            $table->timestamps();
        });

        Schema::create('farmer_plants', function (Blueprint $table) {
            $table->id();
            $table->foreignId('farmer_id')->constrained()->onDelete('cascade');
            $table->string('jenis_tanaman');
            $table->integer('stok');
            $table->decimal('harga_per_pohon', 10, 2);
            $table->text('deskripsi')->nullable();
            $table->string('foto_tanaman')->nullable();
            $table->enum('status', ['tersedia', 'habis'])->default('tersedia');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('farmer_plants');
        Schema::dropIfExists('farmers');
    }
}