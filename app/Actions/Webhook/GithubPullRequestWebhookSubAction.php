<?php

namespace App\Actions\Webhook;

use App\Http\Requests\Webhook\GithubWebhookRequest;
use App\Models\Git\PullRequest;
use App\Models\Git\Repository;
use App\Models\User;
use App\Transformers\Git\PullRequest\GithubPullRequestTransformer;
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
        $pull_request = $this->findOrCreatePullRequest($repository);

        if (is_null($pull_request->user_id)) {
            $user = $this->attemptToAttachUserToPullRequest($pull_request);
        }

        return 'Success';
    }


    protected function attemptToAttachUserToPullRequest(PullRequest $pull_request): ?User
    {
        if (is_null($pull_request->git_user_username)) {
            return null;
        }

        $user = User::where('github_username', $pull_request->git_user_username)->first();
        if (is_null($user)) {
            return null;
        }

        $pull_request->user_id = $user->id;
        $pull_request->save();

        return $user;
    }


    protected function findOrCreatePullRequest(Repository $repository): PullRequest
    {
        $transformer = new GithubPullRequestTransformer(Arr::get($this->request, 'pull_request'));
        $pull_request = $transformer->transform();

        return PullRequest::firstOrCreate(
            [
                'git_id' => $pull_request->git_id,
                'git_repository_id' => $repository->id
            ],
            array_merge(
                ['git_repository_id' => $repository->id],
                $pull_request->toArray()
            )
        );
    }


    protected function findOrCreateRepository(): Repository
    {
        $transformer = new GithubRepositoryTransformer(Arr::get($this->request, 'repository'));
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
