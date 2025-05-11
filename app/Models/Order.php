<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Order
 * 
 * @property int $id
 * @property string $name
 * @property string $address
 * @property string $phone
 * @property string $email
 * @property Carbon $order_date
 * @property int $total
 * @property int $user_id
 * @property int $payment
 * @property int $status
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property User $user
 * @property Collection|OrderDetail[] $order_details
 *
 * @package App\Models
 */
class Order extends Model
{
	protected $table = 'order';

	protected $casts = [
		'order_date' => 'datetime',
		'total' => 'int',
		'user_id' => 'int',
		'payment' => 'int',
		'status' => 'int'
	];

	protected $fillable = [
		'name',
		'address',
		'phone',
		'email',
		'order_date',
		'total',
		'user_id',
		'payment',
		'status'
	];

	public function user()
	{
		return $this->belongsTo(User::class);
	}

	public function order_details()
	{
		return $this->hasMany(OrderDetail::class, 'bill_id');
	}
}
