<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Http\Presenters\Backend\Users\UsersIndexPresenter;
use \Auth as Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $presenter = new UsersIndexPresenter();

        return view("backend.users.index", ["title" => "Users",
                                    "presenter" => $presenter]
        );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $roles = UserRoleDefinitions::map();

        return view("backend.users.create", ["title" => "Add User",
                                    "roles" => $roles]
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        $user = new User();

        $this->saveUser($request, $user);

        return redirect(app()->make('urls')->getUrlUsers());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        $roles = UserRoleDefinitions::map();

        return view("backend.users.edit", ["title" => "Edit User #" . $user->id,
                                    "user" => $user,
                                    "roles" => $roles]
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        $user = User::find($id);

        $this->saveUser($request, $user);

        return redirect(app()->make('urls')->getUrlUsers());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
    }

    /**
     * Save user
     *
     * @param Request $request
     * @param User $user
     *
     * @return void
     */
    private function saveUser(Request $request, User $user) {

        $user->name = $request->input("name");
        $user->email = $request->input("email");
        $user->password = bcrypt($request->input("password"));
        $user->role = $request->input("role");

        $user->save();
    }

}