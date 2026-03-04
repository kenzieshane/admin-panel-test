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
        Schema::create('members', function (Blueprint $table) {
$table->id();
$table->string('member_code')->unique();
$table->string('name');
$table->string('email')->unique();
$table->string('phone');
$table->text('address')->nullable();
$table->date('date_of_birth')->nullable();
$table->enum('gender', ['male', 'female']);
$table->string('photo')->nullable();
$table->date('membership_start');
$table->date('membership_end');
$table->enum('status', ['active', 'inactive', 'suspended'])->default('active');
$table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('members');
    }
};
