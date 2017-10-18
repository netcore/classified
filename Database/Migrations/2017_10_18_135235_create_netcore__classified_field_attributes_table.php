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
        Schema::create('netcore_classified__field_attributes', function (Blueprint $table) {
            $table->increments('id');
            $table->boolean('is_active')->default(1);
            $table->integer('field_id')->unsigned();
            $table->string('value')->nullable();

            $table->timestamps();

            $table->foreign('field_id', 'field_id')
                ->references('id')
                ->on('netcore_classified__fields')
                ->onDelete('cascade');
        });

        Schema::create('netcore_classified__field_attribute_translations', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('field_attribute_id');
            $table->string('name');
            $table->string('locale', 2)->index();
            $table->softDeletes();

            $table->foreign('field_attribute_id', 'field_attribute_id')
                ->references('id')
                ->on('netcore_classified__field_attributes')
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
        Schema::dropIfExists('netcore_classified__field_attribute_translations');
        Schema::dropIfExists('netcore_classified__field_attributes');
    }
}
