@extends('admin.layouts.master')

@section('assets')
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/choices.js@9.0.1/public/assets/styles/choices.min.css" />
  <script src="https://cdn.jsdelivr.net/npm/choices.js@9.0.1/public/assets/scripts/choices.min.js"></script>
@endsection

@section('body')
  @if ($errors->any())
    <div class="mb-6 inline-flex w-full bg-white shadow-md rounded-lg overflow-hidden">
      <div class="flex justify-center items-center w-12 bg-red-500">
        <svg class="h-6 w-6 fill-current text-white" viewBox="0 0 40 40" xmlns="http://www.w3.org/2000/svg">
          <path
            d="M20 3.36667C10.8167 3.36667 3.3667 10.8167 3.3667 20C3.3667 29.1833 10.8167 36.6333 20 36.6333C29.1834 36.6333 36.6334 29.1833 36.6334 20C36.6334 10.8167 29.1834 3.36667 20 3.36667ZM19.1334 33.3333V22.9H13.3334L21.6667 6.66667V17.1H27.25L19.1334 33.3333Z" />
        </svg>
      </div>

      <div class="-mx-3 py-2 px-4">
        <div class="mx-3">
          <span class="text-red-500 font-semibold">Error</span>
          <ul class="ml-4 text-black list-disc">
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
      </div>
    </div>
  @endif

  <div class="bg-white overflow-hidden shadow-md sm:rounded-lg">
    <div class="p-6 border-b border-gray-200">
      <form onsubmit="return window.confirm('Yakin ingin submit?')" action="{{ route('admin.borrows.store') }}"
        method="POST" class="flex flex-col flex-wrap text-gray-900">
        @csrf
        @method('POST')

        <div class="my-2">
          <label class="block text-sm text-gray-700">
            Peminjam
          </label>
          <select name="user_id" id="user_id" class="block mt-1 w-full rounded-md form-select focus:border-indigo-600">
            @foreach ($users as $user)
              <option @selected(old('user_id') === $user->id) value="{{ $user->id }}">
                {{ $user->name }}</option>
            @endforeach
          </select>
        </div>

        <div class="my-2">
          <label class="block text-sm text-gray-700">
            Buku
          </label>
          <select name="book_id" id="book_id" class="block mt-1 w-full rounded-md form-select focus:border-indigo-600">
            @foreach ($books as $book)
              <option @selected(old('book_id') === $book->id) value="{{ $book->id }}">
                {{ $book->title }}</option>
            @endforeach
          </select>
        </div>

        <div class="my-2">
          <label class="block text-sm text-gray-700">
            Tenggat
          </label>
          <input type="date" value="{{ old('due') }}" name="due"
            class="block w-full rounded-md form-input focus:border-indigo-600" />
        </div>

        <div class="mt-5 flex gap-3 justify-end">
          <a href="{{ route('admin.borrows.index') }}"
            class="py-2 px-4 text-center bg-yellow-600 rounded-md text-white text-sm hover:bg-yellow-500">
            Kembali
          </a>

          <button type="submit"
            class="py-2 px-4 text-center bg-green-600 rounded-md text-white text-sm hover:bg-green-500">
            Submit
          </button>
        </div>
      </form>
    </div>
  </div>

  <script>
    const user = document.getElementById('user_id');
    const userChoices = new Choices(user, {
      renderChoiceLimit: 3
    });

    const book = document.getElementById('book_id');
    const bookChoices = new Choices(book, {
      renderChoiceLimit: 3
    });
  </script>
@endsection
