<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Contact
 * 
 * @property string $fullname
 * @property string $email
 * @property string $phone
 * @property string $note
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @package App\Models
 */
class Contact extends Model
{
	protected $table = 'contacts';
	public $incrementing = false;

	protected $fillable = [
		'fullname',
		'email',
		'phone',
		'note'
	];
}
