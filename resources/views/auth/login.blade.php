  
<x-guest-layout>

    <div class="full-screen-container">
      <div class="login-container">
        <h3 class="login-title">Welcome</h3>
        <form method="POST" action="{{ route('login') }}">
        @csrf
              <!-- Email Address -->
          <div class="input-group">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
          </div>
    
    
    
           <!-- Password -->
          <div class="input-group">
            
           <x-input-label for="password" :value="__('Password')" />
    
                <x-text-input id="password" 
                                type="password"
                                name="password"
                                required autocomplete="current-password" />
    
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
          </div>
    
    
        
          <div class="flex items-center justify-end mt-4">
            @if (Route::has('register'))
                <a href="{{ route('register') }}"
                   class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white">
                    Register
                </a>
            @endif
        </div>




          <div class="flex items-center justify-end mt-4">
                @if (Route::has('password.request'))
                    <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a>
                @endif
    
                <x-primary-button class="login-button">
                    {{ __('Log in') }}
                </x-primary-button>
            </div>
    
        </form>
      </div></x-guest-layout>