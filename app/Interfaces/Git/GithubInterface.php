<?php

namespace App\Interfaces\Git;

interface GithubInterface
{
    /**
     * Webhook - Header - Installation Target Types
     */
    const WEBHOOK_HEADER_INSTALLATION_TARGET_TYPE_REPOSITORY = 'repository';


    /**
     * Webhook - Header - Events
     */
    const WEBHOOK_HEADER_EVENT_CREATE       = 'create';
    const WEBHOOK_HEADER_EVENT_PULL_REQUEST = 'pull_request';
    const WEBHOOK_HEADER_EVENT_PUSH         = 'push';


    /**
     * Webhook - Pull request - Actions
     */
    const WEBHOOK_PULL_REQUEST_ACTION_CLOSED    = 'closed';
    const WEBHOOK_PULL_REQUEST_ACTION_OPENED    = 'opened';
    const WEBHOOK_PULL_REQUEST_ACTION_REOPENED  = 'reopened';


    /**
     * Pull Request - States
     */
    const PULL_REQUEST_STATE_CLOSED = 'CLOSED';
    const PULL_REQUEST_STATE_OPEN   = 'OPEN';
}
