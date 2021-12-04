<?php

namespace App\Http\Resources\Admin\Git;

use Illuminate\Http\Resources\Json\JsonResource;

class RepositoryResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id'                    => $this->id,
            'git_id'                => $this->git_id,
            'name'                  => $this->name,
            'alias'                 => $this->alias,
            'git_provider'          => $this->git_provider,
            'human_readable_name'   => $this->human_readable_name,
            'is_private'            => $this->is_private,
            'html_url'              => $this->html_url,
        ];
    }
}
