
<!DOCTYPE html>
<html lang="en">
  <head>
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Macareux</title>
  @vite('resources/css/app.css')
  </head>
  <body>
  <div class="main min-h-screen [&::-webkit-scrollbar]:w-1 [&::-webkit-scrollbar-track]:bg-gray-100">
    <nav class="sticky top-0 z-10">
    <div class="navbar bg-primary text-primary-content">
        <div class="flex-1">
        <a class="btn btn-ghost text-2xl font-bold">Macareux</a>
        </div>
        <div class="flex-none">
        <ul class="menu menu-horizontal px-1 text-xl font-semibold gap-4">
        <li><a class="hover:bg-indigo-200 {{request()->routeIs('home') ? 'font-bold bg-indigo-300' : ''}}" href={{route('home')}}>Upload CSV</a></li>
        <li><a class="hover:bg-indigo-200 {{request()->routeIs('data') ? 'font-bold bg-indigo-300' : ''}}" href={{route('data')}}>View Data</a></li>
        </ul>
        </div>
    </div>
    </nav>
    <div class="container mx-auto py-8 min-h-[calc(100vh-140px)]">
    @yield('content')
    </div>
    <footer class="navbar bg-primary text-primary-content">
      <div class="w-full place-content-center text-md font-bold">
          © 2025 Macareux
      </div>
    </footer>
  </div>
  </body>
</html>
