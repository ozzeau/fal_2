<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\PostsController;
use App\Http\Controllers\usersController;


class AdminsController extends Controller
{
    //
    public function index()
    {
        $data = PostsController::all();
        return view('admin.home', compact('data'));
    }
    public function infoPost($id, $usr_id)
    {
        $data = PostsController::infopost($id, $usr_id);
        return view('admin.PostInfo', compact('data'));
    }
    public function deletePost(Request $request, $id)
    {

        return PostsController::deletePost($request, $id);
    }
    public function  deleteUser(Request $request, $id)
    {

        return usersController::deleteUser($request, $id);
    }

    public function  deleteAdmin(Request $request, $id)
    {

        return usersController::deleteAdmin($request, $id);
    }

    public function AllUsers()
    {
        $data = usersController::allUsers();
        return view("admin.users", compact('data'));
    }
    public function  AllAdmins()
    {
        $data = usersController::allAdmins();
        return view("admin.admins", compact('data'));
    }
    public function adminAdd()
    {
        return view("admin.add");
    }
}
