<?php

namespace App\Models;

use App\Enums\TaxType;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    // protected $fillable = [
    //     'name',
    //     'slug',
    //     'code',
    //     'quantity',
    //     'quantity_alert',
    //     'unit_number',
    //     'selling_price',
    //     'purchase_price',
    //     'producttype',
    //     'notes',
    //     'category_id',
    //     'unit_id',
    //     'created_at',
    //     'updated_at',
    //     "user_id",
    //     "uuid",
    //     "manufacturing_date",
    //     "expiry_date"
    // ];

    public static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->uuid = Str::uuid();

            $model->code =  IdGenerator::generate([
                'table' => 'products',
                'field' => 'code',
                'length' => 7,
                'prefix' => 'PC'
            ]);
        });
    }

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function product_type(): BelongsTo
    {
        return $this->belongsTo(ProductType::class, 'producttype', 'id');

    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function unit(): BelongsTo
    {
        return $this->belongsTo(Unit::class);
    }

    protected function sellingPrice(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $value / 100,
            set: fn ($value) => $value * 100,
        );
    }

    public function scopeSearch($query, $value): void
    {
        $query->where('name', 'like', "%{$value}%")
            ->orWhere('code', 'like', "%{$value}%");
    }
    /**
    * Get the user that owns the Category
    *
    * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
    */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
