<?php

namespace App\Models;

use App\Enums\OrderStatus;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class Order extends Model {

	use LogsActivity;

	protected $guarded = array(
		'id',
	);

	protected $fillable = array(
		'order_date',
		'order_status',
		'total_products',
		'total',
		'invoice_no',
		'payment_type',
		'pay',
		'due',
		'user_id',
		'uuid',
	);

	protected $casts = array(
		'order_date'   => 'date',
		'created_at'   => 'datetime',
		'updated_at'   => 'datetime',
		'order_status' => OrderStatus::class,
	);

	public function customer(): BelongsTo {
		return $this->belongsTo( Customer::class );
	}

	public function details(): HasMany {
		return $this->hasMany( OrderDetails::class );
	}

	public function scopeSearch( $query, $value ): void {
		$query->where( 'invoice_no', 'like', "%{$value}%" )
			->orWhere( 'order_status', 'like', "%{$value}%" )
			->orWhere( 'payment_type', 'like', "%{$value}%" );
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
		->logOnly( array( 'invoice_no', 'payment_type' ) );
		// Chain fluent methods for configuration options
	}
}
