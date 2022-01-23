<?php

namespace App\Http\Controllers\Admin\Git;

use App\Actions\Git\Repository\RepositoryUpdateAction;
use App\Http\Controllers\AdminController;
use App\Http\Requests\Admin\Git\Repository\RepositoryIndexRequest;
use App\Http\Requests\Admin\Git\Repository\RepositoryUpdateRequest;
use App\Http\Resources\Admin\Git\PullRequestResource;
use App\Http\Resources\Admin\Git\RepositoryResource;
use App\Interfaces\AppInterface;
use App\Interfaces\Git\GitInterface;
use App\Interfaces\PermissionInterface;
use App\Models\Git\PullRequest;
use App\Models\Git\Repository;
use App\Tasks\Git\Repository\RepositoryQueryTask;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Inertia\Response;

class PullRequestController extends AdminController
{
    public function __construct()
    {
        parent::__construct();
        $this->addMetaTitleSection('Repositories');

        $this->middleware(
            PermissionInterface::getMiddlewareString(PermissionInterface::EDIT_PULL_REQUESTS)
        )->only(['edit', 'update']);

        $this->middleware(
            PermissionInterface::getMiddlewareString(PermissionInterface::VIEW_PULL_REQUESTS)
        )->only(['index', 'show']);
    }

    public function edit(PullRequest $pull_request): Response
    {
        $this->addMetaTitleSection('Edit - ' . $pull_request->title);
        $this->shareMeta();

        return Inertia::render('admin/git/pull_request/EditShow', [
            'isEdit'        => true,
            'pullRequest'    => function () use ($pull_request) {
                $pull_request->load('repository');

                PullRequestResource::withoutWrapping();
                return PullRequestResource::make($pull_request);
            },
        ]);
    }


    public function index(RepositoryIndexRequest $request): Response
    {
        $search_options = $request->validated();

        $this->shareMeta();

        return Inertia::render('admin/git/repository/Index', [
            'gitProviders' => GitInterface::SERVICES,
            'searchOptions' => $search_options,
        ]);
    }


    public function show(PullRequest $pull_request): Response
    {
        $this->addMetaTitleSection($pull_request->title);
        $this->shareMeta();

        return Inertia::render('admin/git/pull_request/EditShow', [
            'isEdit'        => false,
            'pullRequest'   => function () use ($pull_request) {
                $pull_request->load('repository');

                PullRequestResource::withoutWrapping();
                return PullRequestResource::make($pull_request);
            },
        ]);
    }


    public function update(RepositoryUpdateRequest $request, Repository $repository): RedirectResponse
    {
        app(RepositoryUpdateAction::class)->handle($repository, $request->validated());
        return Redirect::to(route('admin.git.repositories.edit', $repository))
            ->with('success', 'Repository updated.');
    }
}
