<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BookController extends Controller
{
    public function index(Request $request)
    {
        $books = Book::query();

        $books->when($request->search, function ($books) use ($request) {
            $books->where(function ($query) use ($request) {
                $query->where('title', 'LIKE', "%{$request->search}%")
                    ->orWhere('writer', 'LIKE', "%{$request->search}%");
            });
        });

        $books = $books->latest()->paginate(10);

        return view('admin.books.index')->with([
            'books' => $books,
        ]);
    }

    public function create()
    {
        return view('admin.books.create');
    }

    public function store(Request $request)
    {
        $book = $request->validate([
            'title' => ['required', 'string'],
            'writer' => ['required', 'string'],
            'description' => ['required', 'string'],
            'cover' => ['required', 'image', 'max:2048'],
        ]);

        $book['cover'] = $request->file('cover')->store('books');

        Book::create($book);

        return redirect()->route('admin.books.index')
            ->with(
                'success',
                'Berhasil menambah buku'
            );
    }

    public function edit(Book $book)
    {
        return view('admin.books.edit')->with([
            'book' => $book,
        ]);
    }

    public function update(Request $request, Book $book)
    {
        $data = $request->validate([
            'title' => ['required', 'string'],
            'writer' => ['required', 'string'],
            'description' => ['required', 'string'],
        ]);

        if ($request->hasFile('cover')) {
            $request->validate([
                'cover' => ['required', 'image', 'max:2048'],
            ]);

            $data['cover'] = $request->file('cover')->store('books');

            Storage::delete($book->cover);
        }

        $book->update($data);

        return redirect()->route('admin.books.index')
            ->with(
                'success',
                'Berhasil mengedit buku'
            );
    }

    public function destroy(Book $book)
    {
        $book->delete();
        Storage::delete($book->cover);

        return redirect()->route('admin.books.index')
            ->with(
                'success',
                'Berhasil menghapus buku'
            );
    }
}
