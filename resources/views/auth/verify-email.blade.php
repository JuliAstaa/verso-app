{{-- Sesuaikan dengan layout admin/app kamu --}}
@extends('layouts.app') 

@section('content')
<div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">
    <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg text-center">
        
        <div class="mb-4 text-sm text-gray-600">
            {{ __('Terima kasih sudah mendaftar! Sebelum memulai, mohon verifikasi alamat email kamu dengan mengklik link yang baru saja kami kirimkan. Jika tidak masuk, kami bisa mengirim ulang.') }}
        </div>

        {{-- Pesan Sukses kalau tombol Resend diklik --}}
        @if (session('message') == 'Link verifikasi baru sudah dikirim ke email kamu!')
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ __('Link verifikasi baru telah dikirim ke alamat email kamu.') }}
            </div>
        @endif

        <div class="mt-4 flex items-center justify-between">
            {{-- TOMBOL RESEND --}}
            <form method="POST" action="{{ route('verification.send') }}">
                @csrf
                <button type="submit" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 cursor-pointer">
                    {{ __('Kirim Ulang Email Verifikasi') }}
                </button>
            </form>

            {{-- TOMBOL LOGOUT (Opsional, biar user ga terjebak) --}}
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 cursor-pointer">
                    {{ __('Log Out') }}
                </button>
            </form>
        </div>
    </div>
</div>
@endsection