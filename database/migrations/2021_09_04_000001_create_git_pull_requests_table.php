<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGitPullRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('git_pull_requests', function (Blueprint $table) {
            $table->id();
            $table->string('git_id');
            $table->foreignId('git_repository_id')
                ->constrained('git_repositories')
                ->onDelete('cascade');
            $table->string('title');
            $table->text('body');
            $table->string('branch_head');
            $table->string('branch_base');
            $table->string('state');
            $table->string('html_url')->nullable();
            $table->string('git_user_username');
            $table->foreignId('user_id')
                ->nullable()
                ->constrained()
                ->onDelete('cascade');
            $table->timestamps();
            $table->softDeletes();

            $table->unique(['git_repository_id', 'git_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('git_pull_requests');
    }
}
