<?php

namespace App\Http\Controllers;

use App\Models\ProductLog;

class LogController extends Controller
{
    public function index()
    {
        $logs = ProductLog::with(['product', 'user'])->latest()->paginate(10);
        return view('logs.index', compact('logs'));
    }
}
