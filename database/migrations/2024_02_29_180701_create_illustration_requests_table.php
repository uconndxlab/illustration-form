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
        Schema::create('illustration_requests', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->enum('is_journal_cover_request', ['no_paid', 'yes_free']);
            $table->string('journal_name')->nullable();
            $table->string('description');
            $table->boolean('has_deadline');
            $table->date('date_deadline')->nullable();
            $table->string('name');
            $table->string('email');                
            $table->string('phone');
            $table->string('kfs_account')->nullable();
            $table->boolean('has_references');
            $table->string('reference_path')->after('kfs_account')->nullable();
            //validation to be done in controller
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('illustration_requests');
    }
};
