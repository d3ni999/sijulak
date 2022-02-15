<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\JadwalKegiatan;
use App\Models\JadwalKegiatanDetail;
use App\User;
use Auth;
use Illuminate\Http\Request;
use Validator;

class JadwalKegiatanController extends Controller
{
    public function index(Request $request)
    {
        if (isset($request->filter)) {
            $getData = explode('-', $request->filter);

            $start = date('Y-m-d', strtotime(trim($getData[0])));
            $end = date('Y-m-d', strtotime(trim($getData[1])));
            $jadwal = JadwalKegiatan::whereDate('waktu', '>=', $start)
                ->whereDate('waktu', '<=', $end)
                ->orderBy('waktu', 'asc')
                ->get();
            $request->session()->flash('message', \GeneralHelper::format_message('Filter: ' . $start . ' sampai ' . $end, 'info'));

        } else {
            $jadwal = JadwalKegiatan::orderBy('waktu', 'asc')->get();
        }
        return view('jadwal-kegiatan.index', ['data' => $jadwal]);
    }

    public function create()
    {
        $userOpd = User::where('role_id', 3)->get();
        return view('jadwal-kegiatan.create', [
            'userOpd' => $userOpd,
        ]);
    }

    public function edit($id)
    {
        if (Auth::user()->id != 1) {
            if (Auth::user()->id != $id) {
                return redirect()->back()->with('message', \GeneralHelper::format_message('Jangan Memanipulasi Data !', 'warning'));
            }
        }
        $jadwal = JadwalKegiatan::findOrFail($id);
        $userOpd = User::where('role_id', 3)->get();
        return view('jadwal-kegiatan.edit', [
            'jadwal' => $jadwal,
            'userOpd' => $userOpd,
        ]);
    }

    public function show($id)
    {
        // if (Auth::user()->id != 1) {
        //     if (Auth::user()->id != $id) {
        //         return redirect()->back()->with('message', \GeneralHelper::format_message('Jangan Memanipulasi Data !', 'warning'));
        //     }
        // }
        $jadwal = JadwalKegiatan::findOrFail($id);
        return view('jadwal-kegiatan.view', [
            'jadwal' => $jadwal,
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'waktu' => 'required|date',
            'kegiatan' => 'required|string|max:255',
            'tempat_acara' => 'required|string|max:255',
            'leading_sektor' => 'required|string|max:255',
            'pakaian' => 'required|string|max:255',
            'keterangan' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput()
                ->with('message', \GeneralHelper::format_message('Silahkan periksa inputan !', 'danger'));
        }

        $waktu = date('Y-m-d H:i:s', strtotime($request->waktu));
        $data = JadwalKegiatan::create([
            'waktu' => $waktu,
            'kegiatan' => $request->kegiatan,
            'tempat_acara' => $request->tempat_acara,
            'leading_sektor' => $request->leading_sektor,
            'pakaian' => $request->pakaian,
            'keterangan' => $request->keterangan,
        ]);

        if ($data) {
            for ($i = 0; $i < count($request->opd); $i++) {
                JadwalKegiatanDetail::create([
                    'kegiatan_id' => $data->id,
                    'user_id' => $request->opd[$i],

                ]);
            }
        }

        return redirect()->route('jadwal-kegiatan')->with('message', \GeneralHelper::format_message('Berhasil menyimpan data !', 'success'));
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'waktu' => 'required|date',
            'kegiatan' => 'required|string|max:255',
            'tempat_acara' => 'required|string|max:255',
            'leading_sektor' => 'required|string|max:255',
            'pakaian' => 'required|string|max:255',
            'keterangan' => 'required',
        ]);

        $data = JadwalKegiatan::findOrFail($id);

        if ($validator->fails()) {
            return redirect()->route('jadwal-kegiatan.edit', ['id' => $data->id])
                ->withErrors($validator)
                ->withInput()
                ->with('message', \GeneralHelper::format_message('Gagal! Silahkan periksa inputan anda', 'danger'));
        }

        $data->waktu = date('Y-m-d h:i:s', strtotime($request->waktu));
        $data->kegiatan = $request->kegiatan;
        $data->tempat_acara = $request->tempat_acara;
        $data->leading_sektor = $request->leading_sektor;
        $data->pakaian = $request->pakaian;
        $data->keterangan = $request->keterangan;
        if ($data->save()) {
            for ($i = 0; $i < count($request->opd); $i++) {
                JadwalKegiatanDetail::updateOrCreate([
                    'kegiatan_id' => $data->id,
                    'user_id' => $request->opd[$i],
                ]);
            }
        }

        return back()->with('message', \GeneralHelper::format_message('Berhasil update data !', 'info'));
    }

    public function changeStatus(Request $request, $id)
    {
        // jika selain admin maka validasi user_id == user login
        // validasi waktu abses == now()
        $data = JadwalKegiatanDetail::findOrFail($id);
        if (Auth::user()->role_id == 1) {
            $data->absen = $request->absen;
            $data->keterangan = $request->keterangan;
            $data->save();
            return back()->with('message', \GeneralHelper::format_message('Berhasil update data !', 'info'));
        } else {
            if (Auth::user()->id != $data->user_id) {
                return back()->with('message', \GeneralHelper::format_message('Ketahuan Manipulasi Data! Update data anda sendiri.', 'danger'));
            } else {
                $data->absen = $request->absen;
                $data->keterangan = $request->keterangan;
                $data->save();
                return back()->with('message', \GeneralHelper::format_message('Berhasil update data !', 'info'));
            }
        }
    }

    public function destroy(Request $request, $id)
    {

        $data = JadwalKegiatan::find($id);
        $data->delete();

        return redirect()->route('jadwal-kegiatan')->with('message', \GeneralHelper::format_message('Berhasil menghapus!', 'info'));
    }

    public function destroyDetail(Request $request, $id)
    {

        $data = JadwalKegiatanDetail::find($id);
        $data->delete();

        return back()->with('message', \GeneralHelper::format_message('Berhasil menghapus!', 'info'));
    }
}
