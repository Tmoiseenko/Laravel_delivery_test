<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Orchid\Screen\AsSource;

class Order extends Model
{
    use HasFactory, AsSource;

    protected $fillable = [
        'full_name',
        'phone',
        'diet_id',
        'delivery_start',
        'delivery_end',
        'delivery_variation_id',
        'comment',
    ];

    public function days()
    {
        return $this->belongsToMany(DaysWeekName::class);
    }

    public function deliveryType(): BelongsTo
    {
        return $this->belongsTo(DeliveryVariation::class, 'delivery_variation_id');
    }

    public function diet(): BelongsTo
    {
        return $this->belongsTo(Diet::class);
    }

    public function setPhoneAttribute($value)
    {
        $this->attributes['phone'] = str_replace(['+7', '(', ')', '-', ' '], '', $value);
    }
}
