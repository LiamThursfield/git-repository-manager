<?php

namespace Database\Factories;

use App\Interfaces\Git\GitInterface;
use App\Models\Git\Repository;
use Illuminate\Database\Eloquent\Factories\Factory;

class GitRepositoryFactory extends Factory
{
    protected $model = Repository::class;

    public function definition(): array
    {
        $name = ucwords($this->faker->domainWord . ' ' . $this->faker->domainWord);

        return [
            'alias'         => $name,
            'git_id'        => $this->faker->numberBetween(333333333),
            'git_provider'  => $this->faker->randomElement(GitInterface::SERVICES),
            'html_url'      => $this->faker->url,
            'is_private'    => $this->faker->boolean,
            'name'          => $name,
        ];
    }
}
