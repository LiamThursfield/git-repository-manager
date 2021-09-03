<?php

namespace App\Http\Requests\Admin\Profile;

use App\Http\Requests\BaseRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class ProfileUpdateRequest extends BaseRequest
{
    public function rules() : array
    {
        return [
            'email'             => [
                'required',
                'email',
                Rule::unique('users')->ignore(Auth::id(), 'id'),
            ],
            'first_name'        => 'required|string|max:255',
            'github_username'   => 'nullable|string|max:255',
            'last_name'         => 'required|string|max:255',
        ];
    }

}
