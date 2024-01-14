<!-- resources/views/Qr/home.blade.php -->
<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
      {{ __('My_Qr') }}
    </h2>
  </x-slot>

  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 text-gray-900 dark:text-gray-100">
          <div class="visible-print text-center">
            {{QrCode::size(100)->generate(auth()->user()->id) }}
            <p>スキャンして元のページに戻ります</p>
            <div id="app" class="mt-8 bg-white dark:bg-gray-800 overflow-hidden shadow sm:rounded-lg">
              <scan-component/>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</x-app-layout>