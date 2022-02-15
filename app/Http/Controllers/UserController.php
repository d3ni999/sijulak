<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\User;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Validator;

class UserController extends Controller
{
    public function index()
    {
        $users = User::with('role')->orderBy('id', 'desc')->get();
        return view('user.index', ['data' => $users]);
    }

    public function create()
    {
        $roles = Role::all();
        return view('user.create', [
            'roles' => $roles,
        ]);
    }
    public function show($id)
    {
        if (Auth::user()->id != 1) {
            if (Auth::user()->id != $id) {
                return redirect()->back()->with('message', \GeneralHelper::format_message('Jangan Memanipulasi Data !', 'warning'));
            }
        }
        $roles = Role::all();
        $user = User::findOrFail($id);
        return view('user.edit', [
            'user' => $user,
            'roles' => $roles,
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|unique:users',
            'password' => 'min:6|required',
            'name' => 'required|string|max:255',
            'role' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput()
                ->with('message', \GeneralHelper::format_message('Silahkan periksa inputan !', 'danger'));
        }

        $user = User::create([
            'email' => $request->email,
            'name' => ucwords($request->name),
            'password' => bcrypt($request->password),
            'role_id' => $request->role,
        ]);

        return redirect()->route('user')->with('message', \GeneralHelper::format_message('Berhasil menyimpan data !', 'success'));
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'email' => [
                'required',
                Rule::unique('users')->ignore($id),
            ],
            'name' => 'required',
            'role' => 'required',
        ]);

        if (isset($request->password)) {
            $validator = Validator::make($request->all(), [
                'password' => 'min:6|required',
            ]);
        }

        $user = User::findOrFail($id);

        if ($validator->fails()) {
            return redirect()->route('user.show', ['id' => $user->id])
                ->withErrors($validator)
                ->withInput()
                ->with('message', \GeneralHelper::format_message('Gagal! Silahkan periksa inputan anda', 'danger'));
        }

        //untuk menghindari kecurangan user selain admin
        $role = ((Auth::user()->role_id != 1) ? Auth::user()->role_id : $request->role);

        $user->email = $request->email;
        $user->name = $request->name;
        $user->role_id = $role;
        if (isset($request->password)) {
            $user->password = bcrypt($request->password);
        }
        $user->save();

        return back()->with('message', \GeneralHelper::format_message('Berhasil update data !', 'info'));
    }

    public function destroy(Request $request, $id)
    {
        if ($id == 1) {
            return redirect()->route('user')->with('message', \GeneralHelper::format_message('User ini tidak dapat dihapus. hubungi pengembang!', 'danger'));
        }

        $user = User::find($id);
        $user->delete();

        return redirect()->route('user')->with('message', \GeneralHelper::format_message('Berhasil menghapus!', 'info'));
    }
}
