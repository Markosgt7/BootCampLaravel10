
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Chirps') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                 <form method='POST' action="{{ route('chirps.update', $chirp) }}">
                  @csrf  @method('PUT')
                  <textarea name="message" 
                  class='block w-full rounded-md border-gray-300 bg-white shadow-sm 
                  dark:border-gray-600 dark:bg-gray-800 dark:text-white
                  dark:focus:ring dark:focus:ring-indigo-200 dark:focus:ring-opacity-50  ' 
                  placeholder="{{ __('What\'s in your maind?') }}"
                  >{{ old('message', $chirp->message)}}
                  </textarea>
                  <x-input-error :messages="$errors->get('message')"></x-input-error>
                  <x-primary-button class='mt-5'>Chirps</x-primary-button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>