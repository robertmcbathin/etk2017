<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Session;

class Online extends Model
{
    /**
	 * {@inheritDoc}
	 */
	public $table = 'ETK_SESSIONS';

	/**
	 * {@inheritDoc}
	 */
	public $timestamps = false;

	/**
	 * Returns all the guest users.
	 *
	 * @param  \Illuminate\Database\Eloquent\Builder  $query
	 * @return \Illuminate\Database\Eloquent\Builder
	 */
	public function scopeGuests($query)
	{
		return $query->whereNull('user_id');
	}

	/**
	 * Returns all the registered users.
	 *
	 * @param  \Illuminate\Database\Eloquent\Builder  $query
	 * @return \Illuminate\Database\Eloquent\Builder
	 */
	public function scopeRegistered($query)
	{
		return $query->whereNotNull('user_id')->with('user');
	}

}
