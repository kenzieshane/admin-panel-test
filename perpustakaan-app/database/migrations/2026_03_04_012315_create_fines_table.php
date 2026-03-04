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
        Schema::create('fines', function (Blueprint $table) {
            $table->id();
$table->foreignId('borrowing_id')->constrained()->cascadeOnDelete();
$table->foreignId('member_id')->constrained()->cascadeOnDelete();
$table->decimal('amount', 10, 2);
$table->integer('days_late');
$table->decimal('daily_rate', 10, 2)->default(1000);
$table->enum('status', ['unpaid', 'paid', 'waived'])->default('unpaid');
$table->date('paid_date')->nullable();
$table->string('payment_method')->nullable();
$table->text('notes')->nullable();
$table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fines');
    }
};
