<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\UserCreateRequest;
use App\Http\Requests\UserUpdateRequest;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class UsersController extends Controller
{
    public function __construct()
    {
        //Перенесли в маршруты
//        $this->middleware('can:admin-panel');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $query = User::orderByDesc('id');
        if (!empty($value = $request['id'])){
            $query->where('id', $value);
        }
        if (!empty($value = $request->get('name'))){
            $query->where('name', 'like', '%'.$value.'%');
        }
        if (!empty($value = $request->get('email'))){
            $query->where('email', 'like', '%'.$value.'%');
        }
        if (!empty($value = $request->get('status'))){
            $query->where('status', $value);
        }
        if (!empty($value = $request->get('role'))){
            $query->where('role', $value);
        }
        $users = $query->paginate();

        $roles = [
            User::ROLE_ADMIN => 'Admin',
            User::ROLE_USER => 'User'
        ];
        $statuses = [
            User::STATUS_ACTIVE => 'Active',
            User::STATUS_WAIT => 'Waiting'
        ];
//        $users = User::orderBy('id', 'desc')->paginate();
        return view('admin.users.index', compact(['users', 'statuses', 'roles']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserCreateRequest $request)
    {
        //Это перенесли в реквест
//        $data = $this->validate($request, [
//            'name' => 'required|string|max:255',
//            'email' => 'required|string|email|max:255|unique:users'
//        ]);
//        $data['status'] = User::STATUS_ACTIVE;


        $user = User::create($request->only(['name', 'email']) + [
                'password' => bcrypt(Str::random()),
                'status' => User::STATUS_ACTIVE,
            ]);
        return redirect()->route('admin.users.show', ['id' => $user->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $user = User::findOrFail($id);
        return view('admin.users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $user = User::findOrFail($id);
        $roles = [
            User::ROLE_ADMIN => 'Admin',
            User::ROLE_USER => 'User'
        ];
        $statuses = [
            User::STATUS_ACTIVE => 'Active',
            User::STATUS_WAIT => 'Waiting'
        ];
        return view('admin.users.edit', compact(['user', 'statuses', 'roles']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserUpdateRequest $request, $id)
    {
        //
        $user = User::findOrFail($id);

//        $data = $this->validate($request, [
//            'name' => 'required|string|max:255',
//            'email' => 'required|string|email|max:255|unique:users,id,'.$user->id,
//            'status' => ['required', 'string', Rule::in([User::STATUS_WAIT, User::STATUS_ACTIVE])]
//        ]);

        $user->update($request->only('name', 'email', 'status'));

        return redirect()->route('admin.users.show', ['id' => $user->id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $user = User::findOrFail($id);
        $user->delete();
    }

    public function verify(User $user)
    {
        $user->verify();
        return redirect()->route('admin.users.show', $user);

    }
}
