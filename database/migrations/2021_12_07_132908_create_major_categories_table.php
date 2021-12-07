<?php
// 親カテゴリのモデル

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMajorCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('major_categories', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name'); //親カテゴリの名前
            $table->text('description'); //親カテゴリの説明を保存
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
        Schema::dropIfExists('major_categories');
    }
}
