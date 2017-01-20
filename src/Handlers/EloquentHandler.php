<?php

namespace Aginev\ActivityLog\Handlers;

use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;
use Aginev\ActivityLog\Models\UserActivity;

class EloquentHandler extends HandlerAbstract
{

    /**
     * Clean old logs.
     *
     * @param int $offset Offset in days
     *
     * @return bool
     */
    public function cleanLog($offset)
    {
        $past = Carbon::now()->subDays($offset);

        UserActivity::where('created_at', '<=', $past)->delete();

        return true;
    }

    /**
     * Get all logs
     *
     * @return mixed
     */
    public function getActivities()
    {
        return UserActivity::orderBy('id', 'decs');
    }

    /**
     * Get getLatest logs
     *
     * @param null $limit
     * @return mixed
     */
    public function getLatestActivities($limit = null)
    {
        return UserActivity::orderBy('id', 'decs')->take($this->getLimit($limit))->get();
    }

    /**
     * @param $model
     * @param $event
     * @return mixed|void
     */
    public function log($model, $event)
    {
        $attributes = $model->getAttributes();
        $original = $model->getOriginal();

        $activity = new UserActivity([
            'user_id'     => Auth::user() ? Auth::user()->id : null,
            'ip_address'  => Request::ip(),
            'event'       => $event,
            'before'      => $event == 'deleted' ? json_encode($attributes) : json_encode(array_diff_assoc($original, $attributes)),
            'after'       => json_encode(array_diff_assoc($attributes, $original)),
            'description' => $model->activityDescription($event, Auth::user() ? Auth::user() : null),
            'created_at'  => Carbon::now()
        ]);

        $model->activities()->save($activity);
    }
}