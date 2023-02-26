@extends('layouts.main')

@section('content')
        <div class="  flex flex-col justify-center  sm:px-6 lg:px-8">
            <div class="sm:mx-auto sm:w-full sm:max-w-md">
                <img class="mx-auto h-20 w-auto" src="{{ asset('img/error.svg') }}"
                    alt="Workflow">
                <h2 class="mt-6 text-center text-3xl leading-9 font-extrabold text-white">
                    Something went wrong
                </h2>
                <p class="mt-2 text-center text-sm leading-5 text-white">
                    {{$message}}
                </p>
                <div class="mt-6 text-center">
                    <a href="{{ url()->previous() }}"
                        class="text-sm font-medium text-blue-700 hover:text-blue-800 focus:outline-none focus:underline transition ease-in-out duration-150">
                        Go back
                    </a>
                </div>
            </div>
        </div>

@endsection
