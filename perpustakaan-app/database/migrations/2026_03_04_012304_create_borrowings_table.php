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
        Schema::create('borrowings', function (Blueprint $table) {
$table->id();
$table->string('borrowing_code')->unique();
$table->foreignId('member_id')->constrained()->cascadeOnDelete();
$table->foreignId('book_id')->constrained()->cascadeOnDelete();
$table->foreignId('borrowed_by')->nullable()->constrained('users');
$table->date('borrowed_date');
$table->date('due_date');
$table->date('returned_date')->nullable();
$table->enum('status', ['borrowed', 'returned', 'overdue', 'lost'])->default('borrowed');
$table->text('notes')->nullable();
$table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('borrowings');
    }
};
