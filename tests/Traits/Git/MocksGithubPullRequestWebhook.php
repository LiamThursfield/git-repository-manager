<?php

namespace Tests\Traits\Git;

use App\Interfaces\Git\GithubInterface;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Http;

trait MocksGithubPullRequestWebhook
{
    /**
     * Default header values
     */
    private string $header_installation_target_type = GithubInterface::WEBHOOK_HEADER_INSTALLATION_TARGET_TYPE_REPOSITORY;
    private string $header_event                    = GithubInterface::WEBHOOK_HEADER_EVENT_PULL_REQUEST;

    /**
     * Default core values
     */
    private string $action = GithubInterface::WEBHOOK_PULL_REQUEST_ACTION_OPENED;

    /**
     * Default base branch values
     */
    private string $base_ref = 'main';

    /**
     * Default head branch values
     */
    private string $head_ref = 'feature/branch-name';

    /**
     * Default pull request values
     */
    private string $pull_request_html_url   = 'https://github.com/Username/repository-name/pull/1';
    private int|string $pull_request_id     = 987654321;
    private string $pull_request_state      = GithubInterface::PULL_REQUEST_STATE_OPEN;
    private string $pull_request_title      = 'A pull request title';

    /**
     * Default repository values
     */
    private string $repository_alias        = 'repository-name';
    private string $repository_description  = 'A repository description';
    private string $repository_html_url     = 'https://github.com/Username/repository-name';
    private int|string $repository_id       = 123456789;
    private bool $repository_private        = false;
    private string $repository_name         = 'Username/repository-name';


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
                    'action'        => Arr::get($data_override, 'action', $this->action),
                    'base'          => [
                        'ref'   => Arr::get($data_override, 'base.ref', $this->base_ref),
                    ],
                    'head'          => [
                        'ref'   => Arr::get($data_override, 'head.ref', $this->head_ref),
                    ],
                    'pull_request'  => [
                        'html_url'  => Arr::get($data_override, 'pull_request.html_url', $this->pull_request_html_url),
                        'id'        => Arr::get($data_override, 'pull_request.id', $this->pull_request_id),
                        'state'     => Arr::get($data_override, 'pull_request.state', $this->pull_request_state),
                        'title'     => Arr::get($data_override, 'pull_request.title', $this->pull_request_title),
                    ],
                    'repository'    => [
                        'description'   => Arr::get($data_override, 'repository.description', $this->repository_description),
                        'full_name'     => Arr::get($data_override, 'repository.name', $this->repository_name),
                        'html_url'      => Arr::get($data_override, 'repository.html_url', $this->repository_html_url),
                        'id'            => Arr::get($data_override, 'repository.id', $this->repository_id),
                        'name'          => Arr::get($data_override, 'repository.alias', $this->repository_alias),
                        'private'       => Arr::get($data_override, 'repository.private', $this->repository_private),
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
