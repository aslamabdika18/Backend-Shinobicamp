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
        Schema::create('classcamps', function (Blueprint $table) {
            $table->id();
            $table->foreignId('event_id')->constrained()->cascadeOnDelete();
            $table->foreignId('categorycamp_id')->constrained()->cascadeOnDelete();
            $table->string('name');
            $table->enum('type', ['kata', 'kumite']);
            $table->date('minage');
            $table->date('maxage');
            $table->decimal('minweight');
            $table->decimal('maxweight');
            $table->enum('gender', ['male', 'female']);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('classcamps');
    }
};
