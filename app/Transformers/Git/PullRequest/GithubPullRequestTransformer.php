<?php

namespace App\Transformers\Git\PullRequest;

use Illuminate\Support\Arr;

class GithubPullRequestTransformer extends AbstractPullRequestTransformer
{
    public function getBranchBase(): string
    {
        return Arr::get($this->raw_data, 'base.ref');
    }

    public function getBranchHead(): string
    {
        return Arr::get($this->raw_data, 'head.ref');
    }

    public function getGitId(): string
    {
        return (string) Arr::get($this->raw_data, 'id');
    }

    public function getGitUserUserName(): string
    {
        return Arr::get($this->raw_data, 'user.login');
    }

    public function getHtmlUrl(): ?string
    {
        return Arr::get($this->raw_data, 'html_url');
    }

    public function getState(): string
    {
        return Arr::get($this->raw_data, 'state');
    }

    public function getTitle(): string
    {
        return Arr::get($this->raw_data, 'title');
    }
}
