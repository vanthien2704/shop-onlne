<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

/**
 * Class User
 * 
 * @property int $id
 * @property string $username
 * @property string $fullname
 * @property string $phone
 * @property string $email
 * @property string $password
 * @property string $address
 * @property int $role_id
 * @property bool $enable
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Role $role
 * @property Collection|Apply[] $applies
 * @property Collection|Comment[] $comments
 * @property Collection|Order[] $orders
 * @property Collection|Product[] $products
 *
 * @package App\Models
 */
class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;
	protected $table = 'users';

	protected $casts = [
		'role_id' => 'int',
		'enable' => 'bool'
	];

	protected $hidden = [
		'password'
	];

	protected $fillable = [
		'username',
		'fullname',
		'phone',
		'email',
		'password',
		'address',
		'role_id',
		'enable'
	];

	public function role()
	{
		return $this->belongsTo(Role::class);
	}

	public function applies()
	{
		return $this->hasMany(Apply::class);
	}

	public function comments()
	{
		return $this->hasMany(Comment::class);
	}

	public function orders()
	{
		return $this->hasMany(Order::class);
	}

	public function products()
	{
		return $this->hasMany(Product::class);
	}
}
