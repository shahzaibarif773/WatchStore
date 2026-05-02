<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
{
    public function index(): View
    {
        return view('admin.users.index');
    }

    public function data(): JsonResponse
    {
        $query = User::query()->withCount('orders')->latest();

        return DataTables::eloquent($query)
            ->editColumn('is_admin', fn (User $user): string => $user->is_admin ? 'Yes' : 'No')
            ->addColumn('actions', function (User $user): string {
                $editUrl = route('admin.users.edit', $user);
                $deleteUrl = route('admin.users.destroy', $user);

                return '<div class="flex gap-2">'
                    . '<a href="' . $editUrl . '" class="rounded bg-slate-900 px-2 py-1 text-xs text-white">Edit</a>'
                    . '<form method="POST" action="' . $deleteUrl . '">'
                    . csrf_field() . method_field('DELETE')
                    . '<button type="submit" class="rounded bg-red-600 px-2 py-1 text-xs text-white" onclick="return confirm(\'Delete this user?\')">Delete</button>'
                    . '</form>'
                    . '</div>';
            })
            ->rawColumns(['actions'])
            ->toJson();
    }

    public function edit(User $user): View
    {
        return view('admin.users.edit', compact('user'));
    }

    public function update(Request $request, User $user): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email,' . $user->id],
            'is_admin' => ['nullable', 'boolean'],
        ]);

        $user->update([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'is_admin' => (bool) ($validated['is_admin'] ?? false),
        ]);

        return redirect()->route('admin.users.index')->with('success', 'User updated successfully.');
    }

    public function destroy(User $user): RedirectResponse
    {
        if (auth()->id() === $user->id) {
            return redirect()->route('admin.users.index')->with('error', 'You cannot delete your own account.');
        }

        $user->delete();

        return redirect()->route('admin.users.index')->with('success', 'User deleted successfully.');
    }
}
