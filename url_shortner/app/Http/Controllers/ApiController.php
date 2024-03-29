<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Tableview;
use App\Models\User;
use Hash;

class ApiController extends Controller
{
     public function index(){
       
        $list = Tableview::all();
        $data=[     
              $list
        ];
        return response()->json($data);
     }

     public function register(Request $request){
   
        $validator = Validator::make($request->all(), [
            'name'=>'required|min:2|max:100',
            'email'=>'required|email|unique:users',
            'password'=>'required|min:6|max:100',
            'confirm_password'=>'required|same:password'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message'=>'validation failed',
                'errors'=>$validator->errors()
               ],422);
        }
       $user= User::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>Hash::make($request->password)

        ]);

        return response()->json([
            'message'=>'Registered Successfully',
            'data'=>$user
           ],200);
       
    }

    public function login(Request $request){
            $validator = Validator::make($request->all(),[
                'email'=>'required|email',
                'password'=>'required'
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'message'=>'validation failed',
                    'errors'=>$validator->errors()
                   ],422);
            }
            $user=User::where('email',$request->email)->first();
            if($user){
                  
                if(Hash::check($request->password,$user->password)){

                    $token=$user->createToken('auth-token')->plainTextToken;
                    return response()->json([
                    'message'=>'Login Successfull',
                    'token'=>$token,
                    'data'=>$user
                     ],200);

                }else{
                    return response()->json([
                        'message'=>'Incorrect User'
                       ],400);
                }

            }
            else{
                return response()->json([
                    'message'=>'Incorrect User',
                    'errors'=>$validator->errors()
                   ],422);
            }
    }
 }

