<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCryptaMoonbotCorpPivotTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('crypta_seat_moonbot_corp_pivot', function (Blueprint $table) {
            $table->unsignedInteger('api_id');
            $table->bigInteger('corp_id');
            $table->primary(['api_id', 'corp_id']);
            $table->timestamps();

            $table->index('corp_id');

            $table->foreign('api_id')
                ->references('id')
                ->on('crypta_seat_moonbot_api')
                ->onDelete('cascade');

            $table->foreign('corp_id')
                ->references('corporation_id')
                ->on('corporation_infos')
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
        Schema::dropIfExists('crypta_seat_moonbot_corp_pivot');
    }
}
