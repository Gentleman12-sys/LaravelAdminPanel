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
        Schema::create('i_f_p_s', function (Blueprint $table) {
            $table->id();
            $table->BigInteger('user_id');
            $table->longText('full_name');
            $table->char('email', 100);
            $table->char('service', 25);
            $table->char('status', 25);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('i_f_p_s');
    }
};
