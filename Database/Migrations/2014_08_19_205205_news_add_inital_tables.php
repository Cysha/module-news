<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class NewsAddInitalTables extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('news_posts', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->integer('author_id')->unsigned();
            $table->string('title');
            $table->string('slug');
            $table->text('content')->nullable()->default(null);
            $table->tinyInteger('view_count')->default(0);
            $table->boolean('hide')->default(false);
            $table->timestamp('publish_at');

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
        Schema::drop('news_posts');
    }
}
