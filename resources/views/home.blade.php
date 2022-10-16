<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>E-Perpustakaan</title>
</head>

<body>
  <center>
    @if (in_array(auth()->user()?->role, ['admin', 'pustakawan']))
      <a href="{{ route('admin.dashboard') }}">Ke Dashboard</a>
    @endif

    <h1>Selamat Datang!</h1>

    @auth
      <form action="{{ route('logout') }}" method="POST">
        @csrf
        @method('DELETE')

        <button type="submit">Keluar</button>
      </form>
    @endauth

    @guest
      <a href="{{ route('login') }}">Login</a>
    @endguest
  </center>
</body>

</html>
