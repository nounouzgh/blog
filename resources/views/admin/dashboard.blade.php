<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            @php
            $admin = Auth::guard('compte')->user()->admin;
            @endphp
            @if ($user)
            <a href="{{ route('admin.profile.edit') }}">Edit Profile</a>
                <p>User ID: {{ $admin->id }}</p>
                <p>User Name: {{ $admin->name }}</p>
                <p>User prenon: {{ $admin->prenon }} ( Role: {{ $admin->role->name }})</p>
            @else
                <p>No user associated with this compte.</p>
            @endif

            @if (session('message'))
                {{ session('message') }}
            @endif
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __("You're logged in!") }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
