<?php

namespace App\Models\Git;

use Carbon\Carbon;
use Database\Factories\GitRepositoryFactory;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property int $id
 * @property string $git_id
 * @property string $name
 * @property string $alias
 * @property string $git_provider
 * @property string $human_readable_name
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


    public function getHumanReadableNameAttribute(): string
    {
        return $this->alias ?? $this->name;
    }


    public function pullRequests(): HasMany
    {
        return $this->hasMany(PullRequest::class, 'git_repository_id');
    }


    protected static function newFactory(): Factory
    {
        return new GitRepositoryFactory();
    }
}
