<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReceiptRequest;
use App\Models\Receipt;
use App\Services\ReportService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Response;
use Inertia\Inertia;

class ReceiptController extends Controller
{

    public function __construct()
    {
    }


    public function create(Request $request): \Inertia\Response
    {
        return Inertia::render('Receipt/Create');
    }


    public function store(ReceiptRequest $request, Receipt $receipt)
    {
        $receipt->amount = $request->amount;
        $receipt->buyer = $request->buyer;
        $receipt->receipt_id = $request->receipt_id;
        $receipt->items = $request->items;
        $receipt->buyer_email = $request->buyer_email;
        $receipt->buyer_ip = $request->buyer_ip;
        $receipt->note = $request->note;
        $receipt->city = $request->city;
        $receipt->phone = $request->phone;

        $receipt->save();

        return Response::json(['message' => 'Receipt is added']);

    }



}
