<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Apply
 * 
 * @property int $id
 * @property int $user_id
 * @property string|null $name
 * @property string|null $email
 * @property string|null $phone
 * @property string|null $content
 * @property Carbon|null $date
 * 
 * @property User $user
 *
 * @package App\Models
 */
class Apply extends Model
{
	protected $table = 'apply';
	public $timestamps = false;

	protected $casts = [
		'user_id' => 'int',
		'date' => 'datetime'
	];

	protected $fillable = [
		'user_id',
		'name',
		'email',
		'phone',
		'content',
		'date'
	];

	public function user()
	{
		return $this->belongsTo(User::class);
	}
}
