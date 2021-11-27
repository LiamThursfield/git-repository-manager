<?php

namespace App\Interfaces\Git;

interface GitInterface
{
    const SERVICE_BITBUCKET = 'Bitbucket';
    const SERVICE_GITHUB = 'GitHub';
    const SERVICE_GITLAB = 'GitLab';

    const SERVICES = [
        self::SERVICE_GITHUB,
    ];


    /**
     * Pull Request - States
     */
    const PULL_REQUEST_STATE_CLOSED = 'CLOSED';
    const PULL_REQUEST_STATE_OPEN   = 'OPEN';
    const PULL_REQUEST_STATES       = [
        self::PULL_REQUEST_STATE_CLOSED,
        self::PULL_REQUEST_STATE_OPEN,
    ];
}
