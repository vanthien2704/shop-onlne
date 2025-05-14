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
 * @property string $name
 * @property string $email
 * @property string $phone
 * @property string|null $content
 * @property Carbon|null $date
 * @property bool|null $status
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
		'date' => 'datetime',
		'status' => 'bool'
	];

	protected $fillable = [
		'user_id',
		'name',
		'email',
		'phone',
		'content',
		'date',
		'status'
	];

	public function user()
	{
		return $this->belongsTo(User::class);
	}
}
