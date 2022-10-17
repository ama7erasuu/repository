<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('requests', function (Blueprint $table) {
            $table->id();
            $table->string('name',250)->nullable(false)->comment('Имя пользователя');
            $table->string('email',250)->nullable(false)->comment('Email пользователя');
            $table->enum('status', ['Active','Resolved'])->nullable()->comment('Статус заявки Действущая/Решена');
            $table->string('message',500)->nullable(false)->comment('Сообщение пользователя');
            $table->string('comment',500)->nullable()->comment('Ответ ответственного лица');
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
        Schema::dropIfExists('requests');
    }
}
