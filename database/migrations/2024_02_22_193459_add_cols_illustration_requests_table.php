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
        Schema::table('illustration_requests', function (Blueprint $table) {
            //required
            $table->enum('journal_cover_request', ['no_paid', 'yes_free']);
            $table->longText('description')->after('journal_name');
            $table->boolean('has_deadline')->after('description');
            $table->date('date_deadline')->after('has_deadline')->nullable($value = true); //when deadline == yes
            $table->string('name', 100)->after('date_deadline');
            $table->string('email', 320)->after('name');
            $table->string('phone', 15)->after('email');
            $table->string('kfs_account', 30)->after('phone')->nullable($value = true); //don't know length

            $table->string('journal_name', 160)->after('journal_cover_request');

            //storing files
            $table->string('reference_path', 100)->after('kfs_account'); //dependent on id()
            //TODO - think about how references are stored/named, do we need more columns? 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
