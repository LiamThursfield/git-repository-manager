<?php

namespace App\Interfaces\Git;

interface GithubInterface
{
    /**
     * Webhook - Header - Keys
     */
    const WEBHOOK_HEADER_KEY_EVENT          = 'x-github-event';
    const WEBHOOK_HEADER_KEY_TARGET_TYPE    = 'x-github-hook-installation-target-type';


    /**
     * Webhook - Header - Installation Target Types
     */
    const WEBHOOK_HEADER_INSTALLATION_TARGET_TYPE_REPOSITORY    = 'repository';
    const WEBHOOK_HEADER_INSTALLATION_TARGET_TYPES              = [
        self::WEBHOOK_HEADER_INSTALLATION_TARGET_TYPE_REPOSITORY,
    ];


    /**
     * Webhook - Header - Events
     */
    const WEBHOOK_HEADER_EVENT_CREATE       = 'create';
    const WEBHOOK_HEADER_EVENT_PULL_REQUEST = 'pull_request';
    const WEBHOOK_HEADER_EVENT_PUSH         = 'push';
    const WEBHOOK_HEADER_EVENTS             = [
        self::WEBHOOK_HEADER_EVENT_CREATE,
        self::WEBHOOK_HEADER_EVENT_PULL_REQUEST,
        self::WEBHOOK_HEADER_EVENT_PUSH,
    ];


    /**
     * Webhook - Pull request - Actions
     */
    const WEBHOOK_PULL_REQUEST_ACTION_CLOSED    = 'closed';
    const WEBHOOK_PULL_REQUEST_ACTION_OPENED    = 'opened';
    const WEBHOOK_PULL_REQUEST_ACTION_REOPENED  = 'reopened';
    const WEBHOOK_PULL_REQUEST_ACTIONS          = [
        self::WEBHOOK_PULL_REQUEST_ACTION_CLOSED,
        self::WEBHOOK_PULL_REQUEST_ACTION_OPENED,
        self::WEBHOOK_PULL_REQUEST_ACTION_REOPENED,
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
