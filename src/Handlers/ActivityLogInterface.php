<?php

namespace Aginev\ActivityLog\Handlers;

use Illuminate\Auth\Events\Login;
use Illuminate\Auth\Events\Logout;

interface ActivityLogInterface
{

    /**
     * Triggered when model is created
     *
     * @param $model
     * @return mixed
     */
    public function created($model);

    /**
     * Triggered when model is updated
     *
     * @param $model
     * @return mixed
     */
    public function updated($model);

    /**
     * Triggered when model is deleted
     *
     * @param $model
     * @return mixed
     */
    public function deleted($model);

    /**
     * Clean old logs.
     *
     * @param int $offset Offset in days
     *
     * @return bool
     */
    public function cleanLog($offset);

    /**
     * Get all logs
     *
     * @return mixed
     */
    public function getActivities();

    /**
     * Get getLatest logs
     *
     * @param null $limit
     * @return mixed
     */
    public function getLatestActivities($limit = null);
}