<?php

namespace Tests\Feature\Webhook\Git\PullRequest;

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
    public function a_github_webhook_request_can_be_accepted() {
        $response = $this->receiveGithubPullRequestWebhook();
        $response->assertStatus(200);
    }


}
