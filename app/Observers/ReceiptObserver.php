<?php

namespace App\Observers;

use App\Models\Receipt;
use Illuminate\Support\Facades\Crypt;

class ReceiptObserver
{
    /**
     * Handle the Receipt "created" event.
     */
    public function saving(Receipt $receipt): void
    {
        $receipt->phone = '+880' . $receipt->phone;
        $receipt->buyer_ip = request()->ip();
        $receipt->hash_key = hash('sha512', $receipt->receipt_id . hash('sha512',  $receipt->phone));
        $receipt->entry_by = auth()->id();
    }

}
