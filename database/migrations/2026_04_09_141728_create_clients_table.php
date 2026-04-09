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
        Schema::create('clients', function (Blueprint $table) {
            $table->id();// Авто нумерация
            $table->string('name');// Обязательна к заполнению
			$table->string('email')->unique();// не должен повторятся
			$table->string('phone')->nullable();// инзанчально пуст
			$table->integer('balance')->default(0);// По умолчанию 0 
			$table->timestamps();//Указывает время создания и время изменения
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clients');
    }
};
