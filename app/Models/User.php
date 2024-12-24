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
 * @property string $role
 * @property bool $enable
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Collection|Bill[] $bills
 *
 * @package App\Models
 */
class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;
	protected $table = 'users';

	protected $casts = [
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
		'role',
		'enable'
	];

	public function bills()
	{
		return $this->hasMany(Bill::class);
	}
}
