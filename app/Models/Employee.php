<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $fillable = ['EmployeeName','EmployeeID','EmployeeRole','Email','Mobile','City','user_id'];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function userhM(){
        return $this->belongsTo(User::class);
    }
}
