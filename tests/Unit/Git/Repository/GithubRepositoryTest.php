<?php

namespace Tests\Unit\Git\Repository;

use App\Interfaces\GitInterface;
use App\Transformers\Git\Repository\GithubRepositoryTransformer;
use Illuminate\Support\Arr;
use Tests\TestCase;

class GithubRepositoryTest extends TestCase
{
    private string $repository_alias    = 'repository-name';
    private string $repository_html_url = 'https://github.com/Username/repository-name';
    private int|string $repository_id   = 123456789;
    private bool $repository_private    = false;
    private string $repository_name     = 'Username/repository-name';


    /** @test */
    public function a_github_repository_webhook_can_be_transformed_to_a_repository_model()
    {
        // Build the request body
        $body = $this->getSampleGithubPullRequestWebhookBody();

        // Transform the data
        $transformer = new GithubRepositoryTransformer(Arr::get($body, 'repository'));
        $repository = $transformer->transform();

        // Assert model fields are correct
        self::assertEquals($this->repository_alias, $repository->alias);
        self::assertEquals(GitInterface::SERVICE_GITHUB, $repository->git_provider);
        self::assertEquals($this->repository_html_url, $repository->html_url);
        self::assertEquals((string) $this->repository_id, $repository->id);
        self::assertEquals($this->repository_private, $repository->is_private);
        self::assertEquals($this->repository_name, $repository->name);

    }


    /**
     * Essentially mocks the request body from the Github Webhook for PullRequest
     * Note: This is only the data required to create a repository
     * @return array
     */
    protected function getSampleGithubPullRequestWebhookBody(): array
    {
        return [
            "repository" => [
                "id"            => $this->repository_id,
                "name"          => $this->repository_alias,
                "full_name"     => $this->repository_name,
                "private"       => $this->repository_private,
                "html_url"      => $this->repository_html_url,
                "description"   => "Description of the repo",
            ]
        ];
    }
}
