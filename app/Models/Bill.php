<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Bill
 * 
 * @property int $id
 * @property int $id_payment
 * @property string $name
 * @property string $address
 * @property string $phone
 * @property string $email
 * @property Carbon $order_date
 * @property int $total
 * @property int $user_id
 * @property int $status
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property User $user
 * @property Collection|Cart[] $carts
 *
 * @package App\Models
 */
class Bill extends Model
{
	protected $table = 'bills';

	protected $casts = [
		'id_payment' => 'int',
		'order_date' => 'datetime',
		'total' => 'int',
		'user_id' => 'int',
		'status' => 'int'
	];

	protected $fillable = [
		'id_payment',
		'name',
		'address',
		'phone',
		'email',
		'order_date',
		'total',
		'user_id',
		'status'
	];

	public function user()
	{
		return $this->belongsTo(User::class);
	}

	public function carts()
	{
		return $this->hasMany(Cart::class);
	}
}
