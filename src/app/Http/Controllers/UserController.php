<?php

namespace App\Http\Controllers;

use App\Enums\UserRoleType;
use App\Filters\UserFilter;
use App\Http\Requests\User\IndexUserRequest;
use App\Http\Requests\User\UpdateUserRequest;
use App\Models\User;
use App\Models\UserRole;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
        $this->authorizeResource(User::class, 'user');
    }

    /**
     * Display a listing of users
     */
    public function index(IndexUserRequest $request)
    {
        $queryParams = $request->validated();
        $filter = app()->make(
            UserFilter::class,
            ['queryParams' => $queryParams]
        );
        $users = User::with('role')
            ->filter($filter)
            ->sort($queryParams)
            ->paginate(6)
            ->withQueryString();
        $roles = UserRole::all();
        return view('users.index', compact('users', 'roles'));
    }

    /**
     * Show the form for editing the user
     */
    public function edit(User $user)
    {
        $roles = UserRole::allRolesExcept(UserRoleType::SuperAdmin)->get();
        if (Auth::user()->hasRole(UserRoleType::Admin)) {
            $adminRoleName = UserRoleType::Admin->value;
            $roles = $roles->reject(function ($role) use ($adminRoleName) {
                return $role->name === $adminRoleName;
            });
        }
        return view('users.edit', compact(['user', 'roles']));
    }

    /**
     * Update the user in storage.
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        $data = $request->validated();
        $this->authorize('update', [$user, $data['role_id']]);
        $user->fill($data)->save();
        return redirect()->route('users.index');
    }

    /**
     * Remove the user from storage.
     */
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('users.index');
    }
}
