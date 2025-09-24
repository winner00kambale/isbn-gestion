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
        Schema::create('modalites', function (Blueprint $table) {
            $table->id();
            $table->foreignId('code_promotion')->constrained('promotions');
            $table->foreignId('code_type')->constrained('type_frais');
            $table->string('montant');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('modalites');
    }
};
