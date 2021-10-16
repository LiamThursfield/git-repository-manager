<?php

namespace App\Interfaces\Git;

interface GitInterface
{
    const SERVICE_GITHUB = 'GitHub';

    const SERVICES = [
        self::SERVICE_GITHUB,
    ];
}
