<?php

namespace Aginev\ActivityLog\Traits;

use Aginev\ActivityLog\Models\UserActivity;

trait ObservableModel {

	protected static function boot() {
		parent::boot();

		self::observe(app()->make('Aginev\ActivityLog\Handlers\LogActivityInterface'));
	}

    /**
     * Get all of the comment's likes.
     */
    public function activities()
    {
        return $this->morphMany(UserActivity::class, 'observable');
    }
}