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
        //
        Schema::create('contacts', function (Blueprint $table) {
            $table->id();
            $table->string('type'); // Address, Phone, Email, etc.
            $table->string('details'); // The contact details
            $table->string('icon'); // Icon for the contact type (e.g., phone, mail)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        Schema::dropIfExists('contacts');
    }
};
