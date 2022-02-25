<?php

namespace App\Http\Controllers;

use App\loginModel;
use App\Helpers\Converter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class loginController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $login = loginModel::get();
      return Converter::ResponseApi(200, 'Data Class', $login);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function add(Request $request)
    {
      $validator = Validator::make($request->all(), [
        'user_name' => 'required',
        'password' => 'required|min:6'
      ]);

      if ($validator->fails()) {
        return Converter::ResponseApi(Response::HTTP_BAD_REQUEST, $validator->messages()->first(), (object)array());
      }
      try {
        $query = loginModel::create([
          'user_name' => $request->user_name,
          'password' => $request->password
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
     * @param  \App\loginModel  $loginModel
     * @return \Illuminate\Http\Response
     */
    public function show(loginModel $loginModel)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\loginModel  $loginModel
     * @return \Illuminate\Http\Response
     */
    public function edit(loginModel $loginModel)
    {
      
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\loginModel  $loginModel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, loginModel $loginModel)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\loginModel  $loginModel
     * @return \Illuminate\Http\Response
     */
    public function destroy(loginModel $loginModel)
    {
        //
    }
}
