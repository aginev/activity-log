<?php

namespace Aginev\ActivityLog\Handlers;

abstract class HandlerAbstract implements ActivityLogInterface
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
     * Setup logs query limit
     *
     * @param null $limit
     * @return mixed|null
     */
    protected function getLimit($limit = null)
    {
        if (!$limit) {
            $limit = config('login-activity.number_of_getLatest_logs', 100);
        }

        return $limit;
    }

}