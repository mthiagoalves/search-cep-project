<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('addresses', function (Blueprint $table) {
            $table->id();
            $table->string('cep', 10)->unique();
            $table->string('public_place');
            $table->string('complement')->nullable();
            $table->string('urgh');
            $table->string('locality');
            $table->string('state_acronym', 2);
            $table->string('ibge', 10);
            $table->string('gia', 10)->nullable();
            $table->string('ddd', 5)->nullable();
            $table->string('siafi', 10)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('addresses');
    }
};
