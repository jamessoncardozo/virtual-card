<x-guest-layout>

  <div><x-banner/></div>

  <div class="mx-6 my-4 px-6 py-4">
    
    <div class="text-lg font-medium text-gray-900 dark:text-gray-100">

      <span>QR Code Image Generator</span>
      
    </div>

    <x-section-border />

    <div class="text-sm text-gray-600 dark:text-gray-400">

      <form wire:submit.prevent="createUser">
        @csrf
        <!-- Name -->
        
        <div class="col-span-6 sm:col-span-4">
          <x-label for="name" value="{{ __('Name:') }}" />
          
          <x-input id="name" type="text" class="mt-1 block w-full" wire:model.defer="name" required autocomplete="name" />
          
          <x-input-error for="name" class="mt-2" />
        </div>

        <!-- Linkedin -->

        <div class="col-span-6 sm:col-span-4">

          <x-label for="linkedin_url" class="mt-4" value="{{ __('Linkedin URL:') }}" />
          
          <x-input id="linkedin_url" type="url" class="mt-1 block w-full" wire:model.defer="linkedin_url" autocomplete="linkedin_url" />
          
          <x-input-error for="linkedin_url" class="mt-2" />

        </div>

        <!-- Github -->

        <div class="col-span-6 sm:col-span-4">

          <x-label for="github_url" class="mt-4" value="{{ __('Github URL:') }}" />

          <x-input id="github_url" type="url" class="mt-1 block w-full" wire:model.defer="github_url" autocomplete="github_url" />

          <x-input-error for="github_url" class="mt-2" />

        </div>

        <div class="flex items-center justify-start mt-4 px-4 py-3 bg-gray-50 dark:bg-gray-800 text-right shadow rounded-md ">
          <x-button wire:loading.attr="disabled">
            {{ __('Generate Image') }}
          </x-button>
        </div>
      </form>
    </div>
  </div>
</x-guest-layout>