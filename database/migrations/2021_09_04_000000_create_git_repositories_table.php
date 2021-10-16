<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGitRepositoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('git_repositories', function (Blueprint $table) {
            $table->id();
            $table->string('git_id');
            $table->string('name');
            $table->string('alias')->nullable();
            $table->string('git_provider');
            $table->boolean('is_private')->default(false);
            $table->string('html_url')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->unique(['git_provider', 'git_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('git_repositories');
    }
}
