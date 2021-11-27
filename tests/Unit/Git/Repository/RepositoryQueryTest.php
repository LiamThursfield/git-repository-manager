<?php

namespace Tests\Unit\Git\Repository;

use App\Interfaces\Git\GitInterface;
use App\Models\Git\Repository;
use App\Tasks\Git\Repository\RepositoryQueryTask;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RepositoryQueryTest extends TestCase
{
    use RefreshDatabase;


    /** @test */
    public function repositories_can_be_queried_via_name()
    {
        $repository_names = [
            'repository one name',
            'repository two name',
            'repository three name',
            'repository four name',
        ];

        foreach ($repository_names as $name) {
            Repository::factory()->create(['name' => $name]);
        }

        // Assertions to try and catch all edge cases
        $assertions = [
            // search filter        => expected count
            'repository one name'   => 1, // Matches full
            'repo'                  => 4, // Matches start
            'tory t'                => 2, // Matches middle
            'tory th'               => 1, // Matches middle
            'ame'                   => 4, // Matches end
        ];

        foreach ($assertions as $search_filter => $expected_count) {
            $builder = app(RepositoryQueryTask::class)->handle(['repository_name' => $search_filter]);
            self::assertEquals($expected_count, $builder->count());
        }
    }


    /** @test */
    public function repositories_can_be_queried_via_privacy()
    {
        $private_repo_count = 3;
        $public_repo_count  = 7;

        Repository::factory()->count($private_repo_count)->create(['is_private' => true]);
        Repository::factory()->count($public_repo_count)->create(['is_private' => false]);

        // Assertions to try and catch all edge cases
        $assertions = [
            // Private Repositories
            [
                'search_filter'     => '1',
                'expected_count'    => $private_repo_count,
            ],
            [
                'search_filter'     => 1,
                'expected_count'    => $private_repo_count,
            ],
            [
                'search_filter'     => true,
                'expected_count'    => $private_repo_count,
            ],
            // Public Repositories
            [
                'search_filter'     => '0',
                'expected_count'    => $public_repo_count,
            ],
            [
                'search_filter'     => 0,
                'expected_count'    => $public_repo_count,
            ],
            [
                'search_filter'     => false,
                'expected_count'    => $public_repo_count,
            ],
            // All Repositories
            [
                'search_filter'     => '',
                'expected_count'    => $private_repo_count + $public_repo_count,
            ],
            [
                'search_filter'     => null,
                'expected_count'    => $private_repo_count + $public_repo_count,
            ],
        ];

        foreach ($assertions as $assertion) {
            $filter = $assertion['search_filter'];
            $expected = $assertion['expected_count'];

            $builder = app(RepositoryQueryTask::class)->handle(['repository_is_private' => $filter]);
            $actual = $builder->count();

            self::assertEquals(
                $expected,
                $actual,
                "Failed asserting privacy filter of ${filter} (" . gettype($filter) . ") - with count of ${actual} matches expected ${expected}."
            );
        }
    }


    /** @test */
    public function repositories_can_be_queried_vis_provider()
    {
        $bitbucket_repo_count = 1;
        $github_repo_count = 4;
        $gitlab_repo_count = 3;
        $total_repo_count = $bitbucket_repo_count + $github_repo_count + $gitlab_repo_count;

        Repository::factory()->count($bitbucket_repo_count)->create(['git_provider' => GitInterface::SERVICE_BITBUCKET]);
        Repository::factory()->count($github_repo_count)->create(['git_provider' => GitInterface::SERVICE_GITHUB]);
        Repository::factory()->count($gitlab_repo_count)->create(['git_provider' => GitInterface::SERVICE_GITLAB]);

        // Assertions to try and catch all edge cases
        $assertions = [
            // All Providers
            [
                'search_filter'     => '',
                'expected_count'    => $total_repo_count,
            ],
            [
                'search_filter'     => null,
                'expected_count'    => $total_repo_count,
            ],
            // Specific Providers
            [
                'search_filter'     => GitInterface::SERVICE_BITBUCKET,
                'expected_count'    => $bitbucket_repo_count,
            ],
            [
                'search_filter'     => GitInterface::SERVICE_GITHUB,
                'expected_count'    => $github_repo_count,
            ],
            [
                'search_filter'     => GitInterface::SERVICE_GITLAB,
                'expected_count'    => $gitlab_repo_count,
            ],
        ];

        foreach ($assertions as $assertion) {
            $filter = $assertion['search_filter'];
            $expected = $assertion['expected_count'];

            $builder = app(RepositoryQueryTask::class)->handle(['repository_git_provider' => $filter]);
            $actual = $builder->count();

            self::assertEquals(
                $expected,
                $actual,
                "Failed asserting provider filter of ${filter} (" . gettype($filter) . ") - with count of ${actual} matches expected ${expected}."
            );
        }
    }
}
