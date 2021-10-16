<?php

namespace Tests\Unit\Git\Repository;

use App\Interfaces\GitInterface;
use App\Models\Git\Repository;
use App\Transformers\Git\Repository\GithubRepositoryTransformer;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Arr;
use Tests\TestCase;
use Tests\Traits\Git\MocksGithubPullRequestWebhook;

class GithubRepositoryTest extends TestCase
{
    use RefreshDatabase;
    use MocksGithubPullRequestWebhook;


    /** @test */
    public function a_github_repository_webhook_can_be_transformed_to_a_repository_model()
    {
        // Mock the webhook and get the body data
        $response = $this->mockGithubPullRequestWebhook()->json();

        // Transform the data
        $transformer = new GithubRepositoryTransformer(Arr::get($response, 'repository'));
        $repository = $transformer->transform();

        // Assert model fields are correct
        self::assertEquals($this->repository_alias, $repository->alias);
        self::assertEquals(GitInterface::SERVICE_GITHUB, $repository->git_provider);
        self::assertEquals((string) $this->repository_id, $repository->git_provider_id);
        self::assertEquals($this->repository_html_url, $repository->html_url);
        self::assertEquals($this->repository_private, $repository->is_private);
        self::assertEquals($this->repository_name, $repository->name);
    }


    /** @test */
    public function a_github_repository_webhook_can_create_a_repository()
    {
        // Mock the webhook and get the body data
        $response = $this->mockGithubPullRequestWebhook()->json();

        // Transform the data and save the model
        $transformer = new GithubRepositoryTransformer(Arr::get($response, 'repository'));
        $repository = $transformer->transform();
        $repository->save();

        // Assert the repository was saved
        self::assertDatabaseHas(
            Repository::class,
            [
                'alias'             => $this->repository_alias,
                'git_provider'      => GitInterface::SERVICE_GITHUB,
                'git_provider_id'   => $this->repository_id,
                'name'              => $this->repository_name,
            ]
        );
    }
}
