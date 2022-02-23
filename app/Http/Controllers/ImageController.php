<?php


namespace App\Http\Controllers;
use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use App\imageModel;
use App\Http\Controllers\Controller;
use App\Helpers\Converter;
use Symfony\Component\HttpFoundation\Response;

class ImageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index( Request $request)
    {
      $validator = Validator::make($request->all(), [
        'image' => 'required|image:jpeg,png,jpg,gif,svg|max:2048'
      ]);

      if($validator->fails()) {
        return Converter::ResponseApi(Response::HTTP_BAD_REQUEST, $validator->messages()->first(), (object)array());
      }
      $file = $request->file('image');
      $path = 'assets/images/students';
      $fileNameWithExt =$file->getClientOriginalName();
      $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
      $extension =$file->getClientOriginalExtension();
      $fileNameSimpan = $fileName . '_' .time().'.'.$extension;
      $file->move($path, $fileNameSimpan);
      try{
        $get = imageModel::create([
          'image' => $fileNameSimpan,
          'status' => $request->status
        ]);

        $reponse = (object)array();
        $reponse->id = $get->id_image;
        return Converter::ResponseApi(200, 'Success Add Data Students', $reponse);
      }catch (\Exception $e) {
        return Converter::ResponseApi(442, $e->getMessage(), (object)array());
      }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      $names = [0=> 'yusuf'];
      $types = [0=> 'laki-laki'];
      
      $all = "$names $types";

      return $all;
      
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
     * @param  \App\imageModel  $imageModel
     * @return \Illuminate\Http\Response
     */
    public function show(imageModel $imageModel)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\imageModel  $imageModel
     * @return \Illuminate\Http\Response
     */
    public function edit(imageModel $imageModel)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\imageModel  $imageModel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, imageModel $imageModel)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\imageModel  $imageModel
     * @return \Illuminate\Http\Response
     */
    public function destroy(imageModel $imageModel)
    {
        //
    }
}
