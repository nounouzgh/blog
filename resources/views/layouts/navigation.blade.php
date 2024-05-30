<!-- x-navigation.blade.php -->

@props(['role'])
@php
           $user = Auth::guard('compte')->user()->user;

@endphp
<ul>
    @if ($user->role->name != 'admin')
    <li>
      
            <x-dropdown-link :href="route( $user->role->name . '.profile.edit')">
                {{ __('Profile') }}
            </x-dropdown-link>
    </li>
    @endif
    <li>
        <!-- Authentication -->
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <x-dropdown-link :href="route('logout')"
                onclick="event.preventDefault(); this.closest('form').submit();">
                {{ __('Log Out') }}
            </x-dropdown-link>
        </form>
    </li>
</ul>
