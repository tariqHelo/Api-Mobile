<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\BrancheResource;
use App\Http\Resources\TasksResource;
use App\Http\Controllers\Api\BaseController as BaseController;
use Storage;
use App\Models\Branche;
use App\Models\Task;
use Validator;

class TaskController extends BaseController
{
   
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return TasksResource::collection(Task::get());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'name' =>'required',
            'type' =>'required',
            'img' =>'required:img',
            'country_id' =>'required',
            'city_id' =>'required',
            'branch_id' =>'required',
            'brand_id' =>'required',
            'time' =>'required',
        ]); 

        if ($validator->fails()) {
            return $this->sendError('Please validate error' ,$validator->errors());
        }
        if ($request->hasFile('img')) {

          $file=$request->file('img');
          $name='brands/'.uniqid().'.'.$file->extension();
          dd($name);
          $file->storePubliclyAs('public',$name);
          $data['img']=$name;
        }
        $data = $request->all();
        $tasks = Task::create($data);

        $success['tasks'] = $tasks;

        return $this->sendResponse($success ,'Tasks Created successfully' );

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Task $id)
    {   // dd($id);
        return new TasksResource($id);

       // return TasksResource::collection(Task::find($id));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {  //dd($request->all());
        
        $validator = Validator::make($request->all(),[
            'name' =>'required',
            'type' =>'required',
            'img' =>'required:img',
            'country_id' =>'required',
            'city_id' =>'required',
            'area_id' =>'required',
            'branch_id' =>'required',
            'brand_id' =>'required',
            'time' =>'required',
        ]); 
        if ($validator->fails()) {
            return $this->sendError('Please validate error' ,$validator->errors() );
        }
       if ($request->hasFile('img')) {

          $file=$request->file('photo');
          $name='brands/'.uniqid().'.'.$file->extension();
          $file->storePubliclyAs('public',$name);
          $data['photo']=$name;
        }
        $data = $request->all();
        $tasks = Task::update($data);
        $success['tasks'] = $tasks;
       // $success['input'] = $input;
        return $this->sendResponse($success ,'Tasks Updatedd successfully' );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
