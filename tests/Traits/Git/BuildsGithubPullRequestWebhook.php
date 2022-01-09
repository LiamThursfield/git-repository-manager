<?php

namespace Tests\Traits\Git;

use App\Interfaces\Git\GithubInterface;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Http;
use Illuminate\Testing\TestResponse;

trait BuildsGithubPullRequestWebhook
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
     * Default pull request values
     */
    private string $pull_request_body       = 'A pull request body';
    private string $pull_request_base_ref   = 'main';
    private string $pull_request_head_ref   = 'feature/branch-name';
    private string $pull_request_html_url   = 'https://github.com/Username/repository-name/pull/1';
    private int|string $pull_request_id     = 987654321;
    private string $pull_request_state      = GithubInterface::PULL_REQUEST_STATE_OPEN;
    private string $pull_request_title      = 'A pull request title';
    private string $pull_request_user_login = 'GitHubUser';

    /**
     * Default repository values
     */
    private string $repository_alias        = 'repository-name';
    private string $repository_description  = 'A repository description';
    private string $repository_html_url     = 'https://github.com/Username/repository-name';
    private int|string $repository_id       = 123456789;
    private bool $repository_private        = false;
    private string $repository_name         = 'Username/repository-name';


    protected function buildGithubPullRequestData(array $data_override = []): array
    {
        return [
            'action'        => Arr::get($data_override, 'action', $this->action),
            'pull_request'  => [
                'body'      => Arr::get($data_override, 'pull_request.body', $this->pull_request_body),
                'html_url'  => Arr::get($data_override, 'pull_request.html_url', $this->pull_request_html_url),
                'id'        => Arr::get($data_override, 'pull_request.id', $this->pull_request_id),
                'state'     => Arr::get($data_override, 'pull_request.state', $this->pull_request_state),
                'title'     => Arr::get($data_override, 'pull_request.title', $this->pull_request_title),
                'base'      => [
                    'ref'   => Arr::get($data_override, 'pull_request_base.ref', $this->pull_request_base_ref),
                ],
                'head'      => [
                    'ref'   => Arr::get($data_override, 'pull_request_head.ref', $this->pull_request_head_ref),
                ],
                'user'      => [
                    'login' => Arr::get($data_override, 'pull_request_user.login', $this->pull_request_user_login),
                ],
            ],
            'repository'    => [
                'description'   => Arr::get($data_override, 'repository.description', $this->repository_description),
                'full_name'     => Arr::get($data_override, 'repository.name', $this->repository_name),
                'html_url'      => Arr::get($data_override, 'repository.html_url', $this->repository_html_url),
                'id'            => Arr::get($data_override, 'repository.id', $this->repository_id),
                'name'          => Arr::get($data_override, 'repository.alias', $this->repository_alias),
                'private'       => Arr::get($data_override, 'repository.private', $this->repository_private),
            ]
        ];
    }


    protected function buildGithubPullRequestHeaders(array $headers_override = []): array
    {
        return [
            GithubInterface::WEBHOOK_HEADER_KEY_TARGET_TYPE => Arr::get($headers_override, 'installation_target_type', $this->header_installation_target_type),
            GithubInterface::WEBHOOK_HEADER_KEY_EVENT => Arr::get($headers_override, 'event', $this->header_event),
        ];
    }


    /**
     * Fake the inbound GitHub Webhook request for a PullRequest
     * @param array $data_override
     * @param array $headers_override
     * @return TestResponse
     */
    protected function receiveGithubPullRequestWebhook(array $data_override = [], array $headers_override = []): TestResponse
    {
        return $this->post(
            route('webhook.github'),
            $this->buildGithubPullRequestData($data_override),
            $this->buildGithubPullRequestHeaders($headers_override)
        );
    }


    /**
     * Mock the GitHub Webhook request for a PullRequest
     * This is outbound from GitHub, not inbound to this app's webhook route
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
            'github.com/*' => Http::response(
                $this->buildGithubPullRequestData($data_override),
                $status_code,
                $this->buildGithubPullRequestHeaders($headers_override)
            )
        ]);

        return Http::post('github.com/pullrequest');
    }
}
