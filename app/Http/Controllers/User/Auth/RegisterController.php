<?php

namespace App\Http\Controllers\User\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Helpers\MegaMailer;
use App\Models\User;
use App\Models\Language;
use App\Models\BasicSetting as BS;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Session;


class RegisterController extends Controller
{
    public function __construct()
    {
        $this->middleware('setlang');
        $bs = BS::first();

        Config::set('captcha.sitekey', $bs->google_recaptcha_site_key);
        Config::set('captcha.secret', $bs->google_recaptcha_secret_key);
    }

    public function registerPage()
    {
        return view('user.register');
    }

    public function register(Request $request)
    {
        if (session()->has('lang')) {
            $currentLang = Language::where('code', session()->get('lang'))->first();
        } else {
            $currentLang = Language::where('is_default', 1)->first();
        }

        $bs = $currentLang->basic_setting;

        $messages = [
            'g-recaptcha-response.required' => 'Please verify that you are not a robot.',
            'g-recaptcha-response.captcha' => 'Captcha error! try again later or contact site admin.',
        ];

        $rules = [
            'email'   => 'required|email|unique:users',
            'username' => 'required|unique:users',
            'password' => 'required|confirmed'
        ];

        if ($bs->is_recaptcha == 1) {
            $rules['g-recaptcha-response'] = 'required|captcha';
        }

        $request->validate($rules, $messages);

        $user = new User;
        $input = $request->all();
        $input['status'] = 1;
        $input['password'] = bcrypt($request['password']);
        $token = md5(time() . $request->name . $request->email);
        $input['verification_link'] = $token;
        $user->fill($input)->save();

        $mailer = new MegaMailer();
        $data = [
            'toMail' => $user->email,
            'toName' => $user->first_name.' '.$user->last_name,
            'customer_name' => $user->username,
            'verification_link' => "<a href='" . url('user/register/verify/' . $token) . "'>" . url('user/register/verify/' . $token) . "</a>",
            'website_title' => $bs->website_title,
            'templateType' => 'email_verification',
            'type' => 'emailVerification'
        ];
        $mailer->mailFromAdmin($data);

        return back()->with('sendmail', 'We need to verify your email address. We have sent an email to  ' . $request->email . ' to verify your email address. Please click link in that email to continue.');
    }

    public function token($mode,$token)
    {
        $user = User::where('verification_link', $token)->first();
        if (isset($user)) {
            $user->email_verified = 1;
            $user->update();
         
            Session::flash('success', 'Email Verified Successfully');
            if ($mode === "online"){
                Auth::guard('web')->login($user);
                return redirect()->route('user.dashboard');
            }else{
                return redirect()->route('user.login');
            }
        }
    }
}
