<?php

namespace App\Http\Requests\Webhook;

use App\Http\Requests\BaseRequest;

class GithubWebhookRequest extends BaseRequest
{
    public function rules() : array
    {
        return array_merge(parent::rules(), [
            'action'        => 'nullable|string',
            'pull_request'  => 'nullable|array',
            'repository'    => 'nullable|array',
            'sender'        => 'nullable|array',
        ]);
    }
}
