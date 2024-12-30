<x-layout title="register">

    <section class="bg-white">
        <div class="lg:grid lg:min-h-screen lg:grid-cols-12">
            <aside class="relative block h-16 lg:order-last lg:col-span-5 lg:h-full xl:col-span-6">
                <img alt=""
                    src="{{asset('assets/images/Banners/ciputra_world.jpg')}}"
                    class="absolute inset-0 h-full w-full object-cover" />
            </aside>

            <main
                class="flex items-center justify-center px-8 py-8 sm:px-12 lg:col-span-7 lg:px-16 lg:py-12 xl:col-span-6">
                <div class="max-w-xl lg:max-w-3xl">

                    <h1 class="mt-6 text-2xl font-bold text-gray-900 sm:text-3xl md:text-4xl">
                        Selamat Datang di Dealkan Property
                    </h1>

                    <p class="mt-4 leading-relaxed text-gray-500">
                        Mulai sekarang juga! Masukkan detail Anda <br> untuk login dan mulai menjelajahi layanan kami.
                    </p>

                    <form action="{{route('register.submit')}}" method="POST" class="mt-8 grid grid-cols-6 gap-6">
                        @csrf
                        <div class="col-span-6">
                            <label for="fullname" class="block text-sm font-medium text-gray-700">
                                Nama Lengkap
                            </label>
                            <input type="text" id="fullname" name="fullname"
                                class="mt-1 w-full rounded-md border-gray-200 bg-white text-sm text-gray-700 shadow-sm" />
                        </div>
                        <div class="col-span-6">
                            <label for="Email" class="block text-sm font-medium text-gray-700"> Email </label>

                            <input type="email" id="Email" name="email"
                                class="mt-1 w-full rounded-md border-gray-200 bg-white text-sm text-gray-700 shadow-sm" />
                        </div>
                        <div class="col-span-6">
                            <label for="HP" class="block text-sm font-medium text-gray-700"> No.HP </label>

                            <input type="text" id="hp" name="nohp"
                                class="mt-1 w-full rounded-md border-gray-200 bg-white text-sm text-gray-700 shadow-sm" />
                        </div>
                        <div class="col-span-6">
                            <label for="WA" class="block text-sm font-medium text-gray-700"> No.WA </label>

                            <input type="text" id="WA" name="noWA"
                                class="mt-1 w-full rounded-md border-gray-200 bg-white text-sm text-gray-700 shadow-sm" />
                        </div>

                        <div class="col-span-6 sm:col-span-3">
                            <label for="Password" class="block text-sm font-medium text-gray-700"> Password </label>

                            <input type="password" id="Password" name="password"
                                class="mt-1 w-full rounded-md border-gray-200 bg-white text-sm text-gray-700 shadow-sm" />
                        </div>

                        <div class="col-span-6 sm:col-span-3">
                            <label for="PasswordConfirmation" class="block text-sm font-medium text-gray-700">
                                Konfirmasi Password
                            </label>

                            <input type="password" id="PasswordConfirmation" name="password_confirmation"
                                class="mt-1 w-full rounded-md border-gray-200 bg-white text-sm text-gray-700 shadow-sm" />
                        </div>

                        <div class="col-span-6 sm:flex sm:items-center sm:gap-4">
                            <button
                                class="inline-block shrink-0 rounded-md border bg-gradient-to-r from-orange-400 to-orange-600 hover:to-orange-500 px-12 py-3 text-sm font-medium text-white transition hover:bg-transparent">
                                Create an account
                            </button>
                        </div>
                    </form>
                </div>
            </main>
        </div>
    </section>
</x-layout>
