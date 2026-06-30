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
        Schema::create('document_logs', function (Blueprint $table) {
            $table->id('id')->autoIncrement();
            $table->char('uuid', 36);
            $table->string('title');
            $table->string('sender');
            $table->unsignedBigInteger('sender_id');
            $table->string('sender_email');
            $table->string('sender_dept');
            $table->string('recipient')->nullable();
            $table->unsignedBigInteger('recipient_id')->nullable();
            $table->string('recipient_email')->nullable();
            $table->string('recipient_dept');
            $table->enum('communication', ['IC','EC']);
            $table->enum('status', ['Pending', 'Processing', 'Done','Returned'])->default('Pending');
            $table->char('remarks', 255)->nullable();
            $table->timestamps();


            $table->foreign('sender_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('uuid')->references('uuid')->on('documents')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('document_logs');
    }
};
