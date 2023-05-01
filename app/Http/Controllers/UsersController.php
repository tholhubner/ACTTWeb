<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Inertia\Response
     */
    public function index(): Response
    {
        return Inertia::render('Users/Index', [
            'users' => User::latest()->paginate(10),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Inertia\Response
     */
    public function create()
    {
        return Inertia::render('Users/Create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param $request
     * @return \Inertia\Response
     */
    public function store(Request $request): RedirectResponse
    {
        $user->create(array_merge($request->validated(), [
            'password' => 'test'
        ]));

        return redirect(route('users.index'))
            ->with('success', 'User created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param $user
     * @return \Inertia\Response
     */
    public function show(User $user)
    {
        return Inertia::Render('Users/Show', [
            'user' => $user
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param $user
     * @return \Inertia\Response
     */
    public function edit(User $user)
    {
        return Inertia::Render('Users/Edit', [
            'user' => $user,
            'userRole' => $user->roles->pluch('name')->toArray(),
            'roles' => Role::latest()->get()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param $request, $user
     * @return \Inertia\Response
     */
    public function update(Request $request, User $user): RedirectResponse
    {
        $user->update($request->validated());
        $user->syncRoles($request->get('role'));

        return redirect(route('users.index'))
            ->with('success', 'User updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $user
     * @return \Inertia\Response
     */
    public function destroy(User $user): RedirectResponse
    {
        $user->delete();

        return redirect(route('users.index'))
            ->with('success', 'User deleted successfully.');
    }
}
