<?php
namespace App\Traits;

/**
 *  It is used to generate auto id with uuid
 */

use Ramsey\Uuid\Uuid;

trait IdTrait {



	/**
	 * Boot the Uuid trait for the model.
	 *
	 * @return void
	 */
	public static function bootIdTrait() {
		static::creating(function($model) {
			$model->incrementing = false;
			$uuid = Uuid::uuid1();
			$model->{$model->getKeyName()} = $uuid->toString();
		});
	}
}
