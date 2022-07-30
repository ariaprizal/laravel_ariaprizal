<?php

namespace App\Http\Controllers;

use App\Models\Data_rs;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\VarDumper\VarDumper;
use Yajra\DataTables\DataTables;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Data_rs::latest()->get();
            return DataTables()->of($data)
                ->addColumn('action', function ($data){
                    $id = $data->id;
                    $button = '<button type="button" data-toggle="tooltip"  id="' . $id . '" data-original-title="Edit" class="edit btn btn-info btn-sm edit-post mb-1"><i class="bx bxs-edit-alt"></i></button>';
                    $button .='<button type="button" data-toggle="tooltip"  id="' . $id . '" data-original-title="Delete" class="delete btn btn-info btn-sm delete-post mb-1"><i class="bx bx-trash"></i></button>';

                    return $button;
                })
                ->rawColumns(['action'])
                ->addIndexColumn()
                ->make(true);
        }
        return view('dashboard');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_rs' => 'required',
            'alamat' => 'required',
            'email' => 'required',
            'tlp' => 'required',
        ]);
        if (!$validator->fails()) 
        {
            try {
                $data = Data_rs::create($request->all());
                return response()->json( ['data' => $data, 'text' => "Data Tersimpan", 200]);
            } catch (Exception $e) {
                return response()->json( ['text' => $e->getMessage() , 400]);
            }
        }
        else
        {
            return response()->json(['status' => 0, 'error'=>$validator->errors()->toArray()]);
        }
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
        $data = Data_rs::find($id);
        return response()->json(['data' => $data], 200);
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
        $id = $request->id;
        try {
            DB::table('data_rs')->where('id', $id)->update($request->except('_token'));

            return response()->json(['text' => "Data ". $request->nama_rs ." Berhasil Di Update"], 200);
            
        } catch (Exception $e) {
            return response()->json(['text' => $e->getMessage()]);
        }
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
        try {
            DB::table('data_rs')->where('id', $id)->delete();
            return response()->json(['text' => "Data Berhasil Di Delete"], 200);
        } catch (Exception $e) {
            return response()->json(['text' => $e->getMessage()], 404);
        }   
    }
}
