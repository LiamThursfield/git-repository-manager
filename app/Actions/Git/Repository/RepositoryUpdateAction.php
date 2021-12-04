<?php

namespace App\Actions\Git\Repository;

use App\Models\Git\Repository;

class RepositoryUpdateAction
{
    public function handle(Repository $repository, array $repository_data) : Repository
    {
        $repository->update($repository_data);
        return $repository;
    }
}
