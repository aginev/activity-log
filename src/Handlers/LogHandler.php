<?php

namespace Aginev\ActivityLog\Handlers;

use Aginev\ActivityLog\Exceptions\ActivityLogException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Request;

class LogHandler extends HandlerAbstract
{

    /**
     * Clear logs
     *
     * @param int $offset
     * @return bool|void
     * @throws ActivityLogException
     */
    public function cleanLog($offset)
    {
        throw new ActivityLogException('Not able to get logs from file');
    }

    /**
     * Get all logs
     *
     * @throws ActivityLogException
     */
    public function getActivities()
    {
        throw new ActivityLogException('Not able to get logs from file');
    }

    /**
     * Get getLatest logs
     *
     * @param null $limit
     * @throws ActivityLogException
     * @return void
     */
    public function getLatestActivities($limit = null)
    {
        throw new ActivityLogException('Not able to get logs from file');
    }

    /**
     * Log event
     *
     * @param $model
     * @param $event
     * @return mixed
     */
    public function log($model, $event)
    {
        $attributes = $model->getAttributes();
        $original = $model->getOriginal();

        $activity = [
            'user_id'     => Auth::user() ? Auth::user()->id : null,
            'ip_address'  => Request::ip(),
            'event'       => $event,
            'before'      => $event == 'deleted' ? json_encode($attributes) : json_encode(array_diff_assoc($original, $attributes)),
            'after'       => json_encode(array_diff_assoc($attributes, $original)),
            'description' => $model->activityDescription($event, Auth::user() ? Auth::user() : null),
        ];

        Log::info('[' . strtoupper($event) . ']', $activity);

        return true;
    }
}