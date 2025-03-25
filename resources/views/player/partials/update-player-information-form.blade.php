<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Players Information') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __("Update the player's profile information.") }}
        </p>
    </header>

    <form method="post" action="{{ route('player.update', ['id' => $user->id]) }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')
    
        <div>
            <x-input-label for="nama" :value="__('Nama')" />
            <x-text-input id="nama" name="nama" type="text" class="mt-1 block w-full" :value="old('nama', $user->nama)" required maxlength="100" autofocus autocomplete="nama" />
            <x-input-error class="mt-2" :messages="$errors->get('nama')" />
        </div>
    
        <div>
            <x-input-label for="no_ic" :value="__('Nombor IC')" />
            <x-text-input id="no_ic" name="no_ic" type="text" class="mt-1 block w-full" :value="old('no_ic', $user->no_ic)" required title="Nombor IC mesti mempunyai 12 digit" autocomplete="no_ic" />
            <x-input-error class="mt-2" :messages="$errors->get('no_ic')" />
        </div>

        <div>
            <x-input-label for="no_fon" :value="__('Nombor Fon')" />
            <x-text-input id="no_fon" name="no_fon" type="text" class="mt-1 block w-full" :value="old('no_fon', $user->no_fon)" required title="Nombor Fon mesti mempunyai 10 - 12 digit" autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('no_fon')" />
        </div>
    
        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>
    
            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600 dark:text-gray-400"
                >{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section>
