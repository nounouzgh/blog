<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            @php
            $user = Auth::guard('compte')->user()->user;
            @endphp
            @if ($user)
            <a href="{{ route('student.profile.edit') }}">Edit Profile</a>
            <a href="{{ route('resource.index') }}">Show resource</a>
                <p>User ID: {{ $user->id }}</p>
                <p>User Name: {{ $user->name }}</p>
                <p>User LastName: {{ $user->prenom }}</p>
                <p>User Role: {{ $user->role->name }} </p>
                <p>student ID: {{ $user->student->id }}</p>
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