<?php


namespace App\Http\Controllers;

use App\imageModel;
use App\Helpers\Converter;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;
// use Illuminate\Support\Facades\Storage;

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
    public function show()
    {
      $image= imageModel::get();
      // return $image;
      return Converter::ResponseApi(200, 'Data Class', $image);
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
