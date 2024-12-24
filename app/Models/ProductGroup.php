<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class ProductGroup
 * 
 * @property int $id
 * @property string $group_name
 * @property string $note
 * @property bool $enable
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Collection|Product[] $products
 *
 * @package App\Models
 */
class ProductGroup extends Model
{
	protected $table = 'product_groups';

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
