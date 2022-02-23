<?php

namespace App\Http\Controllers;

use App\ClassModel;
use Illuminate\Http\Request;
use App\Helpers\Converter;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class ClassController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $classes = ClassModel::get();
      return Converter::ResponseApi(200, 'Data Class', $classes);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function add( Request $request)
    {
      $validator = Validator::make($request->all(), [
        'code_class' => 'required'
      ]);

      if ($validator->fails()) {
        return Converter::ResponseApi(Response::HTTP_BAD_REQUEST, $validator->messages()->first(), (object)array());
      }
      try {
        $query = ClassModel::create([
          'code_class' => $request->code_class,
        ]);
        return Converter::ResponseApi(200, 'Success Add Data Classes', (object)array());
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
    public function detail( $id)
    {
      $classes = ClassModel::where('id_class', $id);
      if($classes->first()){
        return Converter::ResponseApi(200, 'Detail ClassRoom', $classes->first());
      } else{
        return Converter::ResponseApi(422, 'Data Not Found', (object)array());

      }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ClassModel  $classModel
     * @return \Illuminate\Http\Response
     */
    public function show(ClassModel $classModel)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ClassModel  $classModel
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
      $validator = Validator::make($request->all(), [
        'id_class'=>'required',
        'code_class'=>'required'
      ]);
      try {
        $query = ClassModel::where('id_class', $request->id_class);
        if ($query->first()) {
          $query->update([
            'code_class'=> $request->code_class,
          ]);
          
          return Converter::ResponseApi(200, 'Success Edit Class Data', (object)array());
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
     * @param  \App\ClassModel  $classModel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ClassModel $classModel)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ClassModel  $classModel
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request)
    {
      try {
        $query = ClassModel::where('id_class', $request->id_class);

        if ($query->first()) {
          $query->delete();
          return Converter::ResponseApi(200, 'Success Delete ClassRoom Data', (object)array());
        } else {
          return Converter::ResponseApi(422, 'Data ID tidak ditemukan', (object)array());
        }
      } catch (\Exception $e) {
        return Converter::ResponseApi(Response::HTTP_BAD_REQUEST, $e->getMessage(), (object)array());
      } 
    }
}
