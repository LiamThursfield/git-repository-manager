<?php

namespace Tests\Unit\Git\PullRequest;

use App\Models\Git\PullRequest;
use App\Transformers\Git\PullRequest\GithubPullRequestTransformer;
use App\Transformers\Git\Repository\GithubRepositoryTransformer;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Arr;
use Tests\TestCase;
use Tests\Traits\Git\MocksGithubPullRequestWebhook;

class GithubPullRequestTest extends TestCase
{
    use RefreshDatabase;
    use MocksGithubPullRequestWebhook;


    /** @test */
    public function a_github_pull_request_webhook_can_be_transformed_to_a_pull_request_model()
    {
        // Mock the webhook and get the body data
        $response = $this->mockGithubPullRequestWebhook()->json();

        // Transform the data
        $transformer = new GithubPullRequestTransformer(Arr::get($response, 'pull_request'));
        $pull_request = $transformer->transform();

        // Assert the model fields are correct
        self::assertEquals($this->pull_request_base_ref, $pull_request->branch_base);
        self::assertEquals($this->pull_request_head_ref, $pull_request->branch_head);
        self::assertEquals($this->pull_request_id, $pull_request->git_id);
        self::assertEquals($this->pull_request_user_login, $pull_request->git_user_username);
        self::assertEquals($this->pull_request_html_url, $pull_request->html_url);
        self::assertEquals($this->pull_request_state, $pull_request->state);
        self::assertEquals($this->pull_request_title, $pull_request->title);
    }


    /** @test */
    public function a_github_pull_request_webhook_can_create_a_pull_request()
    {
        // Mock the webhook and get the body data
        $response = $this->mockGithubPullRequestWebhook()->json();

        // Transform the repository data
        $transformer = new GithubRepositoryTransformer(Arr::get($response, 'repository'));
        $repository = $transformer->transform();

        // Transform the pull request data
        $transformer = new GithubPullRequestTransformer(Arr::get($response, 'pull_request'));
        $pull_request = $transformer->transform();

        // Store the repository and associated pull request
        $repository->save();
        $repository->pullRequests()->save($pull_request);

        // Assert the pull request was saved
        self::assertDatabaseHas(
            PullRequest::class,
            [
                'branch_base'       => $pull_request->branch_base,
                'branch_head'       => $pull_request->branch_head,
                'git_id'            => $pull_request->git_id,
                'git_repository_id' => $repository->id,
                'git_user_username' => $pull_request->git_user_username,
                'html_url'          => $pull_request->html_url,
                'state'             => $pull_request->state,
                'title'             => $pull_request->title,
            ]
        );
    }
}
