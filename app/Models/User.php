<?php

namespace App\Models;

use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class User extends Authenticatable implements MustVerifyEmail {

	use HasApiTokens;
	use HasFactory;
	use Notifiable;
	use HasRoles;
	use LogsActivity;

	protected $fillable = array(
		'uuid',
		'photo',
		'name',
		'username',
		'email',
		'password',
		'store_name',
		'store_address',
		'store_phone',
		'store_email',
	);

	protected $hidden = array(
		'password',
		'remember_token',
	);

	protected $casts = array(
		'email_verified_at' => 'datetime',
		'created_at'        => 'datetime',
		'updated_at'        => 'datetime',
	);

	public function scopeSearch( $query, $value ): void {
		$query->where( 'name', 'like', "%{$value}%" )
			->orWhere( 'email', 'like', "%{$value}%" );
	}

	public function getRouteKeyName(): string {
		return 'name';
	}

	public function supplier() {
		return $this->hasOne( Supplier::class, 'user_id', 'id' );
	}

	public function getActivitylogOptions(): LogOptions {
		return LogOptions::defaults()
		->logOnly( array( 'name', 'email' ) );
		// Chain fluent methods for configuration options
	}
}
