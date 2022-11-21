<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLeadCustomFieldValue extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lead_custom_field_value', function (Blueprint $table) {
            $table->id();
            $table->integer('lead_custom_field_id');
            $table->string('value');
            $table->foreign('lead_custom_field_id')
                ->references('id')
                ->on('lead_custom_field')
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
        Schema::dropIfExists('lead_custom_field_value');
    }
}
