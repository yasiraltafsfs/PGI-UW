<?php

namespace Modules\Payments\Entities;

use Illuminate\Database\Eloquent\Model;
// use Illuminate\Database\Eloquent\Factories\HasFactory;

class Transaction extends Model
{
    // use HasFactory;

    protected $fillable = ['user_id','payment_method_id','transaction_id','amount','status',];
    protected $table = 'transactions';
    
    protected static function newFactory()
    {
        // return \Modules\Payments\Database\factories\PaymentMethodFactory::new();
    }

    public  function scopeUserSpecific($query)
    {
        return $query->where('user_id', auth()->user()->id)
                     ->whereNull('deleted_at');
    }

    public function paymentMethod(){
        return $this->belongsTo(PaymentMethod::class);
        
    }

}
