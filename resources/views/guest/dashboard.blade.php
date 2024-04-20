<x-app-layout>
    <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
             @auth
             <p>User ID: {{ Auth::user()->id }}</p>
             <p><p>User Role: {{ Auth::user()->name}}  </p>
             <p><p>User Role: {{ Auth::user()->role->name}}  </p>
             @endauth
                
            </h2>
        </x-slot>
    </x-app-layout>
    