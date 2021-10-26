<?php

namespace App\Actions\Webhook;

use App\Http\Requests\Webhook\GithubWebhookRequest;

class GithubWebhookAction
{
    public function handle(GithubWebhookRequest $request): string
    {
        return 'Success';
    }
}
