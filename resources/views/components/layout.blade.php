<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel Job Board</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>
<body
    class="from-10% via-30% to-90% mx-auto mt-10 max-w-5xl bg-linear-to-r/oklch from-indigo-100 to-teal-100 text-shadow-slate-100">
<nav class="mb-8 flex justify-between text-lg font-medium">
    <ul class="flex space-x-2">
        <li>
            <a href="{{route('jobs.index')}}">Home</a>
        </li>
    </ul>
    <ul class="flex space-x-4">
        @auth
            <li>
                <a href="{{route('my-job-applications.index')}}">
                    {{ auth()->user()->name ?? 'Guest' }}: Applications
                </a>
            </li>
        <li>
            <a href="{{route('my-jobs.index')}}">My Job</a>
        </li>
            <li>
                <form action="{{route('auth.destroy')}}" method="post">
                    @csrf
                    @method('DELETE')
                    <button type="submit">Sign Out</button>
                </form>
            </li>
        @else
            <li>
                <a href="{{route('auth.create')}}">Sign In</a>
            </li>
        @endauth
    </ul>
</nav>

@if(session('success'))
    <div role="alert"
         class="my-8 rounded-md border-l-4 border-green-500 bg-green-100 p-4 text-green-700 opacity-75">
        <p class="font-bold">Success</p>
        <p>{{ session('success') }}</p>
    </div>
@endif

@if(session('error'))
    <div role="alert"
         class="my-8 rounded-md border-l-4 border-red-500 bg-red-100 p-4 text-red-700 opacity-75">
        <p class="font-bold">Error</p>
        <p>{{ session('error') }}</p>
    </div>
@endif


{{ $slot }}
</body>
</html>
