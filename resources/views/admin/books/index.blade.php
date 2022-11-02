@extends('admin.layouts.master')

@section('body')
  <div class="flex justify-between">
    <h3 class="text-gray-700 text-3xl font-medium">Buku</h3>

    <a href="{{ route('admin.books.create') }}"
      class="py-2 px-4 text-center bg-green-600 rounded-md text-white text-sm hover:bg-green-500">
      Tambah
    </a>
  </div>

  @if ($message = session()->get('success'))
    <div class="mt-8 inline-flex w-full bg-white shadow-md rounded-lg overflow-hidden">
      <div class="flex justify-center items-center w-12 bg-green-500">
        <svg class="h-6 w-6 fill-current text-white" viewBox="0 0 40 40" xmlns="http://www.w3.org/2000/svg">
          <path
            d="M20 3.33331C10.8 3.33331 3.33337 10.8 3.33337 20C3.33337 29.2 10.8 36.6666 20 36.6666C29.2 36.6666 36.6667 29.2 36.6667 20C36.6667 10.8 29.2 3.33331 20 3.33331ZM16.6667 28.3333L8.33337 20L10.6834 17.65L16.6667 23.6166L29.3167 10.9666L31.6667 13.3333L16.6667 28.3333Z" />
        </svg>
      </div>

      <div class="-mx-3 py-2 px-4">
        <div class="mx-3">
          <span class="text-green-500 font-semibold">Success</span>
          <p class="text-gray-600 text-sm">{!! $message !!}</p>
        </div>
      </div>
    </div>
  @endif

  <div class="mt-8 flex justify-center flex-1">
    <form action="{{ route('admin.books.index') }}" class="relative w-full">
      <button type="submit" class="absolute inset-y-0 flex items-center pl-2">
        <svg class="w-4 h-4" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
          <path fill-rule="evenodd"
            d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
            clip-rule="evenodd"></path>
        </svg>
      </button>
      <input name="search" value="{{ request()->input('search') ?? '' }}"
        class="w-full pl-8 pr-2 text-sm text-gray-700 border-0 placeholder-gray-600 bg-gray-50 rounded-md shadow focus:bg-white focus:border-gray-300 focus:outline-none form-input"
        type="text" placeholder="Search" aria-label="Search" />
    </form>
  </div>

  <div class="flex flex-col mt-3">
    <div class="-my-2 py-2 overflow-x-auto sm:-mx-6 sm:px-6 lg:-mx-8 lg:px-8">
      <div class="align-middle inline-block min-w-full shadow overflow-hidden sm:rounded-lg border-b border-gray-200">
        <table class="min-w-full">
          <thead>
            <tr>
              <th
                class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                Judul</th>
              <th
                class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                Penulis</th>
              <th class="px-6 py-3 border-b border-gray-200 bg-gray-50"></th>
            </tr>
          </thead>

          <tbody class="bg-white">
            @foreach ($books as $book)
              <tr>
                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                  <div class="text-sm leading-5 font-medium text-gray-900">{{ $book->title }}</div>
                </td>

                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                  <div class="text-sm leading-5 text-gray-900">{{ $book->writer }}</div>
                </td>

                <td
                  class="px-6 py-4 md:flex md:flex-wrap md:gap-4 whitespace-no-wrap text-right border-b border-gray-200 text-sm leading-5 font-medium">
                  <a href="{{ route('admin.books.edit', ['book' => $book->id]) }}"
                    class="text-indigo-600 hover:text-indigo-900">Edit</a>
                  <form onsubmit="return window.confirm('Anda yakin?')"
                    action="{{ route('admin.books.destroy', ['book' => $book->id]) }}" method="POST">
                    @csrf
                    @method('DELETE')

                    <button type="submit" class="text-red-600 hover:text-red-900">Delete</button>
                  </form>
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>

        <div class="flex flex-col xs:flex-row justify-between px-5 py-5 bg-white border-t">
          {{ $books->links() }}
        </div>
      </div>
    </div>
  </div>
@endsection
