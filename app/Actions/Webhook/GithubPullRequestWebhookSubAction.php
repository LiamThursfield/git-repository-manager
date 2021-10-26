<?php

namespace App\Actions\Webhook;

use App\Http\Requests\Webhook\GithubWebhookRequest;
use App\Interfaces\Git\GithubInterface;
use App\Models\Git\Repository;
use App\Transformers\Git\Repository\GithubRepositoryTransformer;
use Exception;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class GithubPullRequestWebhookSubAction
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
        $this->validateRequest();

        $repository = $this->findOrCreateRepository();

        return 'Success';
    }


    protected function findOrCreateRepository(): Repository
    {
        $transformer = new GithubRepositoryTransformer(Arr::get(request(), 'repository'));
        $repository = $transformer->transform();

        return Repository::firstOrCreate(
            [
                'git_id' => $repository->git_id,
                'git_provider' => $repository->git_provider
            ],
            $repository->toArray()
        );
    }


    /**
     * @throws ValidationException
     */
    protected function validateRequest()
    {
        Validator::make(
            $this->request->validated(),
            [
                'action'        => 'required',
                'pull_request'  => 'required|array',
                'repository'    => 'required|array',
            ]
        )->validate();
    }
}
