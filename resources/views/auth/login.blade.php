@extends('layouts.main')

@section('content')
<div class="pr-4 pl-4">
    <div class="flex flex-col items-center justify-center ">
        <div class="w-full max-w-sm">
            <span class="text-2xl font-light ">Login to your account</span>
            <div class="mt-4 bg-white shadow-md rounded-lg text-left">
                <div class="h-2 bg-indigo-500 rounded-t-md"></div>
                <form method="POST" action="{{ route('login') }}" class="bg-grey-700 shadow-md rounded px-8 pt-6 pb-8 mb-4">
                    @csrf
                    <div class="mb-4">
                      <label for="email" class="block text-gray-700 font-bold mb-2">{{ __('Email') }}</label>
                      <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                      @error('email')
                        <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                      @enderror
                    </div>
                    <div class="mb-4">
                      <label for="password" class="block text-gray-700 font-bold mb-2">{{ __('Password') }}</label>
                      <input id="password" type="password" name="password" required autocomplete="current-password" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                      @error('password')
                        <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                      @enderror
                    </div>
                    <div class="mb-4">
                      <input class="mr-2" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                      <label class="text-gray-700 font-bold" for="remember">
                        {{ __('Remember me') }}
                      </label>
                    </div>
                    <div class="flex items-center justify-between">
                      <button type="submit" class="bg-indigo-500 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">{{ __('Login') }}</button>
                      @if (Route::has('password.request'))
                        <a class="inline-block align-baseline font-bold text-sm text-indigo-500 hover:text-indigo-800" href="{{ route('password.request') }}">
                          {{ __('Forgot Your Password?') }}
                        </a>
                      @endif
                    </div>
                  </form>
            </div>
         
         
        </div>
      </div>
      
</div>
@endsection
