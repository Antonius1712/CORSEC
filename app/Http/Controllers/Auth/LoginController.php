<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Model\LGIGlobal_Users;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */

    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->header = ['Content-Type: application/x-www-form-urlencoded'];
        $this->passwordIvEncodeLgiGlobal = base64_decode( env('PASSWORD_IV_ENCODE_LGI_GLOBAL') );// IV OUTPUT FROM C# CODE
        $this->passwordKeyEncodeLgiGlobal = base64_decode( env('PASSWORD_KEY_ENCODE_LGI_GLOBAL') );// KEY OUTPUT FROM C# CODE
    }

    public function EncryptLgiGlobalPassword($plainTextPassword){

        $iv = $this->passwordIvEncodeLgiGlobal;
        $key = $this->passwordKeyEncodeLgiGlobal;

        $unicodePassword = mb_convert_encoding($plainTextPassword, 'UTF-16LE', 'UTF-8');// Convert string to unicode
        $text =  base64_decode( base64_encode( $unicodePassword ) );

        // to append string with trailing characters as for PKCS7 padding scheme
        $block = @mcrypt_get_block_size(MCRYPT_RIJNDAEL_128, MCRYPT_MODE_CBC);
        $padding = $block - (strlen($text) % $block);
        $text .= str_repeat(chr($padding), $padding);

        $crypttext = @mcrypt_encrypt(MCRYPT_RIJNDAEL_128, $key, $text, MCRYPT_MODE_CBC, $iv);
        return base64_encode( $crypttext );
    }

    public function DecryptLgiGlobalPassword($encryptedTextPassword){

        $iv = $this->passwordIvEncodeLgiGlobal;
        $key = $this->passwordKeyEncodeLgiGlobal;

        $decrypttext = @mcrypt_decrypt(MCRYPT_RIJNDAEL_128, $key,  base64_decode($encryptedTextPassword), MCRYPT_MODE_CBC, $iv);

        return preg_replace('/[\x00-\x09\x0B\x0C\x0E-\x1F\x7F]/u', '', $decrypttext);// remove unwanted bytes from encrypting binary data

    }

    protected function attemptLogin(Request $request)
    {
        // dd($this->DecryptLgiGlobalPassword($request->password));
        $lgi = LGIGlobal_Users::where('NIK', $request->NIK)
        ->where('password', $this->EncryptLgiGlobalPassword($request->password));

        /* CHECK IF USER EXIST */
        if( $lgi->first() ){

            /* CHECK IF USER HAS ACCESS TO APPS LEGAL */
            $lgi = $lgi->whereHas('getUserGroup', function($query1){
                $query1->whereHas('getGroups', function($query2){
                    $query2->whereHas('getApp', function($query3){
                        $query3->where('AppName', 'CORSEC');
                    });
                });
            })
            // ->with('getUserGroup')
            ->with(['getDept', 'getBranch', 'getUserGroup' => function($q){
                $q->where('GroupCode', 'LIKE', '%CORSEC%');
            }])
            ->first();

            /* THROW ERROR IF DOESN'T HAVE ACCESS */
            if( !$lgi ){
                throw ValidationException::withMessages([
                    "error" => "doesn't have access.",
                ]);
            }

            /* REDIRECT TO HOMEPAGE IF USER EXIST AND HAVE ACCESS TO APP LEGAL */
            Auth()->login($lgi);

            // !RETURN TRUE AGAR BISA MASUK KE FUNCTION sendLoginResponse DI AUTHENTICATEUSERS 
            // !LALU OVERWRITE FUNCTION REDIRECTPATH DIBAWAH
            return true;
            // return redirect()->route('home');
            
        }else{
            /* THROW ERROR IF CREDENTIAL NOT MATCH */
            throw ValidationException::withMessages([
                "error" => "Wrong credentials",
            ]);
        }
    }

    /* 
        OVERRIDE FUNCTION USERNAME 
        ON VENDOR AuthenticatesUsers 
        FROM EMAIL TO NIK
    */
    public function username()
    {
        return 'NIK';
    }

    public function logout(){
        Auth::logout();
        return redirect()->route('login');
    }
    
    public function redirectPath(){
        $group = Auth()->user()->getUserGroup->pluck('GroupCode')[0];
        if( $group == 'USER_CORSEC' ){
            return route('home');
        }else if( $group == 'ADMIN_CORSEC' ){
            return route('admin.home');
        }else{
            return route('login');
        }
    }
}
