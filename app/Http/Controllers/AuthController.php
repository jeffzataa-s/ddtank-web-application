<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function signin(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'email' => "required|email",
                'password' => "required"
            ]);

            if ($validator->fails())
                return $this->sendError('Validation error', $validator->errors());

            if (!Auth::attempt(['email' => $request->email, 'password' => $request->password]))
                return $this->sendError('Unauthorized', ['error' => "Unauthorized"]);

            $authUser = Auth::user();
            $success = [];
            $success['token'] = $authUser->createToken('ddt_auth')->plainTextToken;
            $success['name'] = $authUser->name;
            return $this->sendResponse($success, ['User signed in']);
        } catch (Exception $ex) {
            $this->exceptionLog($ex);
            return $this->sendError('Internal error', [$ex->getMessage()], 500);
        }
    }

    public function signup(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'name' => "required",
                'email' => "required|email|unique:users,email",
                'password' => "required",
                'confirm_password' => "required|same:password"
            ]);

            if ($validator->fails())
                return $this->sendError('Validation error', $validator->errors());

            $input = $request->all();
            $input['password'] = bcrypt($input['password']);
            $user = User::create($input);
            $success = [];
            $success['token'] = $user->createToken('ddt_auth')->plainTextToken;
            $success['name'] = $user->name;

            return $this->sendResponse($success, 'User created successfully.');
        } catch (Exception $ex) {
            $this->exceptionLog($ex);
            return $this->sendError('Internal error', [$ex->getMessage()], 500);
        }
    }
}
