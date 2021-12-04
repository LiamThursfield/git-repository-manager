<?php

namespace App\Http\Requests\Admin\Git\Repository;

use App\Http\Requests\BaseRequest;

class RepositoryUpdateRequest extends BaseRequest
{
    public function rules() : array
    {
        return [
            'alias' => 'nullable|string|max:255',
        ];
    }
}
