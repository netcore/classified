<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNetcoreClassifiedCategoryParameterTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (config('netcore.module-classified.parameters.attach_to_categories')) {
            Schema::create('netcore_classified__category_parameter', function (Blueprint $table) {
                $table->unsignedInteger('category_id');
                $table->unsignedInteger('parameter_id');

                $table->foreign('category_id')->references('id')->on('netcore_category__categories')->onDelete('cascade');
                $table->foreign('parameter_id')->references('id')->on('netcore_classified__parameters')->onDelete('cascade');
            });
        }

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (config('netcore.module-classified.parameters.attach_to_categories')) {
            Schema::dropIfExists('netcore_classified__category_parameter');
        }
    }
}
