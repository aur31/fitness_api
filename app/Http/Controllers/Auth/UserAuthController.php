<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Support\Facades\Mail;
use Exception;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response as HttpFoundationResponse;
use App\Models\User;
use App\Models\PasswordReset;
use App\Mail\EmailVerificationMail;
use App\Mail\PasswordResetMail;
use Illuminate\Support\Str;
use Carbon\Carbon;
use App\Http\Resources\UserResource;
use App\Http\Resources\UserCollection;
use App\Mail\WelcomeEmail;
use Illuminate\Support\Facades\Redirect;

class UserAuthController extends Controller
{
    public function login (Request $request) {

        //return $request;
        $validator = $request->validate([
            'email' => 'required|string|max:60',
            'password' => 'required|max:60',
        ]);

        //return $request;

        $user = User::where('email', $validator["email"])->first();

        if ($user) {
            


            if(Hash::check($validator["password"],$user->password)){
                $response = [
                    'success' =>  true ,
                    'message' => "Login successful",
                    'user' => new UserResource($user),
                    'token' => $user->createToken('Laravel Password Grant Client')->accessToken
                ];
                return response($response, 200);
            }else{
                $response = [
                    'success' => false,
                    'message' => "Login failed, password incorrect",
                ];
                return response($response, 422);
            }

        } else {
            $response = [
                'success' => false,
                'message' => "Login failed,user does not exist",
            ];
            return response($response, 422);
        }
    }

    public function register (Request $request) {

        //return $request;
        $validator = $request->validate([
            'email' => 'required|string|max:60',
            'pseudo' => 'required|max:60',
            'whatsapp' => 'required|max:100',
            'telephone' => 'required|numeric',
            //'isAgent' => 'required',
            'password' => 'required|min:6|max:60',
            'confirm_password' => 'required|min:6|max:60',
        ]);
        
        $email = User::where('email', $request->email)->exists();
        $userpseudo = User::where('pseudo', $request->pseudo)->exists();

        $isGoogleSignIn = ($validator["password"] == 82736516726483) && ($validator["confirm_password"] == 82736516726483);

        if($userpseudo || $email){
            //WE CHECK IF THE EMAIL OR THE SPEUDO ALREADY EXIST
            return response([
                "success" => false,
                "message" => "Error, Email or name already exist",
            ], 204);
        }else{
            $user = new User();

            if($isGoogleSignIn){
                $validator["password"] = 37746256127283;
                $user->emailValidated = true;
            }else{
                //IF IT IS NOT A GOOGLE LOGIN. THEN THE EMAIL NEED TO BE VERIFIED
                $user->email_verification_token = Str::random(32);
            }

            $validator["password"] = bcrypt($validator["password"]);
            //$validator["whatsapp"] = 'whatsapp://send?phone='.$validator["whatsapp"].'&text=*Cette article est toujour disponible?*';
            $user->fill($validator);
            $user->logo = "houselogo2.jpg";
            $user->save();
            //$token = $user->createToken('Immobilier Password Grant Client')->accessToken;


            //event(new Registered($user));

            try{
                $isGoogleSignIn ? null : Mail::to($user->email)->send(new EmailVerificationMail($user));
                $response = [
                    'success' => true,
                    'message' => "A verification email is send to your email",
                    'user' => $user,
                    //'token' => $token
                ];
                return response($response, 200);
            }catch(Exception $e){
                $response = [
                    'success' => false,
                    'message' => "An error occured",
                    'user' => $user,
                    //'token' => $token
                ];
                return response($response, 404);
            }
            
        }
    }


    public function logout (Request $request) {
        $validator = $request->validate([
            'email' => 'required|string|max:60',
            'token' => 'required',
        ]);


        $result = $request->user()->token()->revoke();

        
        if($result == true){
            $response = [
                'success' => $result,
                'message' => 'You have been successfully logged out!'
            ];
            return response($response, 200);
        }else{
            $response = [
                'success' => $result,
                'message' => 'Error logging out!'
            ];
            return response($response, 422);
        }
    }

    public function store(Request $request)
    {
        //return $request;
        $validator = $request->validate([
            'name' => 'required|string|max:60',
            'BMI' => 'numeric|max:60',
            'disease' => 'string',
            'email' => 'required|string|max:60',
            'weight' => 'required|numeric',
            'height' => 'required|numeric',
            'role' => 'required|numeric',
            'password' => 'required|string|max:60'
        ]);

        
        $email = User::where('email', $request->email)->exists();


        if($email){
            //WE CHECK IF THE EMAIL OR THE SPEUDO ALREADY EXIST
            return response([
                "success" => false,
                "message" => "Error, Email or name already exist",
            ], 404);
        }else{
            $user = new User();
        
            $user->password = bcrypt($validator["password"]);
            //$validator["whatsapp"] = 'whatsapp://send?phone='.$validator["whatsapp"].'&text=*Cette article est toujour disponible?*';
            $user->fill($validator);
            $user->day_counter_progression = 0;

            $user->save();
            //$token = $user->createToken('Immobilier Password Grant Client')->accessToken;


            //event(new Registered($user));

            try{
                try{
                    //Mail::to($validator["email"])->send(new WelcomeEmail());
                }catch(Exception $e){
                    //$this->release();
                    $response = [
                        'success' => true,
                        'message' => $e,
                    ];
                    return response($response, 200);
                }
                $response = [
                    'success' => true,
                    'message' => "Client enregistrer",
                    'user' => $user,
                    'user' => $user,
                    'client' => null
                    //'token' => $token
                ];
                return response($response, 200);
            }catch(Exception $e){
                $response = [
                    'success' => false,
                    'message' => "An error occured",
                    'user' => $user,
                    //'token' => $token
                ];
                return response($response, 404);
            }
            
        }
    }
    
}
