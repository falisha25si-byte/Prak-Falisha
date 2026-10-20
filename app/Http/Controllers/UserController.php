<?php


namespace App\Http\Controllers;


use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;


class UserController extends Controller
{
    public function index()
    {
        $data['dataUser'] = User::all();


        return view('admin.user.index', $data);
    }


    public function create()
    {
        return view('admin.user.create');
    }


    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8|confirmed',
        ]);


        $data['password'] = Hash::make($request->password);


        User::create($data);


        return redirect()->route('user.index')
            ->with('success', 'Data User Berhasil Ditambahkan!');
    }


    public function show(string $id)
    {
        //
    }


    public function edit(string $id)
    {
        $data['dataUser'] = User::findOrFail($id);


        return view('admin.user.edit', $data);
    }


    public function update(Request $request, string $id)
    {
        $user = User::findOrFail($id);


        $data = $request->validate([
            'name' => 'required|string|max:100',
            'email' => [
                'required',
                'email',
                Rule::unique('users', 'email')->ignore($user->id),
            ],
            'password' => 'nullable|min:8|confirmed',
        ]);


        if (!empty($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        } else {
            unset($data['password']);
        }


        $user->update($data);


        return redirect()->route('user.index')
            ->with('success', 'Perubahan Data User Berhasil!');
    }


    public function destroy(string $id)
    {
        $user = User::findOrFail($id);


        $user->delete();


        return redirect()->route('user.index')
            ->with('success', 'Data User Berhasil Dihapus!');
    }
}
