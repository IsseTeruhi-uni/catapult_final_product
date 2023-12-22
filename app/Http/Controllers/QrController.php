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
        $user = auth()->user();
        return view('Qr.home', compact('user'));
    }
    

    public function create()
    {
        $qrs = [];
        return view('Qr.create',compact('qrs'));
    }

    public function generate()
    {
        $user = auth()->user();

        
        return redirect()->route('home');
    }
    
}
