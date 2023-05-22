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
        Schema::create('server_applications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('server_id');
            $table->string('key')->nullable(false);
            $table->string('url')->nullable(false);
            $table->boolean('ssl_verify')->nullable(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('server_applications');
    }
};
