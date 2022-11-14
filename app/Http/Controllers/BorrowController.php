<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\BorrowedBook;
use App\Models\User;
use Illuminate\Http\Request;

class BorrowController extends Controller
{
    public function index(Request $request)
    {
        $borrows = BorrowedBook::query();

        $borrows->when($request->search, function ($borrows) use ($request) {
            $borrows->where(function ($query) use ($request) {
                $query->whereHas('user', function ($user) use ($request) {
                    $user->where('name', 'LIKE', "%{$request->search}%");
                })->orWhereHas('book', function ($book) use ($request) {
                    $book->where('title', 'LIKE', "%{$request->search}%");
                });
            });
        });

        $borrows->when($request->date, function ($borrows) use ($request) {
            $borrows->where(function ($query) use ($request) {
                $query->where('due', $request->date);
            });
        });

        $borrows->when($request->status, function ($borrows) use ($request) {
            $borrows->where(function ($query) use ($request) {
                if ($request->status === 'borrowed') {
                    $query->whereNull('returned_at');
                } else if ($request->status === 'returned') {
                    $query->whereNotNull('returned_at');
                }
            });
        });

        $borrows = $borrows->latest('id')->paginate(50);

        return view('admin.borrows.index')->with([
            'borrows' => $borrows,
        ]);
    }

    public function create()
    {
        $users = User::where('role', User::MEMBER)->latest()->get(['id', 'name']);
        $books = Book::latest()->get(['id', 'title']);

        return view('admin.borrows.create')->with([
            'users' => $users,
            'books' => $books,
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'user_id' => ['required', 'numeric'],
            'book_id' => ['required', 'numeric'],
            'due' => ['required', 'date'],
        ]);

        $data['borrowed_at'] = now('Asia/Jakarta');

        BorrowedBook::create($data);

        return redirect()->route('admin.borrows.index')
            ->with(
                'success',
                'Berhasil menambah data peminjaman'
            );
    }

    public function edit(BorrowedBook $borrow)
    {
        $users = User::where('role', User::MEMBER)->latest()->get(['id', 'name']);
        $books = Book::latest()->get(['id', 'title']);

        return view('admin.borrows.edit')->with([
            'borrow' => $borrow,
            'users' => $users,
            'books' => $books,
        ]);
    }

    public function update(Request $request, BorrowedBook $borrow)
    {
        $data = $request->validate([
            'user_id' => ['required', 'numeric'],
            'book_id' => ['required', 'numeric'],
            'due' => ['required', 'date'],
            'returned_at' => ['nullable'],
        ]);

        $data['returned_at'] = isset($data['returned_at'])
            ? now('Asia/Jakarta')
            : null;

        $borrow->update($data);

        return redirect()->route('admin.borrows.index')
            ->with(
                'success',
                'Berhasil mengedit data peminjaman'
            );
    }

    public function destroy(BorrowedBook $borrow)
    {
        $borrow->delete();

        return redirect()->route('admin.borrows.index')
            ->with(
                'success',
                'Berhasil menghapus data peminjaman'
            );
    }
}
