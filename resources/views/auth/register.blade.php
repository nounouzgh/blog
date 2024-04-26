<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />
            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
            <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <!-- Role Selection -->
        <div class="mt-4">
            <x-input-label for="role" :value="__('Role')" />
            <select id="role" name="role" class="block mt-1 w-full rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm border-gray-300">
                <option value="student">Student</option>
                <option value="teacher">Teacher</option>
                <option value="supervisor">Supervisor</option>
            </select>
            <x-input-error :messages="$errors->get('role')" class="mt-2" />
        </div>

        <!-- Additional Fields based on Role -->
        <div id="additional-fields" class="mt-4 hidden">
            <!-- JavaScript will add additional fields here based on the selected role -->
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ms-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>

<script>
    document.getElementById('role').addEventListener('change', function() {
        var role = this.value;
        var additionalFieldsDiv = document.getElementById('additional-fields');
        additionalFieldsDiv.innerHTML = ''; // Clear existing fields
        
        if (role === 'teacher') {
            additionalFieldsDiv.innerHTML = `
                <!-- Input fields for editing teacher information -->
                <x-input-label for="specialite" class="block mt-4">Specialite:</x-input-label>
                <x-text-input id="specialite" class="block mt-1 w-full" type="text" name="specialite" :value="old('specialite')" autocomplete="specialite" />
                <x-input-error :messages="$errors->get('specialite')" class="mt-2" />

                <x-input-label for="grade" class="block mt-4">Grade:</x-input-label>
                <x-text-input id="grade" class="block mt-1 w-full" type="text" name="grade" :value="old('grade')" autocomplete="grade" />
                <x-input-error :messages="$errors->get('grade')" class="mt-2" />
            `;
        } else if (role === 'supervisor') {
            additionalFieldsDiv.innerHTML = `
                <!-- Input fields for editing supervisor information -->
                <x-input-label for="specialite" class="block mt-4">Specialite:</x-input-label>
                <x-text-input id="specialite" class="block mt-1 w-full" type="text" name="specialite" :value="old('specialite')" autocomplete="specialite" />
                <x-input-error :messages="$errors->get('specialite')" class="mt-2" />
            `;
        } else if (role === 'student') {
            additionalFieldsDiv.innerHTML = `
                <!-- Input fields for editing student information -->
                <x-input-label for="specialite" class="block mt-4">Specialite:</x-input-label>
                <x-text-input id="specialite" class="block mt-1 w-full" type="text" name="specialite" :value="old('specialite')" autocomplete="specialite" />
                <x-input-error :messages="$errors->get('specialite')" class="mt-2" />

                <x-input-label for="date_naissance" class="block mt-4">Date de Naissance:</x-input-label>
                <x-text-input id="date_naissance" class="block mt-1 w-full" type="text" name="date_naissance" :value="old('date_naissance')" autocomplete="date_naissance" />
                <x-input-error :messages="$errors->get('date_naissance')" class="mt-2" />

                <x-input-label for="niveau" class="block mt-4">Niveau:</x-input-label>
                <x-text-input id="niveau" class="block mt-1 w-full" type="text" name="niveau" :value="old('niveau')" autocomplete="niveau" />
                <x-input-error :messages="$errors->get('niveau')" class="mt-2" />
            `;
        }

        additionalFieldsDiv.classList.toggle('hidden', false); // Show the additional fields
    });

    // Trigger the change event on page load to display additional fields based on the default role
    document.getElementById('role').dispatchEvent(new Event('change'));
</script>