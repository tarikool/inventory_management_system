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
        Schema::create('receipts', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('amount');
            $table->string('buyer', 255);
            $table->string('receipt_id', 20);
            $table->string('items', 255);
            $table->string('buyer_email', 50);
            $table->string('buyer_ip', 20);
            $table->text('note');
            $table->string('city', 20);
            $table->string('phone', 20);
            $table->string('hash_key');
            $table->foreignId('entry_by')->constrained('users', 'id');
            $table->timestamp('entry_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('receipts');
    }
};
