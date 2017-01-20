<?php

namespace Aginev\ActivityLog\Traits;

use Aginev\ActivityLog\Models\UserActivity;
use App\User;

trait ObservableModel {

	protected static function boot() {
		parent::boot();

		self::observe(app()['Aginev\ActivityLog\Handlers\LogActivityInterface']);
	}

    /**
     * Get all of the comment's likes.
     */
    public function activities()
    {
        return $this->morphMany(UserActivity::class, 'observable');
    }

    /**
     * Implement this method to set custom activity description message
     * @param $event
     * @param User $user
     * @return string
     */
    public function activityDescription($event, User $user = null) {
        return '';
    }

    /**
     * @return mixed
     */
    public function observable() {
        return $this->belongsTo($this->observable_type,'observable_id','id');
    }
}