<?php

namespace App\Actions\Webhook;

use App\Http\Requests\Webhook\GithubWebhookRequest;
use App\Interfaces\Git\GithubInterface;
use Exception;

class GithubWebhookAction
{
    protected GithubWebhookRequest $request;

    /**
     * @param GithubWebhookRequest $request
     * @return string
     * @throws Exception
     */
    public function handle(GithubWebhookRequest $request): string
    {
        $this->request = $request;

        $target_type = $this->getWebhookTargetType();
        switch ($target_type) {
            case GithubInterface::WEBHOOK_HEADER_INSTALLATION_TARGET_TYPE_REPOSITORY:
                return $this->processRepositoryWebhook();
            default:
                throw new Exception('Invalid target type: ' . $target_type ?? 'No target type specified');
        }
    }


    protected function getWebhookEvent(): ?string
    {
        return $this->request->header(GithubInterface::WEBHOOK_HEADER_KEY_EVENT);
    }


    protected function getWebhookTargetType(): ?string
    {
        return $this->request->header(GithubInterface::WEBHOOK_HEADER_KEY_TARGET_TYPE);
    }


    protected function processRepositoryWebhook(): string
    {
        $event = $this->getWebhookEvent();
        switch ($event) {
            case GithubInterface::WEBHOOK_HEADER_EVENT_PULL_REQUEST:
                return app(GithubPullRequestWebhookSubAction::class)->handle($this->request);
            default:
                throw new Exception('Invalid event: ' . $event ?? 'No event specified');
        }
    }
}
