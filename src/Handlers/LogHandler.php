<?php

namespace Aginev\ActivityLog\Handlers;

class LogHandler implements ActivityLogInterface
{

    /**
     * Triggered when model is created
     *
     * @param $model
     * @return mixed
     */
    public function created($model)
    {
        // TODO: Implement created() method.
    }

    /**
     * Triggered when model is updated
     *
     * @param $model
     * @return mixed
     */
    public function updated($model)
    {
        // TODO: Implement updated() method.
    }

    /**
     * Triggered when model is deleted
     *
     * @param $model
     * @return mixed
     */
    public function deleted($model)
    {
        // TODO: Implement deleted() method.
    }

    /**
     * Clean old logs.
     *
     * @param int $offset Offset in days
     *
     * @return bool
     */
    public function cleanLog($offset)
    {
        // TODO: Implement cleanLog() method.
    }

    /**
     * Get all logs
     *
     * @return mixed
     */
    public function getActivities()
    {
        // TODO: Implement getActivities() method.
    }

    /**
     * Get getLatest logs
     *
     * @param null $limit
     * @return mixed
     */
    public function getLatestActivities($limit = null)
    {
        // TODO: Implement getLatestActivities() method.
    }

    /**
     * Setup logs query limit
     *
     * @param null $limit
     * @return mixed|null
     */
    protected function setLimit($limit = null)
    {
        if (!$limit) {
            $limit = config('login-activity.number_of_getLatest_logs', 100);
        }

        return $limit;
    }
}