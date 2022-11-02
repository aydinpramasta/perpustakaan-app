@extends('admin.layouts.master')

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
      <form enctype="multipart/form-data" onsubmit="return window.confirm('Yakin ingin submit?')"
        action="{{ route('admin.books.store') }}" method="POST" class="flex flex-col flex-wrap text-gray-900">
        @csrf
        @method('POST')

        <div class="my-2">
          <label class="block text-sm text-gray-700">
            Judul
          </label>
          <input value="{{ old('title') }}" name="title"
            class="block w-full rounded-md form-input focus:border-indigo-600" />
        </div>

        <div class="my-2">
          <label class="block text-sm text-gray-700">
            Penulis
          </label>
          <input value="{{ old('writer') }}" name="writer"
            class="block w-full rounded-md form-input focus:border-indigo-600" />
        </div>

        <div class="my-2">
          <label class="block text-sm text-gray-700">
            Cover &nbsp;<small>max: 2MB</small>
          </label>
          <input type="file" name="cover" accept="image/*"
            class="block w-full rounded-md form-input focus:border-indigo-600" />
        </div>

        <div class="my-2">
          <label class="block text-sm text-gray-700">
            Deskripsi
          </label>
          <textarea rows="10" name="description" id="description"
            class="block w-full rounded-md form-textarea focus:border-indigo-600">{{ old('description') }}</textarea>
        </div>

        <div class="mt-5 flex gap-3 justify-end">
          <a href="{{ route('admin.books.index') }}"
            class="py-2 px-4 text-center bg-yellow-600 rounded-md text-white text-sm hover:bg-yellow-500">
            Kembali
          </a>

          <button type="submit"
            class="py-2 px-4 text-center bg-green-600 rounded-md text-white text-sm hover:bg-green-500">
            Submit
          </button>
        </div>
    </div>
  </div>
@endsection
