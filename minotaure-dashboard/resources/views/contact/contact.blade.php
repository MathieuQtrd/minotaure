<x-guest-layout>
    <form method="POST" action="{{ route('contact.send') }}">
        @if(session('success'))
            <p class="bg-green-100 text-green-700 p-4 rounded-lg shadow-md mb-4">{{ session('success') }}</p>
        @endif

        @if(session('error'))
            <p class="bg-red-100 text-red-700 p-4 rounded-lg shadow-md mb-4">{{ session('error') }}</p>
        @endif
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="subject" :value="__('Sujet')" />
            <x-text-input id="subject" class="block mt-1 w-full" type="text" name="subject" :value="old('sujet')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('sujet')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="message" :value="__('Message')" />
           <textarea name="message" class="block mt-1 w-full" id="message" cols="30" rows="10">{{ old('message') }}</textarea>
           <x-input-error :messages="$errors->get('message')" class="mt-2" />
        </div>

        

        <div class="flex items-center justify-end mt-4"> 
            <x-primary-button class="ms-4">
                {{ __('Envoyer') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
