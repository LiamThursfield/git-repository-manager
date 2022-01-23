<?php

namespace App\Http\Resources\Admin\Git;

use App\Http\Resources\Admin\User\UserEditResource;
use Illuminate\Http\Resources\Json\JsonResource;

class PullRequestResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'body'                  => $this->body,
            'branch_base'           => $this->branch_base,
            'branch_head'           => $this->branch_head,
            'git_id'                => $this->git_id,
            'git_repository'        => RepositoryResource::make($this->whenLoaded('repository')),
            'git_repository_id'     => $this->git_repository_id,
            'git_user_username'     => $this->git_user_user_name,
            'html_url'              => $this->html_url,
            'id'                    => $this->id,
            'title'                 => $this->title,
            'user'                  => UserEditResource::make($this->whenLoaded('user')),
            'user_id'               => $this->user_id,
        ];
    }
}
