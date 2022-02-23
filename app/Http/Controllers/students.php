<?php

namespace App\Http\Controllers;

use App\studentsModel;
use App\ClassModel;
use App\Helpers\Converter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;


class students extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $students = studentsModel::join('classes','classes.id_class', '=', 'students.id_class')
        ->join('images','images.id_image','=','students.id_image')
        ->get();

        $result = array();

        foreach($students as $index => $row) {
          $result[$index] = (object)array();
          $result[$index]->id = $row->id;
          $result[$index]->nama_siswa = $row->nama_siswa;
          $result[$index]->class_room = array('id' => $row->id_class, 'code_class' => $row->code_class);
          $result[$index]->image_url = url('/assets/images/students').'/'.$row->image;
          $result[$index]->no_tlp = $row->no_tlp;
          $result[$index]->email = $row->email;
          $result[$index]->alamat = $row->alamat;
        }
        
        return Converter::ResponseApi(200, 'Data Student', $result);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function add(Request $request)
    {
      $validator = Validator::make($request->all(), [
        'nama_siswa' => 'required',
        'id_class' => 'required',
        'no_tlp' => 'required|numeric',
        'email' => 'required|email',
        'alamat' => 'required'
        // 'image' => 'required|image:jpeg,jpg,png,gif,svg|max:2048',
        // 'password' => 'required|min:6|required_with:password_confirmation|same:password_confirmation',
        // 'password_confirmation' => 'required|min:6',
        // 'id_role' => 'required',
        // 'created_at' => 'required',
      ]);

      
      if ($validator->fails()) {
        return Converter::ResponseApi(Response::HTTP_BAD_REQUEST, $validator->messages()->first(), (object)array());
      }
      try {
        $query = studentsModel::create([
          'nama_siswa' => $request->nama_siswa,
          'id_class' => $request->id_class,
          'no_tlp' => $request->no_tlp,
          'email' => $request->email,
          // 'image' => $image,
          'alamat' => $request->alamat
        ]);
        return Converter::ResponseApi(200, 'Success Add Data Students', (object)array());
      } catch (\Exception $e) {
        return Converter::ResponseApi(442, $e->getMessage(), (object)array());
      }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\students  $students
     * @return \Illuminate\Http\Response
     */
    public function detail($id)
    {
      $students = studentsModel::where('id', $id);
      if($students->first()){
        return Converter::ResponseApi(200, 'Detail Student', $students->first());
      } else{
        return Converter::ResponseApi(422, 'Data Not Found', (object)array());

      }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\students  $students
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
      $validator = Validator::make($request->all(), [
        'id'=>'required',
        'nama_siswa' => 'required',
        'no_tlp' => 'required|numeric',
        'alamat' => 'required',
      ]);
      try {
        $query = studentsModel::where('id', $request->id);
        if ($query->first()) {
          $query->update([
            'nama_siswa'=> $request->nama_siswa,
            'no_tlp'=> $request->no_tlp,
            'email'=> $request->email,
            'alamat'=> $request->alamat,
          ]);
          return Converter::ResponseApi(200, 'Success Edit Data Students', (object)array());
        } else {
          return Converter::ResponseApi(422, 'Data ID tidak ditemukan', (object)array());
        }
      } catch (\Exception $e) {
        return Converter::ResponseApi(Response::HTTP_BAD_REQUEST, $e->getMessage(), (object)array());
      } 
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\students  $students
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, students $students)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\students  $students
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request)
    {
        // echo $request->id;

        try {
          $query = studentsModel::where('id', $request->id);

          if ($query->first()) {
            $query->delete();
            return Converter::ResponseApi(200, 'Success Delete Data Students', (object)array());
          } else {
            return Converter::ResponseApi(422, 'Data ID tidak ditemukan', (object)array());
          }
        } catch (\Exception $e) {
          return Converter::ResponseApi(Response::HTTP_BAD_REQUEST, $e->getMessage(), (object)array());
        } 
    }
}
