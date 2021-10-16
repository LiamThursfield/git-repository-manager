<?php

namespace App\Models\Git;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property int $id
 * @property string $git_provider_id
 * @property string $git_repository_id
 * @property string $title
 * @property string $branch_head
 * @property string $branch_base
 * @property string $state
 * @property string $html_url
 * @property string $git_user_username
 * @property int $user_id
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property Carbon $deleted_at
 */
class PullRequest extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'git_pull_requests';

    protected $guarded = [];

    public function repository(): BelongsTo
    {
        return $this->belongsTo(Repository::class);
    }
}
