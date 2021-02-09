<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class setupUserRegistration extends Controller
{	
	public function createStep1(Request $request){
		$data = $request->session()->get('registration');
		return view('auth.registerfinal')->with( 'stage', $data );
		//return view('auth.registerfinal',compact('reg_user', $data));
		//dd( $data );
	}

	public function create( Request $request ){
		Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'username' => ['required', 'string', 'max:255', 'unique:users,username'],
            'phone' => ['required', 'string', 'max:20'],
            'password' => ['required', 'string', 'min:6']
        ])->validate();
		$request->session()->put('registration', $request->all());
		return redirect('/register-step2');
	}

	public function registerUser( Request $request ){	
		$formData = $request->session()->get('registration');
		//dd( $formData );
		$request->validate([
            'user_image' => 'required|max:5120|image',
        ]);
        $user_image = "userImage-" . time() . '.' . $request->user_image->getClientOriginalExtension();
        $request->user_image->storeAs('user_image', $user_image);

        $user_created = User::create([
            'name' => $formData['name'],
            'email' => $formData['email'],
            'username' => $formData['username'],
            'phone' => $formData['phone'],
            'password' => Hash::make($formData['password']),
            'user_image' => $user_image
        ]);
        if( $user_created ){
        	$request->session()->forget('registration');
        	Auth::login($user_created);
        	return redirect('/dashboard');
        }
	}

	public function sessionCheck( Request $request ){
		dd($request->session()->get('registration'));
	}


}
