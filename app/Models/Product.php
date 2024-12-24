<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Product
 * 
 * @property int $id
 * @property int $group_id
 * @property string $product_name
 * @property string $description
 * @property int $quantity
 * @property int $unit_price
 * @property int $old_unit_price
 * @property string $image
 * @property bool $enable
 * @property string $note
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property ProductGroup $product_group
 * @property Collection|Cart[] $carts
 *
 * @package App\Models
 */
class Product extends Model
{
	protected $table = 'products';

	protected $casts = [
		'group_id' => 'int',
		'quantity' => 'int',
		'unit_price' => 'int',
		'old_unit_price' => 'int',
		'enable' => 'bool'
	];

	protected $fillable = [
		'group_id',
		'product_name',
		'description',
		'quantity',
		'unit_price',
		'old_unit_price',
		'image',
		'enable',
		'note'
	];

	public function product_group()
	{
		return $this->belongsTo(ProductGroup::class, 'group_id');
	}

	public function carts()
	{
		return $this->hasMany(Cart::class);
	}
}
