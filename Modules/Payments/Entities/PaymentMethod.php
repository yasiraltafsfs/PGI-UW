<?php

namespace Modules\Payments\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PaymentMethod extends Model
{
    use HasFactory;

    protected $fillable = ['user_id','payment_gateway_id','payment_method','payment_method_id'];
    
    // protected static function newFactory()
    // {
    //     return \Modules\Payments\Database\factories\PaymentMethodFactory::new();
    // }

    public  function scopeUserSpecific($query)
    {
        return $query->where('user_id', auth()->user()->id)
                     ->whereNull('deleted_at');
    }

    public function paymentGateway()
    {
        return $this->belongsTo(PaymentGateway::class);
    }
}
