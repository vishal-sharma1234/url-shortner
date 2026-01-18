@extends('layouts.admin.master')
@section('title', 'Login')
@section('content')
    <main class="dashboard-wrapper">
        <form method="POST" action="{{ route('login') }}" class="w-50">
            @csrf

            <!-- Email Address -->
            <div>
                <label for="email">Email<span class="text-danger">*</span></label>
                <input type="email" name="email" class="form-control" required>
                @error('email')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
                {{-- <x-input-error :messages="$errors->get('email')" class="mt-2" /> --}}

            </div>

            <!-- Password -->
            <div class="mt-4">
                {{-- <x-input-label for="password" :value="__('Password')" /> --}}
                <label for="password">Password<span class="text-danger">*</span></label>
                <input id="password" class="form-control" type="password" name="password" required>
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Remember Me -->
            <div class="block mt-4">
                <label for="remember_me" class="inline-flex items-center">
                    <input id="remember_me" type="checkbox"
                        class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800"
                        name="remember">
                    <span class="ms-2 text-sm text-gray-600 dark:text-gray-400">{{ __('Remember me') }}</span>
                </label>
            </div>

            <div class="flex items-center justify-end mt-4">
                <button class="ms-3 btn btn-primary" type="submit">
                    {{ __('Log in') }}
                </button>
            </div>
        </form>
    </main>
@endsection
@section('scripts')
@endsection
