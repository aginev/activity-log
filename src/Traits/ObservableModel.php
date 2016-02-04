<?php

namespace Aginev\ActivityLog\Traits;

use Aginev\ActivityLog\ActivityLogListener;

trait ObservableModel {

	protected static function boot() {
		parent::boot();

		self::observe(new ActivityLogListener());
	}
}