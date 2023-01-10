<?php

namespace Crnkovic\PublicID;

use Illuminate\Database\Schema\Blueprint;

class PublicID
{
	/**
	 * Generate a public ID table column.
	 * 
	 * @param  Blueprint $table Table object
	 * @return void
	 */
	public static function column(Blueprint $table)
	{
		$key = config('public-id.key', 'public_id');
		$size = config('public-id.size', 10);

		$table->string($key, $size)->unique();
	}

	/**
	 * Update a table column to the new size.
	 * 
	 * @param  Blueprint $table Table object
	 * @return void
	 */
	public static function update(Blueprint $table)
	{
		$key = config('public-id.key', 'public_id');
		$size = config('public-id.size', 10);

		$table->string($key, $size)->unique()->change();
	}

	/**
	 * Generate unique public ID.
	 * 
	 * @return string Public ID
	 */
	public static function generate()
	{
		$id = "";
		$characters = str_split(config('public-id.alphabet', null) ?: "abcdefghijklmnopqrstuvwxyz0123456789");

		for ($i = 0; $i < config('public-id.size', 10); $i++) {
			$id .= $characters[array_rand($characters)];
		}

		return $id;
	}
}