<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Peserta;
use Illuminate\Support\Facades\Auth;
use App\Models\Outlet;
// use App\Imports\JabatanImport;
use Maatwebsite\Excel\Facades\Excel;
use Exception;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;

class PesertaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pesertas = Peserta::all();
        return view('peserta.index', compact('pesertas'));
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
        $this->validate($request,[
            'name'   => 'required',
        ]);
        $jabatan = new Jabatan();
        $jabatan->name = $request->name;
        $jabatan->created_by = Auth::User()->id;
        $jabatan->updated_by = Auth::User()->id;
        $jabatan->save();
        

        return redirect(route('jabatan.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        $jabatan = Jabatan::find($id);

        return $jabatan;

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
        $this->validate($request,[
            'name'=>'required'
        ]);
        $id = $request->id;
        $jabatan = Jabatan::find($id);
        $jabatan->name = $request->name;
        $jabatan->updated_by = Auth::User()->id;
        $jabatan->save();
        return redirect(route('jabatan.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $id = $request->id;
        $jabatan = Jabatan::find($id);
        $jabatan->delete();
        return $jabatan;

        return view('jabatan.index', compact('jabatans'));
    }

    public function uploadJabatan(Request $request)
    {
        $extension = $request->file('file')->getClientOriginalExtension();

        $ext = ['xlsx','xls'];

        if (!in_array($extension,$ext)){

            return redirect()->route('jabatan.index')->with('message', 'Format file tidak sesuai !');
        }

        $tmp_path = $_FILES["file"]["tmp_name"];
        $filename = $_FILES['file']['name'];
        $target_file = storage_path('app/'.$filename);

        // move file upload to storage
        move_uploaded_file($tmp_path, $target_file);
        
        try {
            Excel::import(new JabatanImport,$target_file);
            $return = 'Jabatan Berhasil di Import !';
            File::delete($target_file);
        } catch (Exception $e) {
            // $return = 'Proses import gagal !';
            File::delete($target_file);
            $return = 'Caught exception: '. $e->getMessage(). "\n";

        }

        return redirect()->route('jabatan.index')->with('message', $return);
    }
}   