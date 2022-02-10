<?php

namespace App\Http\Controllers;

use App\studentsModel;
use App\Helpers\Converter;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;


class students extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $students = studentsModel::get();
        return Converter::ResponseApi(200, 'Data Student', $students);
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
        'no_tlp' => 'required|numeric',
        'alamat' => 'required',
        // 'email' => 'required|email|unique:users',
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
          'no_tlp' => $request->no_tlp,
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
