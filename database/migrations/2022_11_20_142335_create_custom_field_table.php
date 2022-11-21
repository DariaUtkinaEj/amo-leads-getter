<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomFieldTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lead_custom_field', function (Blueprint $table) {
            $table->id();
            $table->integer('lead_id');
            $table->integer('field_id')->nullable();
            $table->string('field_code')->nullable();
            $table->string('field_name')->nullable();
            $table->string('field_type', 255)->nullable();
            $table->foreign('lead_id')
                ->references('id')
                ->on('lead')
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
        Schema::dropIfExists('custom_field');
    }
}
