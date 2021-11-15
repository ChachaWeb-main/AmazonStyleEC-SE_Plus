<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCloumnsToUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            // 新しくユーザーの住所などの情報を保存するカラムを追加
            $table->string('postal_code')->default('');
            $table->text('address')->default('');
            $table->string('phone')->default('');
            // default('');を追加しているのは、あとから追加するカラムなどには、初期値などを指定する必要があるため
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
}
