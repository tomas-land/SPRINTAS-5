<?php

namespace App\Http\Controllers;
use App\Models\Project;
use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('employees', ['employees' => Employee::all(),'projects' => Project::all()]);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:employees,name|min:2|max:20',
        ]);

     $employee = new Employee();
     $employee->name = $request['name'];
     $employee->project_id= $request ['assign'];
     $employee->save();
     
     if ($employee->name == NULL)
         return redirect('/employees')->with('status_error', 'Field is empty!');

     return ($employee->save() !== 1) ?
         redirect('/employees')->with('status_success', 'New employee has been assigned!') :
         redirect('/employees')->with('status_error', 'employee was not created!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('edit_employee',['employee' => Employee::find($id)]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function edit(Employee $employee)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function update($id, Request $request){
        $this->validate($request, [
            'name' => 'required|unique:employees,name|min:2|max:20',
        ]);
                $employee = Employee::find($id);
                $employee->name = $request['name'];
                
                return ($employee->save() !== 1) ? 
                    redirect('/employees')->with('status_success', 'Post updated!') : 
                    redirect('/employees/'.$id)->with('status_error', 'Post was not updated!');
            }
        

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Employee::destroy($id);
        return redirect('/employees')->with('status_success', 'Employee deleted!');
    }

}
