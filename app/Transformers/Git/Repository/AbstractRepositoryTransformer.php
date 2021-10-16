<?php

namespace App\Transformers\Git\Repository;

use App\Models\Git\Repository;

abstract class AbstractRepositoryTransformer
{
    protected array $raw_data;

    public function __construct(array $raw_data)
    {
        $this->raw_data = $raw_data;
    }


    public function transform(): Repository
    {
        return new Repository([
            'alias'             => $this->getAlias(),
            'git_provider'      => $this->getGitProvider(),
            'git_provider_id'   => $this->getGitProviderId(),
            'html_url'          => $this->getHtmlUrl(),
            'is_private'        => $this->getIsPrivate(),
            'name'              => $this->getName(),
        ]);
    }


    public function setData(array $data)
    {
        $this->raw_data = $data;
    }


    abstract public function getAlias(): ?string;
    abstract public function getGitProvider(): string;
    abstract public function getGitProviderId(): string;
    abstract public function getHtmlUrl(): string;
    abstract public function getIsPrivate(): bool;
    abstract public function getName(): string;
}
