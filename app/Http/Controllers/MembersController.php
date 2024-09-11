<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Facades\Validator;
use App\Models\Members;

class MembersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $datas = DB::table('members')->get();
        return view('members.index', compact('datas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('members.create');
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
            'logo' => 'required|image|mimes:jpeg,png,jpg,JPG,JPEG,PNG',
            'description' => 'required',
        ]);

        //check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $return = [];
        try {
            $data_insert = [
                'name' => $request->name,
                'description' => $request->description,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
                'created_by' => Auth::user()->id,
                'updated_by' => Auth::user()->id,
            ];

            if ($request->hasFile('logo')) {
                $image = $request->file('logo');
                $filename = time() . '_' . $image->hashName();

                $path = '/assets/img/logo/';
                
                // Declare full path and filename
                $target_file = public_path($path . $filename);
            
                // Move file upload to storage
                $image->move(public_path($path), $filename);
            
                // Resize image
                $imageResize = Image::make($target_file)->width();
                $imageResize -= $imageResize * 30 / 100;
                $imageResizeInstance = Image::make($target_file);
                $imageResizeInstance->resize($imageResize, null, function ($constraint) {
                    $constraint->aspectRatio();
                });
                $imageResizeInstance->save($target_file);

                $data_insert['logo'] = $filename;
            }

            if ($request->hasFile('slide1')) {
                //define validation rules
                $validator = Validator::make($request->all(), [
                    'slide1' => 'required|image|mimes:jpeg,png,jpg,JPG,JPEG,PNG',
                ]);

                //check if validation fails
                if ($validator->fails()) {
                    return response()->json($validator->errors(), 422);
                }

                $image = $request->file('slide1');
                $filename = time() . '_' . $image->hashName();

                $path = '/assets/img/slide1/';
                
                // Declare full path and filename
                $target_file = public_path($path . $filename);
            
                // Move file upload to storage
                $image->move(public_path($path), $filename);
            
                // Resize image
                $imageResize = Image::make($target_file)->width();
                $imageResize -= $imageResize * 30 / 100;
                $imageResizeInstance = Image::make($target_file);
                $imageResizeInstance->resize($imageResize, null, function ($constraint) {
                    $constraint->aspectRatio();
                });
                $imageResizeInstance->save($target_file);

                $data_insert['slide1'] = $filename;
            }

            if ($request->hasFile('slide2')) {
                //define validation rules
                $validator = Validator::make($request->all(), [
                    'slide2' => 'required|image|mimes:jpeg,png,jpg,JPG,JPEG,PNG',
                ]);

                //check if validation fails
                if ($validator->fails()) {
                    return response()->json($validator->errors(), 422);
                }

                $image = $request->file('slide2');
                $filename = time() . '_' . $image->hashName();

                $path = '/assets/img/slide2/';
                
                // Declare full path and filename
                $target_file = public_path($path . $filename);
            
                // Move file upload to storage
                $image->move(public_path($path), $filename);
            
                // Resize image
                $imageResize = Image::make($target_file)->width();
                $imageResize -= $imageResize * 30 / 100;
                $imageResizeInstance = Image::make($target_file);
                $imageResizeInstance->resize($imageResize, null, function ($constraint) {
                    $constraint->aspectRatio();
                });
                $imageResizeInstance->save($target_file);

                $data_insert['slide2'] = $filename;
            }

            if ($request->hasFile('slide3')) {
                //define validation rules
                $validator = Validator::make($request->all(), [
                    'slide3' => 'required|image|mimes:jpeg,png,jpg,JPG,JPEG,PNG',
                ]);

                //check if validation fails
                if ($validator->fails()) {
                    return response()->json($validator->errors(), 422);
                }

                $image = $request->file('slide3');
                $filename = time() . '_' . $image->hashName();

                $path = '/assets/img/slide3/';
                
                // Declare full path and filename
                $target_file = public_path($path . $filename);
            
                // Move file upload to storage
                $image->move(public_path($path), $filename);
            
                // Resize image
                $imageResize = Image::make($target_file)->width();
                $imageResize -= $imageResize * 30 / 100;
                $imageResizeInstance = Image::make($target_file);
                $imageResizeInstance->resize($imageResize, null, function ($constraint) {
                    $constraint->aspectRatio();
                });
                $imageResizeInstance->save($target_file);

                $data_insert['slide3'] = $filename;
            }

            DB::table('members')->insert($data_insert);

            $return['message'] = 'Success Create Members';
            $return['url'] = route('members.index');
        } catch (Exception $e) {
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
        $roles = DB::table('members')->where('id',$id)->first();

        return $roles;
    }

    public function show($id)
    {
        $datas = DB::table('members')->where('id', $id)->first();

        if (!isset($datas)) {
            return redirect('error.404');
        }
        return view('members.show', compact('datas'));
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
            'description' => 'required',
        ]);

        //check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $return = [];
        try {
            $data_insert = [
                'name' => $request->name,
                'description' => $request->description,
                'updated_at' => date('Y-m-d H:i:s'),
                'updated_by' => Auth::user()->id,
            ];

            if ($request->hasFile('logo')) {
                //define validation rules
                $validator = Validator::make($request->all(), [
                    'logo' => 'required|image|mimes:jpeg,png,jpg,JPG,JPEG,PNG',
                ]);

                //check if validation fails
                if ($validator->fails()) {
                    return response()->json($validator->errors(), 422);
                }

                $image = $request->file('logo');
                $filename = time() . '_' . $image->hashName();

                $path = '/assets/img/logo/';
                
                // Declare full path and filename
                $target_file = public_path($path . $filename);
            
                // Move file upload to storage
                $image->move(public_path($path), $filename);
            
                // Resize image
                $imageResize = Image::make($target_file)->width();
                $imageResize -= $imageResize * 30 / 100;
                $imageResizeInstance = Image::make($target_file);
                $imageResizeInstance->resize($imageResize, null, function ($constraint) {
                    $constraint->aspectRatio();
                });
                $imageResizeInstance->save($target_file);

                $data_insert['logo'] = $filename;
            }

            if ($request->hasFile('slide1')) {
                //define validation rules
                $validator = Validator::make($request->all(), [
                    'slide1' => 'required|image|mimes:jpeg,png,jpg,JPG,JPEG,PNG',
                ]);

                //check if validation fails
                if ($validator->fails()) {
                    return response()->json($validator->errors(), 422);
                }

                $image = $request->file('slide1');
                $filename = time() . '_' . $image->hashName();

                $path = '/assets/img/slide1/';
                
                // Declare full path and filename
                $target_file = public_path($path . $filename);
            
                // Move file upload to storage
                $image->move(public_path($path), $filename);
            
                // Resize image
                $imageResize = Image::make($target_file)->width();
                $imageResize -= $imageResize * 30 / 100;
                $imageResizeInstance = Image::make($target_file);
                $imageResizeInstance->resize($imageResize, null, function ($constraint) {
                    $constraint->aspectRatio();
                });
                $imageResizeInstance->save($target_file);

                $data_insert['slide1'] = $filename;
            }

            if ($request->hasFile('slide2')) {
                //define validation rules
                $validator = Validator::make($request->all(), [
                    'slide2' => 'required|image|mimes:jpeg,png,jpg,JPG,JPEG,PNG',
                ]);

                //check if validation fails
                if ($validator->fails()) {
                    return response()->json($validator->errors(), 422);
                }

                $image = $request->file('slide2');
                $filename = time() . '_' . $image->hashName();

                $path = '/assets/img/slide2/';
                
                // Declare full path and filename
                $target_file = public_path($path . $filename);
            
                // Move file upload to storage
                $image->move(public_path($path), $filename);
            
                // Resize image
                $imageResize = Image::make($target_file)->width();
                $imageResize -= $imageResize * 30 / 100;
                $imageResizeInstance = Image::make($target_file);
                $imageResizeInstance->resize($imageResize, null, function ($constraint) {
                    $constraint->aspectRatio();
                });
                $imageResizeInstance->save($target_file);

                $data_insert['slide2'] = $filename;
            }

            if ($request->hasFile('slide3')) {
                //define validation rules
                $validator = Validator::make($request->all(), [
                    'slide3' => 'required|image|mimes:jpeg,png,jpg,JPG,JPEG,PNG',
                ]);

                //check if validation fails
                if ($validator->fails()) {
                    return response()->json($validator->errors(), 422);
                }

                $image = $request->file('slide3');
                $filename = time() . '_' . $image->hashName();

                $path = '/assets/img/slide3/';
                
                // Declare full path and filename
                $target_file = public_path($path . $filename);
            
                // Move file upload to storage
                $image->move(public_path($path), $filename);
            
                // Resize image
                $imageResize = Image::make($target_file)->width();
                $imageResize -= $imageResize * 30 / 100;
                $imageResizeInstance = Image::make($target_file);
                $imageResizeInstance->resize($imageResize, null, function ($constraint) {
                    $constraint->aspectRatio();
                });
                $imageResizeInstance->save($target_file);

                $data_insert['slide3'] = $filename;
            }

            DB::table('members')->where('id', $request->id)->update($data_insert);

            $return['message'] = 'Success Update Members';
            $return['url'] = route('members.index');
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
            DB::table('members')->where('id', $id)->delete();

            $return['message'] = 'Success Delete Members';
            $return['url'] = route('members.index');
        } catch (Exception $e) {
            $return['message'] = $e->getMessage();
        }
        
        return $return;
    }
}
