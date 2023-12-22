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
                <button type="submit">QRコード生成</button>
            </form>
        @else
            <!-- 生成済みのQRコード表示 -->
            <img src="{{ asset($user->qr_code) }}" alt="QR Code">
        @endif
    </div>
</x-app-layout>
