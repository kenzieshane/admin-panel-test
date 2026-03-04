<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('qr_codes', function (Blueprint $table) {
          $table->id();
$table->foreignId('member_id')->constrained()->cascadeOnDelete();
$table->string('code')->unique();
$table->string('qr_image')->nullable();
$table->boolean('is_active')->default(true);
$table->timestamp('last_used_at')->nullable();
$table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('qr_codes');
    }
};
