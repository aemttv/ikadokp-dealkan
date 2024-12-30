<x-admin-layout title="dashboard admin">

    <div class="p-8">
        <h1 class="font-bold mb-5 text-3xl text-center">Halaman Admin Dealkan</h1>

        {{-- Alert --}}
        @if (session('success'))
            <x-ui.alert type="success" :message="session('success')" />
        @elseif (session('error'))
            <x-ui.alert type="error" :message="session('error')" />
        @endif

        <!-- Header -->
        <div class="justify-between items-center mb-6 hidden sm:flex">
            <h1 class="text-2xl font-bold">Dashboard</h1>
            <nav class="text-gray-600">
                <a href="#" class="hover:text-gray-800">Home</a>
                <span> &gt; </span>
                <a href="#" class="hover:text-gray-800">Dashboard</a>
            </nav>
        </div>


        <!-- User Count Cards -->
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-4 mb-6">
            <!-- Card 1 -->
            <a href="{{route('admin-users.profil')}}" class="flex flex-col items-center justify-center bg-gradient-to-r from-orange-400 to-orange-600 text-white hover:to-orange-500 border border-gray-300 rounded-lg p-4">
                <i class="fa-solid fa-users text-white text-4xl"></i>
                <p class="text-lg font-semibold mt-2">Agen Aktif</p>
                <p class="text-2xl font-bold mt-1">{{$userActive}}</p>
            </a>
            <!-- Repeat for other cards -->
            <a href="{{route('propertyPrimary.view')}}" class="flex flex-col items-center justify-center bg-gradient-to-r from-orange-400 to-orange-600 text-white hover:to-orange-500 border border-gray-300 rounded-lg p-4">
                <i class="fa-solid fa-hotel text-white text-4xl"></i>
                <p class="text-lg font-semibold mt-2">Daftar Utama</p>
                <p class="text-2xl font-bold mt-1">{{$primary}}</p>
            </a>
            <a href="{{route('propertySecondary.view')}}" class="flex flex-col items-center justify-center bg-white bg-gradient-to-r from-orange-400 to-orange-600 text-white hover:to-orange-500 border border-gray-300 rounded-lg p-4">
                <i class="fas fa-home text-white text-4xl"></i>
                <p class="text-lg font-semibold mt-2">Daftar Sekunder</p>
                <p class="text-2xl font-bold mt-1">{{$secondary}}</p>
            </a>
            <a href="{{route('allBuyRequest.view')}}" class="flex flex-col items-center justify-center bg-white bg-gradient-to-r from-orange-400 to-orange-600 text-white hover:to-orange-500 border border-gray-300 rounded-lg p-4">
                <i class="fa-solid fa-people-arrows text-white text-4xl"></i>
                <p class="text-lg font-semibold mt-2">Daftar Pemesanan</p>
                <p class="text-2xl font-bold mt-1">{{$buyRequest}}</p>
            </a>
        </div>

        <!-- Weekly Activity Table -->
        <div>
            <h2 class="text-xl font-bold mb-4">Aktivitas Dealkan Website</h2>
            <div>
                <div class="flex flex-col sm:flex-row sm:space-x-4">
                    {{-- Left Side BUY REQUEST SECTION --}}
                    <div class="w-full sm:w-1/2 mb-4 sm:mb-0 text-sm">
                        <div class="bg-[#fff9f2] border border-gray-300 rounded-lg p-2 overflow-x-auto">
                            <table class="w-full border-collapse table-auto text-left">
                                <thead>
                                    <tr class="bg-gradient-to-r from-orange-100 to-orange-200 text-center justify-center items-center">
                                        <th class="p-3 border border-gray-300" colspan="6"> <h2>Buy Request</h2></th>
                                    </tr>
                                    <tr class="bg-gradient-to-r from-orange-100 to-orange-200">
                                        <th class="p-3 border border-gray-300">No</th>
                                        <th class="p-3 border border-gray-300">Tipe</th>
                                        <th class="p-3 border border-gray-300">Agen</th>
                                        <th class="p-3 border border-gray-300">Pembeli</th>
                                        <th class="p-3 border border-gray-300">Tanggal Input </th>
                                        <th class="p-3 border border-gray-300">Tanggal Modifikasi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($buyRequestsActivity->isEmpty())
                                        <tr>
                                            <td class="p-3 border border-gray-300 text-center" colspan="6">Belum ada aktivitas</td>
                                        </tr>
                                    @else
                                        <!-- Display BuyRequest Activities -->
                                        @foreach ($buyRequestsActivity as $request)
                                            <tr>
                                                <td class="p-3 border border-gray-300">{{$loop->iteration}}</td>
                                                <td class="p-3 border border-gray-300">BR</td>
                                                <td class="p-3 border border-gray-300">{{mb_strimwidth($request->agent_name ?? 'N/A', 0, 15, '...' )}}</td>
                                                <td class="p-3 border border-gray-300">{{mb_strimwidth($request->buyerName ?? 'N/A', 0, 15, '...')}}</td>
                                                <td class="p-3 border border-gray-300">{{ \Carbon\Carbon::parse($request->buy_request_created_at)->format('j F Y') }}</td>
                                                <td class="p-3 border border-gray-300">{{ \Carbon\Carbon::parse($request->buy_request_updated_at)->format('j F Y') }}</td>

                                            </tr>
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                    {{-- Right Side Users Section --}}
                    <div class="w-full sm:w-1/2 mb-4 sm:mb-0 text-sm">
                        <div class="bg-[#fff9f2] border border-gray-300 rounded-lg p-2 overflow-x-auto">
                            <table class="w-full border-collapse table-auto text-left">
                                <thead>
                                    <tr class="bg-gradient-to-r from-orange-100 to-orange-200 text-center justify-center items-center">
                                        <th class="p-3 border border-gray-300" colspan="6"> <h2>Pengubahan/Pembuatan Akun</h2></th>
                                    </tr>
                                    <tr class="bg-gradient-to-r from-orange-100 to-orange-200">
                                        <th class="p-3 border border-gray-300">No.</th>
                                        <th class="p-3 border border-gray-300">Peran</th>
                                        <th class="p-3 border border-gray-300">Nama Pengguna</th>
                                        <th class="p-3 border border-gray-300">Modifikasi Oleh</th>
                                        <th class="p-3 border border-gray-300">Tanggal Input</th>
                                        <th class="p-3 border border-gray-300">Tanggal Modifikasi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($usersActivity->isEmpty())
                                        <tr>
                                            <td class="p-3 border border-gray-300 text-center" colspan="6">Belum ada aktivitas</td>
                                        </tr>
                                    @else
                                        <!-- Display BuyRequest Activities -->
                                        @foreach ($usersActivity as $request)
                                            <tr>
                                                <td class="p-3 border border-gray-300">{{ $loop->iteration}}</td>
                                                <td class="p-3 border border-gray-300">{{ $request->role ? 'User' : 'Admin'}}</td>
                                                <td class="p-3 border border-gray-300">{{ mb_strimwidth($request->name ?? 'N/A', 0, 25, '...') }}</td>
                                                <td class="p-3 border border-gray-300">{{ mb_strimwidth($request->modified_by_name ?? 'N/A', 0, 25, '...') }}</td>
                                                <td class="p-3 border border-gray-300">{{ $request->created_at->format('j F Y')}}</td>
                                                <td class="p-3 border border-gray-300">{{ $request->updated_at->format('j F Y')}}</td>
                                            </tr>
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>
            {{-- Bottom Side PROPERTY Section --}}
            <div class="w-full mt-4">
                <div class="bg-[#fff9f2] border border-gray-300 rounded-lg p-2 overflow-x-auto">
                    <table class="w-full border-collapse table-auto text-left">
                        <thead>
                            <tr class="bg-gradient-to-r from-orange-100 to-orange-200 text-center justify-center items-center">
                                <th class="p-3 border border-gray-300" colspan="7"> <h2>Pendaftaran Properti Baru/Mengubah</h2></th>
                            </tr>
                            <tr class="bg-gradient-to-r from-orange-100 to-orange-200">
                                <th class="p-3 border border-gray-300">No.</th>
                                <th class="p-3 border border-gray-300">Interaksi</th>
                                <th class="p-3 border border-gray-300">Tipe</th>
                                <th class="p-3 border border-gray-300">Modifikasi Oleh</th>
                                <th class="p-3 border border-gray-300">Judul</th>
                                <th class="p-3 border border-gray-300">Tanggal Input</th>
                                <th class="p-3 border border-gray-300">Tanggal Modifikasi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($propertyActivity->isEmpty())
                                <tr>
                                    <td class="p-3 border border-gray-300 text-center" colspan="6">Belum ada aktivitas</td>
                                </tr>
                            @else
                                <!-- Display BuyRequest Activities -->
                                @foreach ($propertyActivity as $request)
                                    <tr>
                                        <td class="p-3 border border-gray-300">{{$loop->iteration}}</td>
                                        <td class="p-3 border border-gray-300">
                                        @if ($request->updated_at == $request->created_at)
                                            Tambah Baru
                                        @else
                                            Modifikasi
                                        @endif</td>
                                        <td class="p-3 border border-gray-300">{{ $request->isPrimary ? 'Utama' : 'Sekunder'}}</td>
                                        <td class="p-3 border border-gray-300">{{ mb_strimwidth($request->agent_name ?? 'N/A', 0, 25, '...') }}</td>
                                        <td class="p-3 border border-gray-300">{{ mb_strimwidth($request->title, 0, 40 , '...')}}</td>
                                        <td class="p-3 border border-gray-300">{{ \Carbon\Carbon::parse($request->listing_created_at)->format('j F Y') }}</td>
                                        <td class="p-3 border border-gray-300">{{ \Carbon\Carbon::parse($request->listing_updated_at)->format('j F Y') }}</td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
            </div>
        </div>
    </div>
</x-admin-layout>
