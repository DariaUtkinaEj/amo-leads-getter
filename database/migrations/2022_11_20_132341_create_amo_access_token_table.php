<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateAmoAccessTokenTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('amo_access_token', function (Blueprint $table) {
            $table->id();
            $table->string('access_token', 1023);
            $table->integer('expires_at');
        });

        DB::table('amo_access_token')->insert([
            ['access_token' => env('AMO_INITIAL_ACCESS_TOKEN'), 'expires_at' => time()]
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('amo_access_token');
    }
}
