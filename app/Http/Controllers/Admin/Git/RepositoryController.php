<?php

namespace App\Http\Controllers\Admin\Git;

use App\Http\Controllers\AdminController;
use App\Http\Requests\Admin\Git\Repository\RepositoryIndexRequest;
use App\Http\Resources\Admin\Git\RepositoryResource;
use App\Interfaces\AppInterface;
use App\Interfaces\Git\GitInterface;
use App\Interfaces\PermissionInterface;
use App\Models\Git\Repository;
use App\Tasks\Git\Repository\RepositoryQueryTask;
use Inertia\Inertia;
use Inertia\Response;

class RepositoryController extends AdminController
{
    public function __construct()
    {
        parent::__construct();
        $this->addMetaTitleSection('Repositories');

        $this->middleware(
            PermissionInterface::getMiddlewareString(PermissionInterface::EDIT_REPOSITORIES)
        )->only(['edit', 'update']);

        $this->middleware(
            PermissionInterface::getMiddlewareString(PermissionInterface::VIEW_REPOSITORIES)
        )->only(['index', 'show']);
    }

    public function index(RepositoryIndexRequest $request): Response
    {
        $search_options = $request->validated();

        $this->shareMeta();

        return Inertia::render('admin/git/repository/Index', [
            'gitProviders' => GitInterface::SERVICES,
            'repositories' => function () use ($search_options) {
                return RepositoryResource::collection(
                    app(RepositoryQueryTask::class)
                        ->handle($search_options)
                        ->paginate(AppInterface::getSearchPaginationParam($search_options))
                );
            },
            'searchOptions' => $search_options,
        ]);
    }
}
