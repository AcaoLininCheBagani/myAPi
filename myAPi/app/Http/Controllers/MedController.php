<?php

namespace App\Http\Controllers;
use App\register;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class MedController extends Controller
{

    public function read()
    {
        $record = register::all();
        return response()->json($record);
    }

    public function create(Request $request)
    {
        $record = new register;
        $record->name = $request->name;
        $record->email = $request->email;
        $record->password = Hash::make($request->password);
        $record->save();
        return response()->json(['status'=> true, 'message' => 'User created']);

    }
}
