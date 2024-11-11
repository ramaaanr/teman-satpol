<!-- resources/views/home.blade.php -->
@extends('layouts.app')

@section('title', 'Halaman Login')

@section('content')

    <div class="relative flex flex-col justify-between items-center px-6 lg:px-8 py-5 min-h-screen">

        <!-- Background gradient -->
        <div class="absolute inset-0 bg-gradient-to-b from-[#449BEA] to-[#051F37] -z-10"></div>

        <!-- Image as second background layer -->
        <div class="absolute inset-0 bg-cover bg-center bg-no-repeat -z-5"
            style="background-image: url('/hero-login.jpg'); opacity: 0.1;"></div>

        <!-- Content div -->
        <div
            class="rounded-lg w-fit shadow-lg bg-white mt-24 py-8 px-12 h-fit hover:border-2 hover:border-blue-500 relative z-30">
            <div class="sm:mx-auto sm:w-full sm:max-w-sm">
                <h2 class="mt-5 text-center text-2xl font-bold leading-9 tracking-tight text-zinc-700">TEMAN SATPOL
                </h2>
                <h2 class="text-center text-lg mb-8 leading-9 tracking-tight text-zinc-500">Masukan akun Kepegawaian
                </h2>

            </div>

            <div class="sm:mx-auto sm:w-full sm:max-w-sm h-fit">
                <form class="space-y-3" action="/auth/login" method="POST">
                    <div class="flex">
                        <span
                            class="inline-flex items-center px-3 text-sm text-gray-900 bg-light border rounded-e-0 border-gray-300 border-e-0 rounded-s-md">
                            <svg class="w-4 h-4 text-gray-500 " aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                fill="currentColor" viewBox="0 0 20 20">
                                <path
                                    d="M10 0a10 10 0 1 0 10 10A10.011 10.011 0 0 0 10 0Zm0 5a3 3 0 1 1 0 6 3 3 0 0 1 0-6Zm0 13a8.949 8.949 0 0 1-4.951-1.488A3.987 3.987 0 0 1 9 13h2a3.987 3.987 0 0 1 3.951 3.512A8.949 8.949 0 0 1 10 18Z" />
                            </svg>
                        </span>
                        <input type="text" name="nip" id="nip"
                            class="rounded-none rounded-e-lg bg-gray-50 border text-gray-900 focus:ring-blue-500 focus:border-blue-500 block flex-1 min-w-0 w-full text-sm border-gray-300 p-2.5 "
                            placeholder="NIP">
                    </div>

                    <div class="flex">
                        <span
                            class="inline-flex items-center px-3 text-sm text-gray-900 bg-light border rounded-e-0 border-gray-300 border-e-0 rounded-s-md">
                            <svg class="w-4 h-4 text-gray-500 " aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                <path fill-rule="evenodd"
                                    d="M8 10V7a4 4 0 1 1 8 0v3h1a2 2 0 0 1 2 2v7a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2v-7a2 2 0 0 1 2-2h1Zm2-3a2 2 0 1 1 4 0v3h-4V7Zm2 6a1 1 0 0 1 1 1v3a1 1 0 1 1-2 0v-3a1 1 0 0 1 1-1Z"
                                    clip-rule="evenodd" />
                            </svg>

                        </span>
                        <input type="password" name="password" id="password"
                            class="rounded-none rounded-e-lg bg-gray-50 border text-gray-900 focus:ring-blue-500 focus:border-blue-500 block flex-1 min-w-0 w-full text-sm border-gray-300 p-2.5 "
                            placeholder="password">
                    </div>

                    <div>
                        <button type="submit"
                            class="flex w-full mt-12 justify-center rounded-md bg-blue-400 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-blue-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-blue-600">Login</button>
                    </div>
                </form>
            </div>
        </div>

        <p class="text-sm text-gray-50 relative z-30">©️2024 - Kementrian Agama Kota Banjarbaru</p>
    </div>
    <script></script>
@endsection
