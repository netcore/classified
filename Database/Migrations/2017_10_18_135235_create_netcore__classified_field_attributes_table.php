<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNetcoreClassifiedFieldAttributesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('netcore_classified__parameter_attributes', function (Blueprint $table) {
            $table->increments('id');
            $table->boolean('is_active')->default(1);
            $table->integer('parameter_id')->unsigned();
            $table->string('value')->nullable();

            $table->timestamps();

            $table->foreign('parameter_id', 'parameter_id')
                ->references('id')
                ->on('netcore_classified__parameters')
                ->onDelete('cascade');
        });

        Schema::create('netcore_classified__parameter_attribute_translations', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('attribute_id');
            $table->string('name');
            $table->string('locale', 2)->index('locale');
            $table->softDeletes();

            $table->foreign('attribute_id', 'attribute_id')
                ->references('id')
                ->on('netcore_classified__parameter_attributes')
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
        Schema::dropIfExists('netcore_classified__parameter_attribute_translations');
        Schema::dropIfExists('netcore_classified__parameter_attributes');
    }
}
