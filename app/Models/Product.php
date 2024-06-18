<?php

namespace App\Models;

use App\Enums\TaxType;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class Product extends Model {

	use HasFactory;
	use LogsActivity;

	protected $guarded = array( 'id' );

	public static function boot() {
		parent::boot();

		static::creating(
			function ( $model ) {
				$model->uuid = Str::uuid();

				$model->code = IdGenerator::generate(
					array(
						'table'  => 'products',
						'field'  => 'code',
						'length' => 7,
						'prefix' => 'PC',
					)
				);
			}
		);
	}

	protected $casts = array(
		'created_at' => 'datetime',
		'updated_at' => 'datetime',
	);

	public function getRouteKeyName(): string {
		return 'slug';
	}

	public function product_type(): BelongsTo {
		return $this->belongsTo( ProductType::class, 'producttype', 'id' );
	}

	public function category(): BelongsTo {
		return $this->belongsTo( Category::class );
	}

	public function unit(): BelongsTo {
		return $this->belongsTo( Unit::class );
	}

	protected function sellingPrice(): Attribute {
		return Attribute::make(
			get: fn ( $value ) => $value / 100,
			set: fn ( $value ) => $value * 100,
		);
	}

	public function scopeSearch( $query, $value ): void {
		$query->where( 'name', 'like', "%{$value}%" )
			->orWhere( 'code', 'like', "%{$value}%" );
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
		return LogOptions::defaults()
		->logOnly( array( 'name', 'text' ) );
		// Chain fluent methods for configuration options
	}
}
