<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGroupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('groups', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 64);
            $table->string('description');
            $table->boolean('public')->default(1); // Is this group open/visible to all?
            $table->timestamps();

            $table->unique('name');
            $table->index('public');

            $table->engine = 'InnoDB';
        });

        DB::statement('ALTER TABLE `groups` ADD FULLTEXT name_description_fulltext (`name`, `description`)');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('groups');
    }
}
