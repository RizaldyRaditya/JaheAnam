<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    function index(){
        $user = User::all();
        return view('admin.user', ['user'=>$user]);
    }

    function destroy(User $user){
        $user->delete();
        return redirect()->route('user')->with('pesan', "hapus data $user->name berhasil");
    }

    public function edit(Request $request, $id){
    // Validate the request data
    $validatedData = $request->validate([
        'name' => 'required',
        'email' => 'required|email',
        'alamat' => 'required',
        'telp' => 'required',
    ]);

    // Fetch the user from the database based on the provided $id
    $user = User::findOrFail($id);

    // // Check if the provided email address already exists for a different user
    // if ($user->email !== $validatedData['email'] && User::where('email', $validatedData['email'])->exists()) {
    //     return redirect()->back()->withInput()->withErrors(['email' => 'The email address is already taken.']);
    // }

    // Update user properties
    $user->name = $validatedData['name'];
    $user->email = $validatedData['email'];
    $user->alamat = $validatedData['alamat'];
    $user->telp = $validatedData['telp'];
    $user->save();

    return redirect()->route('user');
}


}
