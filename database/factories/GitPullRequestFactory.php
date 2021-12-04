<?php

namespace Database\Factories;

use App\Interfaces\Git\GithubInterface;
use App\Interfaces\Git\GitInterface;
use App\Models\Git\PullRequest;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class GitPullRequestFactory extends Factory
{
    protected $model = PullRequest::class;

    public function definition(): array
    {
        $git_user_username = $this->faker->userName;

        $user = null;
        if ($this->faker->boolean) {
            $user = User::factory([
                'github_username' => $git_user_username
            ])->create();
        }

        return [
            'branch_base'           => $this->faker->slug,
            'branch_head'           => $this->faker->slug,
            'git_id'                => $this->faker->numberBetween(333333333),
            'git_user_username'     => $git_user_username,
            'html_url'              => $this->faker->url,
            'state'                 => $this->faker->randomElement(GitInterface::PULL_REQUEST_STATES),
            'title'                 => $this->faker->sentence,
            'user_id'               => $user?->id,
        ];
    }
}
