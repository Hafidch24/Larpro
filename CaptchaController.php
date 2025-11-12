<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CaptchaController extends Controller
{
    public function showCaptcha()
    {
        $allImages = [
          '1.jpeg' => 'نمر',
          'cat.jpg' => 'قطة',
          'lion.jpeg' => 'أسد',
          'dog.jpeg' => 'كلب',
            
        ];

        $correctImage = '1.jpeg'; // الصورة المطلوبة
        $wrongImages = collect($allImages)->except($correctImage)->random(3)->toArray();

        $images = $wrongImages;
        $images[$correctImage] = $allImages[$correctImage];

        $shuffled = collect($images)->shuffle();

        session(['correct_captcha' => $correctImage]);

        return view('captcha', [
            'images' => $shuffled,
            'question' => 'اختر الصورة التي تحتوي على نمر'
        ]);
    }

    public function verifyCaptcha(Request $request)
    {
        $selected = $request->input('captcha');
        $correct = session('correct_captcha');

        if ($selected === $correct) {
            return back()->with('message', '✅ تم التحقق بنجاح!');
        } else {
            return back()->with('message', '❌ تحقق فشل. حاول مرة أخرى.');
        }
    }
    
    
    
}
