<?php

namespace App\Models\Git;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property string $id
 * @property string $name
 * @property string $alias
 * @property string $git_provider
 * @property bool $is_private
 * @property string $html_url
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property Carbon $deleted_at
 */
class Repository extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'git_repositories';

    protected $guarded = [];

    protected $casts = [
        'is_private' => 'boolean',
    ];


    public function pullRequests(): HasMany
    {
        return $this->hasMany(PullRequest::class);
    }
}
