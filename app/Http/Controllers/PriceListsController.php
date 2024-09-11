<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Facades\Validator;
use App\Models\PriceLists;

class PriceListsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $datas = DB::table('price_lists')->get();
        return view('price_lists.index', compact('datas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('price_lists.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //define validation rules
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'type' => 'required',
            'price' => 'required',
        ]);

        //check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $return = [];
        try {
            $data_insert = [
                'name' => $request->name,
                'type' => $request->type,
                'price' => $request->price,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
                'created_by' => Auth::user()->id,
                'updated_by' => Auth::user()->id,
            ];

            DB::table('price_lists')->insert($data_insert);

            $return['message'] = 'Success Create Price Lists';
            $return['url'] = route('price_lists.index');
        } catch (Exception $e) {
            // dd($e->getMessage());
            $return['message'] = $e->getMessage();
        }

        return $return;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        $id = $request->id;
        $roles = DB::table('price_lists')->where('id',$id)->first();

        return $roles;
    }

    public function show($id)
    {
        $datas = DB::table('price_lists')->where('id', $id)->first();

        if (!isset($datas)) {
            return redirect('error.404');
        }
        return view('price_lists.show', compact('datas'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //define validation rules
        $validator = Validator::make($request->all(), [
            'id' => 'required',
            'name' => 'required',
            'type' => 'required',
            'price' => 'required',
        ]);

        //check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $return = [];
        try {
            $data_insert = [
                'name' => $request->name,
                'type' => $request->type,
                'price' => $request->price,
                'updated_at' => date('Y-m-d H:i:s'),
                'updated_by' => Auth::user()->id,
            ];

            DB::table('price_lists')->where('id', $request->id)->update($data_insert);

            $return['message'] = 'Success Update Price Lists';
            $return['url'] = route('price_lists.index');
        } catch (Exception $e) {
            $return['message'] = $e->getMessage();
        }

        return $return;
    }


    public function destroy(Request $request)
    {
        //define validation rules
        $validator = Validator::make($request->all(), [
            'id' => 'required',
        ]);

        //check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $id = $request->id;

        $return = [];

        try {
            DB::table('price_lists')->where('id', $id)->delete();

            $return['message'] = 'Success Delete Price Lists';
            $return['url'] = route('price_lists.index');
        } catch (Exception $e) {
            $return['message'] = $e->getMessage();
        }
        
        return $return;
    }
}
