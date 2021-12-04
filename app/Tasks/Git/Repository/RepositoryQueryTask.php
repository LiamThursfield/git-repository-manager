<?php

namespace App\Tasks\Git\Repository;

use App\Models\Git\Repository;
use App\Tasks\AbstractQueryTask;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Arr;

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

    protected function addCustomSearchOptions()
    {
        if ($this->isSearchOptionsValueSet('repository_name_alias')) {
            $this->query->where(function (Builder $sub_query) {
                $name_alias = Arr::get($this->search_options, 'repository_name_alias');

                $sub_query->where(
                    'name',
                    'LIKE',
                    '%' . $name_alias . '%'
                )->orWhere(
                    'alias',
                    'LIKE',
                    '%' . $name_alias . '%'
                );
            });
        }

    }

    protected function getQueryBuilder(): Builder
    {
        return Repository::query();
    }
}
