<?php

namespace App\Transformers\Git\Repository;

use App\Interfaces\GitInterface;
use Illuminate\Support\Arr;

class GithubRepositoryTransformer extends AbstractRepositoryTransformer
{

    public function getAlias(): ?string
    {
        return (string) Arr::get($this->raw_data, 'name');
    }

    public function getGitProvider(): string
    {
        return GitInterface::SERVICE_GITHUB;
    }

    public function getGitProviderId(): string
    {
        return (string) Arr::get($this->raw_data, 'id');
    }

    public function getHtmlUrl(): string
    {
        return Arr::get($this->raw_data, 'html_url');
    }

    public function getIsPrivate(): bool
    {
        return (bool) Arr::get($this->raw_data, 'private');
    }

    public function getName(): string
    {
        return (string) Arr::get($this->raw_data, 'full_name');
    }
}
