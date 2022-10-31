<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class LibrarianController extends Controller
{
    public function index(Request $request)
    {
        $librarians = User::where('role', User::LIBRARIAN);

        $librarians->when($request->search, function ($librarians) use ($request) {
            $librarians->where(function ($query) use ($request) {
                $query->where('name', 'LIKE', "%{$request->search}%")
                    ->orWhere('username', 'LIKE', "%{$request->search}%")
                    ->orWhere('phone', 'LIKE', "%{$request->search}%");
            });
        });

        $librarians = $librarians->latest()->paginate(10);

        return view('admin.librarians.index')->with([
            'librarians' => $librarians,
        ]);
    }

    public function create()
    {
        return view('admin.librarians.create');
    }

    public function store(Request $request)
    {
        $credentials = $request->validate([
            'name' => ['required', 'string'],
            'username' => ['required', 'string'],
            'phone' => ['required', 'string'],
        ]);

        $credentials['role'] = User::LIBRARIAN;

        $password = "librarian-{$credentials['username']}";
        $credentials['password'] = Hash::make($password);

        User::create($credentials);

        return redirect()->route('admin.librarians.index')
            ->with(
                'success',
                "Berhasil menambah pustakawan. <br />
                Username: {$credentials['username']} <br />
                Password: $password <br />"
            );
    }

    public function edit(User $librarian)
    {
        abort_if($librarian->role !== User::LIBRARIAN, 404);

        return view('admin.librarians.edit')->with([
            'librarian' => $librarian,
        ]);
    }

    public function update(Request $request, User $librarian)
    {
        abort_if($librarian->role !== User::LIBRARIAN, 404);

        $credentials = $request->validate([
            'name' => ['required', 'string'],
            'username' => ['required', 'string'],
            'phone' => ['required', 'string'],
        ]);

        $credentials['role'] = User::LIBRARIAN;

        $password = "librarian-{$credentials['username']}";
        $credentials['password'] = Hash::make($password);

        $librarian->update($credentials);

        return redirect()->route('admin.librarians.index')
            ->with(
                'success',
                "Berhasil mengedit pustakawan. <br />
                Username: {$credentials['username']} <br />
                Password: $password <br />"
            );
    }

    public function destroy(User $librarian)
    {
        abort_if($librarian->role !== User::LIBRARIAN, 404);

        $librarian->delete();

        return redirect()->route('admin.librarians.index')
            ->with(
                'success',
                'Berhasil menghapus pustakawan.'
            );
    }
}
