<?php

namespace Tests\Traits\Git;

use App\Interfaces\Git\GithubInterface;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Http;

trait MocksGithubPullRequestWebhook
{
    private string $header_installation_target_type = GithubInterface::WEBHOOK_HEADER_INSTALLATION_TARGET_TYPE_REPOSITORY;
    private string $header_event = GithubInterface::WEBHOOK_HEADER_EVENT_PULL_REQUEST;

    private string $repository_alias    = 'repository-name';
    private string $repository_html_url = 'https://github.com/Username/repository-name';
    private int|string $repository_id   = 123456789;
    private bool $repository_private    = false;
    private string $repository_name     = 'Username/repository-name';


    /**
     * Mock the GitHub Webhook for a PullRequest
     * @param array $data_override
     * @param int $status_code
     * @param array $headers_override
     * @return Response
     */
    protected function mockGithubPullRequestWebhook(
        array $data_override = [],
        int $status_code = 200,
        array $headers_override = []
    ): Response
    {
        Http::fake([
            '*' => Http::response(
                [
                    'repository' => [
                        'id'            => Arr::get($data_override, 'repository.id', $this->repository_id),
                        'name'          => Arr::get($data_override, 'repository.alias', $this->repository_alias),
                        'full_name'     => Arr::get($data_override, 'repository.name', $this->repository_name),
                        'private'       => Arr::get($data_override, 'repository.private', $this->repository_private),
                        'html_url'      => Arr::get($data_override, 'repository.html_url', $this->repository_html_url),
                        'description'   => 'Description of the repo',
                    ]
                ],
                $status_code,
                [
                    'x-github-hook-installation-target-type' => Arr::get($headers_override, 'installation_target_type', $this->header_installation_target_type),
                    'x-github-hook-event' => Arr::get($headers_override, 'event', $this->header_event),
                ]
            )
        ]);

        return Http::post('/webhook/github');
    }
}
