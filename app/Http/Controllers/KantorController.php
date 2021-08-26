<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Storage;
use App\Models\rapat;
use Illuminate\Http\RedirectResponse;

class KantorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $show = rapat::all();
        // $total = karyawan::count();
        // $show = rapat::orderBy('created_at', 'DESC')->paginate(30);

        $data = [
            // 'count' => $total,
            'show' => $show
        ];
        return view('page.kantor.agendarapat')->with('list', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('page.kantor.tambah-agendarapat');
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
            'nama' => 'nullable',
            'title' => 'nullable',
            'file' => 'required|file|max:100000',
            ]);

        // tampung berkas yang sudah diunggah ke variabel baru
        // 'file' merupakan nama input yang ada pada form
        $uploadedFile = $request->file('file');        

        // simpan berkas yang diunggah ke sub-direktori 'public/files'
        // direktori 'files' otomatis akan dibuat jika belum ada
        $path = $uploadedFile->store('public/files');

        $data = new rapat;
        $data->nama = $request->nama;
        $data->title = $request->title ?? $uploadedFile->getClientOriginalName();
        $data->filename = $path;

        $data->save();
        return redirect('/kantor/rapat')->with('message','Tambah Agenda Berhasil');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = rapat::find($id);
        return Storage::download($data->filename, $data->title);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = rapat::find($id);
        // return view('pages.rapat.editrapat')->with('list', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'nama' => 'required',
            'file' => 'required',
            ]);
        $data = rapat::find($id);
        $data->nama = $request->nama;
        $data->file = $request->file;

        $data->save();
        return redirect('/kantor/rapat')->with('message','Perubahan Agenda Berhasil');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = rapat::find($id);
        $data->delete();

        // redirect
        return \Redirect::to('/kantor/rapat')->with('message','Hapus Agenda Rapat Berhasil');
    }

    public function download(Request $id)
    {
        $data = rapat::find($id);
        $data->filename = $filename;
        $path = storage_path($filename);

        return response()->file($pathToFile, $headers);
    }
}
