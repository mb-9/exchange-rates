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
        Schema::table('countries', function (Blueprint $table) {
            $table->string('commonName')->nullable()->change();
            $table->string('capital')->nullable()->change();
            $table->string('currencySymbol')->nullable()->change();
            $table->string('currencyCode')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('countries', function (Blueprint $table) {
            $table->string('commonName')->change();
            $table->string('capital')->change();
            $table->string('currencySymbol')->change();
            $table->string('currencyCode')->change();
        });
    }
};
