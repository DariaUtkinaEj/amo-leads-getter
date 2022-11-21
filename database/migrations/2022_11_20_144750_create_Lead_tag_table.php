<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLeadTagTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lead_tag', function (Blueprint $table) {
            $table->id();
            $table->integer('lead_id');
            $table->integer('tag_id');
            $table->foreign('lead_id')
                ->references('id')
                ->on('lead')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreign('tag_id')
                ->references('id')
                ->on('tag')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lead_tag');
    }
}
