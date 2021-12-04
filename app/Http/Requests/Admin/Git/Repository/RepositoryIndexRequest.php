<?php

namespace App\Http\Requests\Admin\Git\Repository;

use App\Http\Requests\BaseIndexRequest;
use App\Interfaces\Git\GitInterface;
use Illuminate\Validation\Rule;

class RepositoryIndexRequest extends BaseIndexRequest
{
    public function rules() : array
    {
        return array_merge(parent::rules(), [
            'repository_git_provider'   => [
                'nullable',
                Rule::in(GitInterface::SERVICES)
            ],
            'repository_is_private'     => 'nullable|boolean',
            'repository_name'           => 'nullable|string',
            'repository_name_alias'     => 'nullable|string',
        ]);
    }
}
