<?php

namespace Aginev\ActivityLog\Handlers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;
use Aginev\ActivityLog\Models\UserActivity;

class EloquentHandler implements ActivityLogInterface
{

    /**
     * Triggered when model is created
     *
     * @param $model
     * @return mixed
     */
    public function created($model)
    {
        $this->log($model, __FUNCTION__);
    }

    /**
     * Triggered when model is updated
     *
     * @param $model
     * @return mixed
     */
    public function updated($model)
    {
        $this->log($model, __FUNCTION__);
    }

    /**
     * Triggered when model is deleted
     *
     * @param $model
     * @return mixed
     */
    public function deleted($model)
    {
        $this->log($model, __FUNCTION__);
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

    private function log($model, $event)
    {
        $attributes = $model->getAttributes();
        $original = $model->getOriginal();

        $activity = new UserActivity([
            'user_id'     => Auth::user() ? Auth::user()->id : null,
            'ip_address'  => Request::ip(),
            'event'       => $event,
            'before'      => $attributes ? json_encode($attributes) : null,
            'after'       => $original ? json_encode($original) : null,
            'description' => $model->activityDescription($event, Auth::user() ? Auth::user() : null),
        ]);

        $model->activities()->save($activity);
    }
}