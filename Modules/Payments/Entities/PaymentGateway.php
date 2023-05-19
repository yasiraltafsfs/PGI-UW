<?php

namespace Modules\Payments\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PaymentGateway extends Model
{
    use HasFactory;

    protected $fillable = ['user_id','gateway_id','gateway_name'];
    

    protected static function newFactory()
    {
        return \Modules\Payments\Database\factories\PaymentGatewayFactory::new();
    }

    public function paymentMethods()
    {
        return $this->hasMany(PaymentMethod::class);
    }

    public  function scopeUserSpecific($query)
    {
        return $query->where('user_id', auth()->user()->id)
                     ->whereNull('deleted_at');
    }
}
