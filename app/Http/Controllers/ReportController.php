<?php

namespace App\Http\Controllers;

use App\Models\Receipt;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Inertia\Response;

class ReportController extends Controller
{
    public function index(Request $request): Response
    {
        $receipts = Receipt::when($request->entryBy, function ($q, $v) {
                $q->whereEntryBy($v);
            })
            ->latest('entry_at')
            ->get();


        return Inertia::render('Receipt/Index', [
            'receipts' => $receipts,
            'entryBy' => $request->entryBy
        ]);
    }

}
