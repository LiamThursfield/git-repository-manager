<?php

namespace Tests\Unit\Git\Repository;

use App\Interfaces\GitInterface;
use App\Models\Git\Repository;
use App\Transformers\Git\Repository\GithubRepositoryTransformer;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class GithubRepositoryTest extends TestCase
{
    use RefreshDatabase;

    private string $repository_alias    = 'repository-name';
    private string $repository_html_url = 'https://github.com/Username/repository-name';
    private int|string $repository_id   = 123456789;
    private bool $repository_private    = false;
    private string $repository_name     = 'Username/repository-name';


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
        self::assertEquals($this->repository_html_url, $repository->html_url);
        self::assertEquals((string) $this->repository_id, $repository->id);
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
                'id' =>$this->repository_id
            ]
        );

    }


    /**
     * Mock the GitHub Webhook for a PullRequest
     * Note: This is only the data required to create a repository - no Pull Request, User, etc. data
     * @param array $data_override
     * @return Response
     */
    protected function mockGithubPullRequestWebhook(array $data_override = []): Response
    {
        Http::fake([
            '*' => Http::response(
                [
                    'repository' => [
                        'id'            => Arr::get($data_override, 'id', $this->repository_id),
                        'name'          => Arr::get($data_override, 'alias', $this->repository_alias),
                        'full_name'     => Arr::get($data_override, 'name', $this->repository_name),
                        'private'       => Arr::get($data_override, 'private', $this->repository_private),
                        'html_url'      => Arr::get($data_override, 'html_url', $this->repository_html_url),
                        'description'   => 'Description of the repo',
                    ]
                ]
            )
        ]);

        return Http::post('/webhook/github');
    }
}
