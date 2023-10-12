<?php

namespace App\Http\Requests\Auth;

use Illuminate\Auth\Events\Lockout;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Request;
use App\Models\AdminUser;
use App\Models\Content;
use Illuminate\Support\Facades\Hash;

class AdminLoginRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'email' => ['required', 'string'],
            'password' => ['required', 'string'],
            'captcha' => ['required','captcha'],
        ];
    }

    /**
     * Attempt to authenticate the request's credentials.
     *
     * @return void
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function authenticate()
    {
        $this->ensureIsNotRateLimited();
        $formdata1 = $this->only('email','password');

        $formdata = array();
        $formdata['identifier'] = $formdata1['email'];
        $formdata['password'] = $formdata1['password'];        
        $resposne = AdminAPICall(json_encode($formdata));

        if (gettype($resposne) == "object" && property_exists($resposne, "token")) {
            RateLimiter::clear($this->throttleKey());
            $franchise_id = 3;
            $user_check = AdminUser::where($this->only('email'))->count();
            if($user_check == 0){
                AdminUser::create(['email'=>$formdata1['email'], 'franchise_id'=> $franchise_id]);
            }
            $admin = AdminUser::get(['id']);
            // if(Auth::guard('admin')->user()->id == $admin){
            // }
            // $admin1 = Auth::guard('admin')->user()->id;
            // dd($admin1);
            $contect_check = Content::where('franchise_id',$franchise_id)->count();
            
            if($contect_check == 0){
                Content::create(['slug'=>'terms','title_en'=>'Terms & Conditions','title_fr'=>'termes et conditions','body_en'=>'<p>terms and condition</p>','body_fr'=>'<p>termes et conditions</p>','admin_user_id'=>'1']);
                Content::create(['slug'=>'privacy','title_en'=>'Privacy Policy','title_fr'=>'politique de confidentialité','body_en'=>'<p>privacy policy</p>','body_fr'=>'<p>politique de confidentialité</p>','admin_user_id'=>'1']);

                // $adminUser = Auth::guard('admin')->user();
                // dd($adminUser); // Check the admin user object

                // if ($adminUser) {
                //     $admin1 = $adminUser->id;
                //     // dd($admin1); // Check the admin user's ID

                //     Content::create(['admin_user_id' => $admin1]);
                //     // dd('Content created with admin_user_id'); // Check if this block is executed
                // }

            }
            
        } else {
            RateLimiter::hit($this->throttleKey());
            throw ValidationException::withMessages([
                'user' => trans('auth.failed'),
            ]);
        }
        $user = AdminUser::where($this->only('email'))->first();
        if (!Auth::guard('admin')->loginUsingId($user->id)) {
            RateLimiter::hit($this->throttleKey());

            throw ValidationException::withMessages([
                'email' => trans('auth.failed'),
            ]);
        }

        RateLimiter::clear($this->throttleKey());
    }

    /**
     * Ensure the login request is not rate limited.
     *
     * @return void
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function ensureIsNotRateLimited()
    {
        if (! RateLimiter::tooManyAttempts($this->throttleKey(), 5)) {
            return;
        }

        event(new Lockout($this));

        $seconds = RateLimiter::availableIn($this->throttleKey());

        throw ValidationException::withMessages([
            'email' => trans('auth.throttle', [
                'seconds' => $seconds,
                'minutes' => ceil($seconds / 60),
            ]),
        ]);
    }

    /**
     * Get the rate limiting throttle key for the request.
     *
     * @return string
     */
    public function throttleKey()
    {
        return Str::lower($this->input('email')).'|'.$this->ip();
    }
}
