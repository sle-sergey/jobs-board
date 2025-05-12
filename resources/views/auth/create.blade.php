<x-layout>
    <h1 class="my-16 text-center text-4xl font-medium text-slate-600">
        Sign In to your account
    </h1>
    <x-card class="py-8 px-16">
        <form action="{{route('auth.store')}}" method="POST">
            @csrf
            <div class="mb-8">
                <x-label for="email" :required="true">E-mail</x-label>
                <x-text-input type="email" name="email"/>
            </div>
            <div class="mb-8>">
                <x-label for="password" :required="true">Password</x-label>
                <x-text-input name="password" type="password"/>
            </div>
            <div class="mb-8 mt-4 flex justify-between text-sm font-medium text-slate-900">
                <div>
                    <div class="flex items-center">
                        <input type="checkbox" name="remember" id="remember" class="mr-1">
                        <label for="remember">Remember Me</label>
                    </div>
                </div>
                <div>
                    <a href="#" class="text-indigo-500 hover:underline">Forgot Password?</a>
                </div>
            </div>
            <x-button class="w-full bg-green-50">Login</x-button>
        </form>
    </x-card>
</x-layout>
