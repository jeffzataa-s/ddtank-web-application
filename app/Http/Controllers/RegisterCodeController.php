<?php

namespace App\Http\Controllers;

use App\Models\RegisterCode;
use App\Models\Role;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RegisterCodeController extends Controller
{
    protected $permissions = [
        "customer",
        "admin",
        "superadmin",
        "gamemaster"
    ];

    public function index(Request $request)
    {
        if (!$request->user()->hasRole($this->permissions))
            return $this->sendError('Unauthorized', [], 403);

        $registerCodes = RegisterCode::all();
        return $this->sendResponse($registerCodes, 'Successfully');
    }

    public function get(Request $request)
    {
        if (!$request->user()->hasRole($this->permissions))
            return $this->sendError('Unauthorized', [], 403);

        $validator = Validator::make($request->all(), [
            'id' => 'required|integer|exists:register_codes,id'
        ]);

        if ($validator->fails())
            return $this->sendError('Validation error', $validator->errors());

        $input = $request->all();
        $id = $input['id'];

        $code = RegisterCode::find($id);
        return $this->sendResponse($code, 'Successfully');
    }

    public function store(Request $request)
    {
        if (!$request->user()->hasRole($this->permissions))
            return $this->sendError('Unauthorized', [], 403);

        $validator = Validator::make($request->all(), [
            'code' => 'required|min:4|max:32|unique:register_codes,code',
            'expire_days' => "required|integer"
        ]);

        if ($validator->fails())
            return $this->sendError('Validation error', $validator->errors());

        $input = $request->all();

        $code = $input['code'];
        $expire_days = $input['expire_days'];

        $registerCode = RegisterCode::create([
            'user_id' => $request->user()->id,
            'code' => $code,
            'expire_at' => Carbon::now()->addDay($expire_days)
        ]);

        return $this->sendResponse($registerCode, 'Successfully!');
    }

    public function delete(Request $request)
    {
        if (!$request->user()->hasRole($this->permissions))
            return $this->sendError('Unauthorized', [], 403);

        $validator = Validator::make($request->all(), [
            'id' => 'required|integer|exists:register_codes,id'
        ]);

        if ($validator->fails())
            return $this->sendError('Validation error', $validator->errors());

        RegisterCode::destroy($request->id);
        return $this->sendResponse([], 'Successfully!');
    }
}
