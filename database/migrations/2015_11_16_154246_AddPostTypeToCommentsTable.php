<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPostTypeToCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('comments', function (Blueprint $table) {
            //Agrega columna post_type
            $table->string('post_type')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::table('comments', function (Blueprint $table) {
            //Quita columna post_type
            $table->dropColumn('post_type');
        });
    }
}
