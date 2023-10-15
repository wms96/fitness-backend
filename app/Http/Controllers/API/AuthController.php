<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Member;
use App\User;
use Carbon\Carbon;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\JWTAuth;

class AuthController extends Controller
{
    protected $auth;
    protected $user;
    protected $jwt;

    public function __construct(JWTAuth $jwt, Guard $auth, User $user)
    {
        $this->auth = $auth;
        $this->user = $user;
        $this->jwt = $jwt;

    }

    public function register(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|max:50',
            'email' => 'required|string|email|max:50|unique:mst_members',
            'emergency_contact' => 'required|string|min:8',
            'password' => 'required|string|min:8',
            'DOB' => 'required|string',
        ]);

        $userData = $request->all();
        $userData['member_code'] = $userData['email'];
        $userData['status'] = 1;
        $userData['password'] = bcrypt($userData['password']);
        $userData['DOB'] = Carbon::createFromFormat('Y-m-d', $userData['DOB'])->toDateString();
        $user = Member::create($userData);
        $token = $this->jwt->fromUser($user);


        return response()->json(['token' => $token, 'user' => $user]);
    }

    public function login(Request $request)
    {
        $member = Member::where('email', $request->email)->first();
        if ($member) {
            if (Hash::check($request->input('password'), $member->password)) {
                $user = Member::where('email', $request->email)->first();
                $token = $this->jwt->fromUser($user);
                return response()->json(['token' => $token, 'user' => $user]);
            }
        }
        return response()->json(['error' => 'Wrong password'], 403);
    }

    public function moreinfo(Request $request)
    {
        $this->validate($request, [
            'weight' => 'required',
            'height' => 'required',
            'gender' => 'required',
        ]);

        $member = $request->attributes->get('member');
        $member->update($request->all());

        return response()->json(['user' => $member]);
    }
}
