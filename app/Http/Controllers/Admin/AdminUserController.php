<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

// Manage other admin accounts (create + delete).
class AdminUserController extends Controller
{
    public function index()
    {
        $admins = Admin::orderBy('id', 'desc')->paginate(10);
        return view('admin.admins.index', compact('admins'));
    }

    public function create()
    {
        return view('admin.admins.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:admins,email',
            'password' => 'required|min:6|confirmed',
        ]);

        Admin::create([
            'name'     => $data['name'],
            'email'    => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        return redirect()->route('admin.admins.index')
            ->with('success', 'Admin account created.');
    }

    public function destroy($id)
    {
        // Prevent admin from deleting their own account.
        if (Auth::guard('admin')->id() == $id) {
            return back()->with('error', "You can't delete your own account.");
        }

        $admin = Admin::findOrFail($id);
        $admin->delete();
        return back()->with('success', 'Admin deleted.');
    }
}
