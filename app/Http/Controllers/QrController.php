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
        $user = auth()->user();
        
        // 初回ログインの場合QRコード作成画面へ
        if (!$user->qr_code) {
            return view('Qr.create',compact('user'));
        }
        
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

        // ユーザーモデルにQRコードを保存
        $user->qr_code = [];
        $user->save();

        
        return redirect()->route('home');
    }
    
}
