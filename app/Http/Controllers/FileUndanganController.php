<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\FileUndangan;
use App\User;
use Auth;
use File;
use Illuminate\Http\Request;
use Validator;

class FileUndanganController extends Controller
{
    public function index()
    {
        $file = FileUndangan::orderBy('id', 'desc')->get();
        return view('file-undangan.index', ['data' => $file]);
    }

    public function create()
    {
        return view('file-undangan.create');
    }
    public function show($id)
    {
        if (Auth::user()->id != 1) {
            if (Auth::user()->id != $id) {
                return redirect()->back()->with('message', \GeneralHelper::format_message('Jangan Memanipulasi Data !', 'warning'));
            }
        }
        $file = FileUndangan::findOrFail($id);
        return view('file-undangan.edit', [
            'file' => $file,
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'file' => 'mimes:doc,pdf,docx,application/vnd.openxmlformats-officedocument.wordprocessingml.document|required|max:5000',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput()
                ->with('message', \GeneralHelper::format_message('Silahkan periksa inputan !', 'danger'));
        }
        $file = $request->file('file');
        $ext = $file->extension();
        $name = str_replace(' ', '-', $request->name) . '-' . uniqid();
        $filename = $name . '.' . $ext;
        // dd(public_path('assets/file-undangan/') . $filename);

        $file->move(public_path('assets/file-undangan/'), $filename);

        $data = FileUndangan::create([
            'name' => ucwords($request->name),
            'file' => $filename,
        ]);

        return redirect()->route('file-undangan')->with('message', \GeneralHelper::format_message('Berhasil menyimpan data !', 'success'));
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
        ]);

        if (isset($request->file)) {
            $validator = Validator::make($request->all(), [
                'file' => 'max:5000|mimes:doc,pdf,docx,application/vnd.openxmlformats-officedocument.wordprocessingml.document|required',
            ]);
        }

        $data = FileUndangan::findOrFail($id);

        if ($validator->fails()) {
            return redirect()->route('file-undangan.show', ['id' => $data->id])
                ->withErrors($validator)
                ->withInput()
                ->with('message', \GeneralHelper::format_message('Gagal! Silahkan periksa inputan anda', 'danger'));
        }

        $data->name = $request->name;
        if (isset($request->file)) {
            //delete file
            File::delete('assets/file-undangan/' . $data->file);
            //create file
            $file = $request->file('file');
            $ext = $file->extension();
            $name = str_replace(' ', '-', $request->name) . '-' . uniqid();
            $filename = $name . '.' . $ext;
            // dd(public_path('assets/file-undangan/') . $filename);

            $file->move(public_path('assets/file-undangan/'), $filename);

            $data->file = $filename;
        }
        $data->save();

        return back()->with('message', \GeneralHelper::format_message('Berhasil update data !', 'info'));
    }

    public function destroy(Request $request, $id)
    {

        $data = FileUndangan::find($id);
        File::delete('assets/file-undangan/' . $data->file);
        $data->delete();

        return redirect()->route('file-undangan')->with('message', \GeneralHelper::format_message('Berhasil menghapus!', 'info'));
    }
}
