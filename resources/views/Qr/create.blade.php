<!-- resources/views/Qr/home.blade.php -->

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('QR Code Generator') }}
        </h2>
    </x-slot>


    <div class="container">
        @if (!$user->qr_code)
            <!-- QRコード生成ボタン -->
            <form action="{{ route('generate') }}" method="post">
                @csrf
                <x-secondary-button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                  {{ __('QRコード生成') }}
                </x-primary-button>
            </form>
        @else
            <!-- 生成済みのQRコード表示 -->
            <img src="{{ asset($user->qr_code) }}" alt="QR Code">
        @endif
    </div>
</x-app-layout>
