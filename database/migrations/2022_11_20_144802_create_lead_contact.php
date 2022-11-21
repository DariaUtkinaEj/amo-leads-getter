<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLeadContact extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lead_contact', function (Blueprint $table) {
            $table->id();
            $table->integer('lead_id');
            $table->boolean('is_main')->nullable();
            $table->string('name', 255)->nullable();
            $table->string('first_name', 255)->nullable();
            $table->string('last_name', 255)->nullable();
            $table->integer('responsible_user_id')->nullable();
            $table->integer('group_id')->nullable();
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
            $table->integer('created_at')->nullable();
            $table->integer('updated_at')->nullable();
            $table->integer('closest_task_at')->nullable();
            $table->integer('account_id')->nullable();
            $table->boolean('is_unsorted')->default(false);
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
        Schema::dropIfExists('lead_contact');
    }
}
