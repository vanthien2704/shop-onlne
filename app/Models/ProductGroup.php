<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class ProductGroup
 * 
 * @property int $id
 * @property string $group_name
 * @property string $note
 * @property bool $enable
 * 
 * @property Collection|Product[] $products
 *
 * @package App\Models
 */
class ProductGroup extends Model
{
	protected $table = 'product_groups';
	public $timestamps = false;

	protected $casts = [
		'enable' => 'bool'
	];

	protected $fillable = [
		'group_name',
		'note',
		'enable'
	];

	public function products()
	{
		return $this->hasMany(Product::class, 'group_id');
	}
}
