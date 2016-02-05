<?php

return [
    /**
     * Where to store logs
     *
     * \Aginev\ActivityLog\Handlers\EloquentHandler::class - In database
     * \Aginev\ActivityLog\Handlers\LogHandler::class      - In laravel log files
     */
    'log'                   => \Aginev\ActivityLog\Handlers\EloquentHandler::class,

    /**
     * Number of latest logs to be returned
     */
    'number_of_latest_logs' => 100,
];