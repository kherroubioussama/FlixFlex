@extends('layouts.main')

@section('content')
<div class="pr-4 pl-4">
    <div class="flex flex-col items-center justify-center ">
        <div class="w-full max-w-sm">
            <span class="text-2xl font-light ">Create new  account</span>
            <div class="mt-4 bg-white shadow-md rounded-lg text-left">
                <div class="h-2 bg-indigo-500 rounded-t-md"></div>
                <form method="POST" action="{{ route('register') }}" class="w-full max-w-sm mt-10 px-6 py-8 bg-white rounded-lg shadow-md">
                    @csrf
                    <h2 class="text-center text-2xl font-bold text-gray-900 mb-6">Register</h2>
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="name">
                            Name
                        </label>
                        <input class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('name') is-invalid @enderror" id="name" type="text" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                        @error('name')
                        <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                      @enderror
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="email">
                            Email
                        </label>
                        <input class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('email') is-invalid @enderror" id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="email">
                        @error('email')
                        <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                      @enderror
                    </div>
                    <div class="mb-6">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="password">
                            Password
                        </label>
                        <input class="appearance-none border rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline @error('password') is-invalid @enderror" id="password" type="password" placeholder="********" name="password" required autocomplete="new-password">
                        @error('password')
                        <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                      @enderror
                    </div>
                    <div class="mb-6">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="confirm-password">
                            Confirm Password
                        </label>
                        <input class="appearance-none border rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline" id="confirm-password" type="password" placeholder="********" name="password_confirmation" required autocomplete="new-password">
                    </div>
                    <div class="flex items-center justify-between">
                        <button class="bg-indigo-500 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
                            Register
                        </button>
                        <a class="inline-block align-baseline font-bold text-sm text-indigo-500 hover:text-indigo-800" href="#">
                            Forgot Password?
                        </a>
                    </div>
                </form>
            </div>
         
         
        </div>
      </div>
      
</div>
@endsection

