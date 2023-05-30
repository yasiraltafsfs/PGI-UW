<?php

namespace Modules\Payments\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Refund extends Model
{
    use HasFactory;

    protected $fillable = ['user_id','status','payment_method_id','refund_id'];
    
    public function paymentMethod(){
        return $this->belongsTo(PaymentMethod::class);
        
    }


}
