<?php

namespace Tests\Traits\Git;

use Illuminate\Http\Client\Response;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Http;

trait MocksGithubPullRequestWebhook
{
    private string $repository_alias    = 'repository-name';
    private string $repository_html_url = 'https://github.com/Username/repository-name';
    private int|string $repository_id   = 123456789;
    private bool $repository_private    = false;
    private string $repository_name     = 'Username/repository-name';


    /**
     * Mock the GitHub Webhook for a PullRequest
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
