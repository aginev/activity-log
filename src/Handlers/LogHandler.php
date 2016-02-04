<?php

namespace Aginev\ActivityLog\Handlers;

use Aginev\ActivityLog\Exceptions\ActivityLogException;
use Illuminate\Auth\Events\Login;
use Illuminate\Auth\Events\Logout;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Support\Facades\Log;

class LogHandler implements ActivityLogInterface
{

    /**
     * Log login event
     *
     * @param Login $login
     * @return mixed
     */
    public function login(Login $login)
    {
        $this->createActivity($login->user, __FUNCTION__);
    }

    /**
     * Log logout event
     *
     * @param Logout $logout
     * @return mixed
     */
    public function logout(Logout $logout)
    {
        $this->createActivity($logout->user, __FUNCTION__);
    }

    /**
     * Clean old logs.
     *
     * @param int $offset Offset in days
     *
     * @return bool
     */
    public function cleanLog($offset = 30)
    {
        // This handler is not able to clean logs

        return true;
    }

    /**
     * Create user login activity
     *
     * @param Authenticatable $user
     * @param $event_name
     * @return bool
     */
    protected function createActivity($user, $event_name)
    {
        if (!$user) {
            return false;
        }

        Log::info('[' . strtoupper($event_name) . '] User #' . $user->id, $user->toArray());

        return true;
    }

    /**
     * Get all logs
     * @throws ActivityLogException
     */
    public function getLogs() {
        throw new ActivityLogException('Not able to get logs from file');
    }

    /**
     * Get getLatest logs
     *
     * @param null $limit
     * @return mixed|void
     * @throws ActivityLogException
     */
    public function getLatestLogs($limit = null) {
        throw new ActivityLogException('Not able to get logs from file');
    }


    /**
     * Get login logs
     * @throws ActivityLogException
     */
    public function getLoginLogs() {
        throw new ActivityLogException('Not able to get logs from file');
    }

    /**
     * Get getLatest login logs
     *
     * @param null $limit
     * @return mixed|void
     * @throws ActivityLogException
     */
    public function getLatestLoginLogs($limit = null) {
        throw new ActivityLogException('Not able to get logs from file');
    }

    /**
     * Get logout logs
     * @throws ActivityLogException
     */
    public function getLogoutLogs() {
        throw new ActivityLogException('Not able to get logs from file');
    }

    /**
     * Get getLatest logout logs
     *
     * @param null $limit
     * @return mixed|void
     * @throws ActivityLogException
     */
    public function getLatestLogoutLogs($limit = null) {
        throw new ActivityLogException('Not able to get logs from file');
    }
}