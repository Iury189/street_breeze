<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fighter', function (Blueprint $table) {
            $table->id();
            $table->string('nome', 30);
            $table->string('arte_marcial', 50);
            $table->string('nacionalidade', 30);
            $table->enum('genero', ['Masculino', 'Feminino']);
            $table->decimal('altura', 3,2);
            $table->decimal('peso', 5,2);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('fighter');
    }
};
