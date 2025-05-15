<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class OrderDetail
 * 
 * @property int $id
 * @property int $product_id
 * @property int $unit_price
 * @property int $quantity
 * @property int $total_price
 * @property int $order_id
 * 
 * @property Order $order
 * @property Product $product
 *
 * @package App\Models
 */
class OrderDetail extends Model
{
	protected $table = 'order_detail';
	public $timestamps = false;

	protected $casts = [
		'product_id' => 'int',
		'unit_price' => 'int',
		'quantity' => 'int',
		'total_price' => 'int',
		'order_id' => 'int'
	];

	protected $fillable = [
		'product_id',
		'unit_price',
		'quantity',
		'total_price',
		'order_id'
	];

	public function order()
	{
		return $this->belongsTo(Order::class);
	}

	public function product()
	{
		return $this->belongsTo(Product::class);
	}
}
