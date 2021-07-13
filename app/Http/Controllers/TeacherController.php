<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Teacher;
class TeacherController extends Controller
{
    public function index(){
        return view('welcome');
    }

    public function allData(){
        $data = Teacher::orderBy('id','DESC')->get();
        return response()->json($data);
    }


    public function store(Request $request){
        $request->validate([
            'name' => 'required',
            'title' => 'required',
            'institute' => 'required',
        ]);
        $data = New Teacher();

        $data->name = $request->name;
        $data->title = $request->title;
        $data->institute = $request->institute;
        $data->save();

        return response()->json($data);
    }


    public function Edit($id){
        $data = Teacher::findOrFail($id);
        return response()->json($data);

    }


    public function Update(Request $request, $id){
        $request->validate([
            'name' => 'required',
            'title' => 'required',
            'institute' => 'required',
        ]);

        $data = Teacher::findOrFail($id);

        $data->name = $request->name;
        $data->title = $request->title;
        $data->institute = $request->institute;
        $data->save();

        return response()->json($data);
    }
    public function delete($id){
        $data = Teacher::findOrfail($id)->delete();
        return response()->json($data);
    }
}
