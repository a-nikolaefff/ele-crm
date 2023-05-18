<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\UpdateUserRequest;
use App\Models\User;
use App\Models\UserRole;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Arr;

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
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $sortableColumns = [
            'name' => 'name',
            'role' => 'role_id',
            'email' => 'email',
            'email-verification' => 'email_verified_at',
            'registration' => 'created_at',
        ];
        $defaultSortKey = 'name';
        $sortKey = $request->query('sort', $defaultSortKey);
        $sortColumn = Arr::get(
            $sortableColumns,
            $sortKey,
            $sortableColumns[$defaultSortKey]
        );

        $sortDirection = $request->query('direction', 'asc');

        $users = User::orderBy($sortColumn, $sortDirection)->paginate(10)
            ->withQueryString();;
        return view('users.index', compact('users'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        $isSuperAdmin = $user->isSuperAdmin();
        $roles = $isSuperAdmin ? UserRole::getSuperAdmin()
            : UserRole::getAllExceptSuperAdmin();
        return view('users.edit', compact(['user', 'roles', 'isSuperAdmin']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        $data = $request->validated();

        // Protection against setting the user to the role of super admin
        if (isset($data['role_id'])
            && UserRole::isSuperAdminRoleId($data['role_id'])
        ) {
            return redirect()->back()->withErrors(
                ['role_id' => __('users.super-admin-role')]
            );
        }

        // Protection against deprivation of the role of super admin
        if ($user->isSuperAdmin()) {
            unset($data['role_id']);
        }

        $user->fill($data)->save();
        return redirect()->route('users.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('users.index');
    }
}
