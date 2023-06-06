<x-guest-layout>
    <form method="POST" action="{{ route('editar', ['id' => $user->id]) }}">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" value="{{$user->name}}" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="full_name" :value="__('Nombre completo')" />
            <x-text-input id="full_name" class="block mt-1 w-full" type="text" name="full_name" value="{{$user->full_name}}" required autofocus autocomplete="full_name" />
            <x-input-error :messages="$errors->get('full_name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" value="{{$user->email}}" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="nif" :value="__('Nif')" />
            <x-text-input id="email" class="block mt-1 w-full" type="text" name="nif" value="{{$user->nif}}" required />
            <x-input-error :messages="$errors->get('nif')" class="mt-2" />
        </div>

        <div class="mt-4">
            <label for="rol" class="block font-medium text-sm text-gray-700">{{ __('Rol') }}</label>
            <select id="rol"  name="rol" class="block mt-1 w-full form-select">
            @if ($user->roles->isNotEmpty())
                @foreach ($roles as $rol)
                    <option value="{{ $rol->name }}" @if ($user->roles->first()->name === $rol->name) selected @endif>{{ $rol->name }}</option>
                @endforeach
            @else
                @foreach ($roles as $rol)
                    <option value="{{ $rol->name }}"> {{ $rol->name }}</option>
                @endforeach
            @endif
            </select>
            @error('rol')
                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        

        <div class="flex items-center justify-end mt-4">
           

            <x-primary-button class="ml-4">
                {{ __('Editar') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
