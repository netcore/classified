<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNetcoreClassifiedFieldsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('netcore_classified__parameters', function (Blueprint $table) {
            $table->increments('id');
            $table->boolean('is_active')->default(1);
            $table->string('type');
            $table->string('options')->default(json_encode([]));
            $table->string('input')->index();
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('netcore_classified__parameter_translations', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('parameter_id');
            $table->string('locale', 2)->index();
            $table->string('name');
            $table->softDeletes();

            $table->foreign('parameter_id')
                ->references('id')
                ->on('netcore_classified__parameters')
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
        Schema::dropIfExists('netcore_classified__parameter_translations');
        Schema::dropIfExists('netcore_classified__parameters');
    }
}
