<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class EmployeeController extends Controller
{
    //Get Data 
    public function index(){
    // --Get all data from Database.
        //return Employee::all();

    //--One to One Relationship one User have single Employee.
        // $user=User::with('employee')->get();
        // dd($user->toArray());

    //--One to Many Relationship One user have multiple employee.
        // $user=User::with('employeehM')->get();
        // dd($user->toArray());

    //--Many To Many Relationship User Have multiple roles
        // $user = User::with('role')->first();
        // dd($user->toArray());
    }

    //Store Data 
    public function store(Request $request){

        $employee=$request->validate([
            'EmployeeName'=>'required',
            'EmployeeID'=>'required',
            'EmployeeRole'=>'required',
            'Email'=> 'required|email|unique:users',
            'Mobile'=> 'required',
            'City'=>'required',
        ]); 

        $employee = Employee::create([
            'EmployeeName'=>$request->EmployeeName,
            'EmployeeID'=>$request->EmployeeID,
            'EmployeeRole'=>$request->EmployeeRole,
            'Email'=> $request->Email,
            'Mobile'=> $request->Mobile,
            'City'=>$request->City,
            'user_id'=>Auth::id(),
        ]);

        if($employee){
            return response()->json(['success'=>true,'msg'=> 'Successfully Add']);
        }else{
            return response()->json(['success'=>false,'msg'=> 'Unsuccessfully']);
        }  
    }

    //Update Data
    public function show(Request $request){
        $employee=Employee::find($request->id);
           $employee->EmployeeName=$request->EmployeeName;
           $employee->EmployeeID=$request->EmployeeID;
           $employee->EmployeeRole=$request->EmployeeRole;
           $employee->Email= $request->Email;
           $employee->Mobile= $request->Mobile;
           $employee->City=$request->City;

           $result=$employee->save();
           if($result){
                return response()->json(['success'=>true,'msg'=> 'Updated Successfully']);
           }else{
                return response()->json(['success'=>true,'msg'=> 'Not Updated']);
           }

    }

    //Delete Data
    public function delete(Request $request){
        $employee=Employee::find($request->id);
        $employee->delete();
        return response()->json(['success'=>true,'msg'=> 'Deleted Successfully']); 
    }

    //Search Data
    public function search($EmployeeName){
        return Employee::where("EmployeeName",$EmployeeName)->get();
    }
}

