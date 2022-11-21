<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLeadTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lead', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('price');
            $table->integer('responsible_user_id');
            $table->integer('group_id');
            $table->integer('status_id');
            $table->integer('pipeline_id');
            $table->integer('loss_reason_id')->nullable();
            $table->integer('source_id')->nullable();
            $table->integer('created_by');
            $table->integer('updated_by');
            $table->integer('closest_task_at')->nullable();
            $table->boolean('is_deleted')->default(false);
            $table->integer('score')->nullable();
            $table->integer('account_id');
            $table->boolean('is_price_modified_by_robot');
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
        Schema::dropIfExists('lead');
    }
}
