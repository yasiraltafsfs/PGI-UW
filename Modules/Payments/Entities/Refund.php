<?php

namespace Modules\Payments\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Refund extends Model
{
    use HasFactory;

    protected $fillable = [];
    
    // protected static function newFactory()
    // {
    //     return \Modules\Payments\Database\factories\RefundFactory::new();
    // }
}
