<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class Category extends Model {

	use HasFactory;
	use LogsActivity;

	public $timestamps = true;

	protected $guarded = array(
		'id',
	);

	protected $fillable = array(
		'name',
		'slug',
		'short_code',
		'user_id',
	);

	protected $casts = array(
		'created_at' => 'datetime',
		'updated_at' => 'datetime',
	);

	public function products(): HasMany {
		return $this->hasMany( Product::class, 'category_id', 'id' );
	}

	public function scopeSearch( $query, $value ): void {
		$query->where( 'name', 'like', "%{$value}%" )
			->orWhere( 'slug', 'like', "%{$value}%" );
	}

	public function getRouteKeyName(): string {
		return 'slug';
	}

	/**
	 * Get the user that owns the Category
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function user(): BelongsTo {
		return $this->belongsTo( User::class );
	}

	public function getActivitylogOptions(): LogOptions {
		return LogOptions::defaults();
		// Chain fluent methods for configuration options
	}
}
