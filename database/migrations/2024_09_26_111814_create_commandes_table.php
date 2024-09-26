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
        Schema::create('commandes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('client_id')->constrained('clients')->onDelete('cascade');
            $table->foreignId('offer_id')->constrained('offres')->onDelete('cascade');
            $table->enum('status', ['new', 'in_progress', 'awaiting', 'completed']);
            $table->integer('number_of_licenses')->unsigned(); // Rename if necessary to match requirements
            $table->text('description')->nullable();
            $table->string('os_type')->nullable();
            $table->boolean('extended_protection')->nullable();
            $table->boolean('encryption_protection')->nullable();
            $table->boolean('firewall')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('commandes');
    }
};
