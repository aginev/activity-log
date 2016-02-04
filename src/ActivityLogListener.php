<?php

namespace Aginev\ActivityLog;

class ActivityLogListener
{

    public function created($model)
    {
        dd('created', $model);
    }

    public function updated($model)
    {
        dd('updated', $model);
    }

    /*public function saved($model)
    {
        dd('saved', $model);

//        LogUserAction::store(__FUNCTION__, $model, $this->getUser());
    }*/

    public function deleted($model)
    {
        dd('deleted', $model);
    }

}