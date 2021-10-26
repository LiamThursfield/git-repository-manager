<?php

namespace App\Http\Controllers\Webhook;

use App\Actions\Webhook\GithubWebhookAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Webhook\GithubWebhookRequest;
use Illuminate\Http\Response;

class GithubWebhookController extends Controller
{
    public function __invoke(GithubWebhookRequest $request): Response
    {
        return response([
            'message' => app(GithubWebhookAction::class)->handle($request)
        ]);
    }
}
