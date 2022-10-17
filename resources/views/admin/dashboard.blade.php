@extends('admin.layouts.master')

@section('body')
  <h3 class="mb-6 text-gray-700 text-3xl font-medium">Dashboard</h3>

  <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
    <div class="p-6 border-b border-gray-200">
      {{ __('You are logged in!') }}
    </div>
  </div>
@endsection
