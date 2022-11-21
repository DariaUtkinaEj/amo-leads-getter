<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLeadCatalogElement extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lead_catalog_element', function (Blueprint $table) {
            $table->id();
            $table->integer('lead_id');
            $table->string('metadata')->nullable();
            $table->decimal('quantity')->nullable();
            $table->integer('catalog_id')->nullable();
            $table->integer('price_id')->nullable();
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
        Schema::dropIfExists('lead_catalog_element');
    }
}
