<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Cart
 * 
 * @property int $id
 * @property int $product_id
 * @property int $unit_price
 * @property int $quantity
 * @property int $total_price
 * @property int $bill_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Product $product
 * @property Bill $bill
 *
 * @package App\Models
 */
class Cart extends Model
{
	protected $table = 'cart';

	protected $casts = [
		'product_id' => 'int',
		'unit_price' => 'int',
		'quantity' => 'int',
		'total_price' => 'int',
		'bill_id' => 'int'
	];

	protected $fillable = [
		'product_id',
		'unit_price',
		'quantity',
		'total_price',
		'bill_id'
	];

	public function product()
	{
		return $this->belongsTo(Product::class);
	}

	public function bill()
	{
		return $this->belongsTo(Bill::class);
	}
}
