<?php

namespace App\Models;

use App\Observers\ReceiptObserver;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Receipt extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $guarded = ['id'];




    protected static function booted()
    {
        parent::booted();

        static::observe(new ReceiptObserver());
    }


}
