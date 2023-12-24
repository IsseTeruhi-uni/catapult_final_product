<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Models\User;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class QrController extends Controller
{
    public function home()
    {
        $qrs = [];
        return view('Qr.home', compact('qrs'));
    }
    

    public function create()
    {
        $user = auth()->user();
        return view('Qr.create',compact('user'));
    }

    public function generate()
    {
        $user = auth()->user();
        return redirect()->route('home');
    }
    
}
