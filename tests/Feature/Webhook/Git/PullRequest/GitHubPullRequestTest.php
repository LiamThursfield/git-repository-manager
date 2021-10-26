<?php

namespace Tests\Feature\Webhook\Git\PullRequest;

use App\Interfaces\Git\GithubInterface;
use App\Interfaces\Git\GitInterface;
use App\Models\Git\PullRequest;
use App\Models\Git\Repository;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Tests\Traits\Git\BuildsGithubPullRequestWebhook;

class GitHubPullRequestTest extends TestCase
{
    use RefreshDatabase;
    use BuildsGithubPullRequestWebhook;

    /**
     * @test
     */
    public function a_github_pull_request_webhook_request_can_be_accepted()
    {
        // This is simply to ensure the endpoint exists and can accept a PR webhook
        $response = $this->receiveGithubPullRequestWebhook();
        $response->assertStatus(200);
    }

    /**
     * @test
     */
    public function a_github_pull_request_webhook_request_creates_a_repository_if_needed()
    {
        $this->receiveGithubPullRequestWebhook();

        $this->assertDatabaseHas(
            Repository::class,
            [
                'git_id'        => $this->repository_id,
                'git_provider'  => GitInterface::SERVICE_GITHUB,
                'name'          => $this->repository_name,
            ]
        );
    }


    /** @test */
    public function a_github_pull_request_webhook_request_wont_create_a_repository_if_not_needed()
    {
        Repository::create([
            'git_id'        => $this->repository_id,
            'git_provider'  => GitInterface::SERVICE_GITHUB,
            'name'          => $this->repository_name,
        ]);

        $this->receiveGithubPullRequestWebhook();

        $this->assertDatabaseCount(Repository::class, 1);
    }


    /**
     * @test
     */
    public function a_github_pull_request_webhook_request_creates_a_pull_request_if_needed()
    {
        $this->receiveGithubPullRequestWebhook();

        $repository = Repository::where([
            'git_id'        => $this->repository_id,
            'git_provider'  => GitInterface::SERVICE_GITHUB,
        ])->first();

        $this->assertDatabaseHas(
            PullRequest::class,
            [
                'git_id'            => $this->pull_request_id,
                'git_repository_id' => $repository->id,
            ]
        );
    }


    /** @test */
    public function a_github_pull_request_webhook_request_wont_create_a_pull_request_if_not_needed()
    {
        // Receive a webhook for a closed pull request
        $this->receiveGithubPullRequestWebhook([
            'pull_request' => [
                'state' => GithubInterface::PULL_REQUEST_STATE_CLOSED
            ]
        ]);

        // Receive a webhook for the same pull request, but now open
        $this->receiveGithubPullRequestWebhook([
            'pull_request' => [
                'state' => GithubInterface::PULL_REQUEST_STATE_CLOSED
            ]
        ]);

        $this->assertDatabaseCount(PullRequest::class, 1);
    }

}
