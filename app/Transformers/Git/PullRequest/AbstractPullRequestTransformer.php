<?php

namespace App\Transformers\Git\PullRequest;

use App\Models\Git\PullRequest;

abstract class AbstractPullRequestTransformer
{
    protected array $raw_data;

    public function __construct(array $raw_data)
    {
        $this->raw_data = $raw_data;
    }


    public function transform(): PullRequest
    {
        return new PullRequest([
            'branch_base'       => $this->getBranchBase(),
            'branch_head'       => $this->getBranchHead(),
            'git_id'            => $this->getGitId(),
            'git_user_username' => $this->getGitUserUserName(),
            'html_url'          => $this->getHtmlUrl(),
            'state'             => $this->getState(),
            'title'             => $this->getTitle(),
        ]);
    }


    public function setData(array $data)
    {
        $this->raw_data = $data;
    }


    abstract public function getBranchBase(): string;
    abstract public function getBranchHead(): string;
    abstract public function getGitId(): string;
    abstract public function getGitUserUserName(): string;
    abstract public function getHtmlUrl(): ?string;
    abstract public function getState(): string;
    abstract public function getTitle(): string;
}
