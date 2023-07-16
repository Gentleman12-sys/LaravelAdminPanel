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
        Schema::create('c_o_m_p_a_n_y_s', function (Blueprint $table) {
            $table->id();
            $table->char('name', 100);
            $table->char('region', 100);
            $table->char('phone', 100);
            $table->char('status', 100);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('c_o_m_p_a_n_y_s');
    }
};
