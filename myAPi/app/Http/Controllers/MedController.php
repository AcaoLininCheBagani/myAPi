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


    //function to update
    public function update(Request $request , $id)
    {
        try{
            $record = register::findOrFail($id);
            $record->name = $request->name;
            $record->save();

            return  response()->json(['status' => true, 'message' => 'Successfully updated!.']);
        }catch(\Exception $e)
        {
            return response()->json(['status' => false, 'message' => 'No such user!']);
        }
    }
    //function to delete
    public function delete($id)
    {
        try{
            $record = register::findOrFail($id);
            $record->delete();

            return  response()->json(['status' => true, 'message' => 'Successfully deleted!.']);
        }catch(\Exception $e)
        {
            return response()->json(['status' => false, 'message' => 'No such user!']);
        }
    }
     //function to view
     public function view(Request $request , $email)
     {
        try{
            $record = register::findOrFail($email);
            $record->name = $request->name;
            $record->name = $request->email;
            return  response()->json($record);
        }catch(\Exception $e)
        {
            return response()->json(['status' => false, 'message' => 'No such user!']);
        }
     }
}
