<?php

namespace App\Http\Controllers;

use App\Mail\WelcomeMail;
use App\Models\Admin;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $admins = Admin::with("user")->paginate('10');

        return view('admin.admins.index', compact("admins"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.admins.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate([
            'name' => "required|string",
            "email" => "required|email|unique:users,email",
            "position" => "required|string"
        ]);

        $password =  Str::random(10);
        $hashPassword = Hash::make($password);
        $user =     User::create([
            'name' => $request->name,
            'email' => $request->email,
            "password" => $hashPassword,
            "type" => "admin"
        ]);

        Admin::create([
            "position" => $request->position,
            "user_id" => $user->id,
        ]);

        Mail::to($user->email)->send(new WelcomeMail($user, $password));

        return redirect()->back()->with("success", "Send Mail Successfully");
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {

        $admin = Admin::with("user")->where("id", $id)->first();

        return view('admin.admins.show', compact('admin'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {

        $admin = Admin::with("user")->where("id", $id)->first();

        return view('admin.admins.edit', compact('admin'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $admin = Admin::with("user")->where("id", $id)->first();
        $user_id = $admin->user->id;
        $request->validate([
            'name' => "required|string",
            "email" => "required|email|unique:users,email,$user_id",
            "position" => "required|string"
        ]);

        $admin->user->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        $admin->update([
            "position" => $request->position,
        ]);



        return redirect()->route('admin.index')->with("success", "Update Successfully");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $admin = Admin::with("user")->where("id", $id)->first();
        $user  = User::where('id', $admin->user->id);
        $old_image = $user->image;
        $old_image_path = public_path('upload/') .  $old_image;
        unlink($old_image_path);
        $admin->delete();
        $user->delete();
        return redirect()->route('admin.index')->with("success", "Delet Successfully");
    }
}
