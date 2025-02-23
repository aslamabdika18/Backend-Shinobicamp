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
        Schema::create('atlets', function (Blueprint $table) {
            $table->id();
            $table->foreignId('team_id')->constrained()->cascadeOnDelete();
            $table->string('fullname');
            $table->date('birth_date');
            $table->string('martial_art_style');
            $table->enum('gender', ['male', 'female']);
            $table->decimal('weight');
            $table->string('ktp');
            $table->string('photo');
            $table->string('health_file');
            $table->string('birth_file');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('atlets');
    }
};
