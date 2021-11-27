<?php

namespace App\Tasks\Git\Repository;

use App\Models\Git\Repository;
use App\Tasks\AbstractQueryTask;
use Illuminate\Database\Eloquent\Builder;

class RepositoryQueryTask extends AbstractQueryTask
{
    protected array $searchable_fields_likes = [
        'name' => 'repository_name',
    ];

    protected array $searchable_fields_equals = [
        'is_private' => 'repository_is_private',
        'git_provider' => 'repository_git_provider'
    ];

    protected string $order_by = 'name';

    protected function getQueryBuilder(): Builder
    {
        return Repository::query();
    }
}
