<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddImageUriToBookposts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('book_posts', function (Blueprint $table) {
            $table->string('image_uri')->default('https://upload.wikimedia.org/wikipedia/commons/1/1b/Square_200x200.png');;
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('book_posts', function (Blueprint $table) {
            $table->dropColumn('image_uri');
        });
    }
}
