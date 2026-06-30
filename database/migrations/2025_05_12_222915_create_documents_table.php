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
        Schema::create('documents', function (Blueprint $table) {
            $table->id()->autoIncrement()->primary();
            $table->char('uuid', 36)->unique();
            $table->string('title');
            $table->string('sender');
            $table->unsignedBigInteger('sender_id');
            $table->string('sender_email');
            $table->string('sender_dept');
            $table->string('recipient_dept');
            $table->enum('communication', ['IC','EC']);
            $table->timestamp('last_nudge_sent_at')->nullable();
            $table->timestamps();

            $table->foreign('sender_id')->references('id')->on('users')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('documents');
    }
};
