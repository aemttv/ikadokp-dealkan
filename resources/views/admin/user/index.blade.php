<x-admin-layout title="Admin Users">
    {{-- Title --}}
    <div class="flex justify-between items-center">
        <div>
            <h1 class="text-2xl font-bold">Jaringan Agen Dealkan Terkini, Solusi Properti Anda!</h1>
            <p class="text-gray-600">Bersama agen terbaik, wujudkan properti impian Anda.</p>
        </div>
    </div>



    {{-- Search Form --}}
    <div class="w-full flex flex-col sm:flex-row justify-center space-y-4 sm:space-y-0 sm:space-x-4">
        <form method="GET" action="{{ route('userSearch') }}" class="">
            <div class="flex">
                <input type="text" name="search" value=""
                    class="form-input w-full px-4 py-2 border rounded-l-md"
                    placeholder="Cari Nama, Email, No Hp, No WA">
                <button type="submit"
                    class="bg-gradient-to-r from-blue-400 to-blue-600 text-white px-4 py-2 rounded-r-md hover:to-blue-500">
                    Cari
                </button>
            </div>
        </form>

        <a href="{{ route('addUser.view') }}"
            class="bg-gradient-to-r from-orange-400 to-orange-600 text-white px-4 py-2 rounded-md hover:to-orange-500 text-center">
            Tambah User
        </a>

    </div>
    <div class="hidden sm:block">
        @if (!$users == [])
        <nav class="text-gray-600 justify-center items-end text-right">
            <a href="/dashboard" class="hover:text-gray-800">Home</a>
            <span> &gt; </span>
            <a href="/users-list" class="hover:text-gray-800">Daftar Pengguna</a>
        </nav>
        @endif
            <p class="text-gray-600 justify-center items-end text-right ">
                Menampilkan {{ $users->firstItem() }}-{{ $users->lastItem() }} dari total
                {{ $users->total() }} pengguna
            </p>
        </div>
    </div>

    {{-- Alert --}}
    @if (session('success'))
    <x-ui.alert type="success" :message="session('success')" />
    @elseif (session('error'))
    <x-ui.alert type="error" :message="session('error')" />
    @endif

    <div class="overflow-x-auto">
        <table class="min-w-full divide-y-2 divide-gray-200 bg-white text-sm text-center mt-4">
            <thead class="ltr:text-left rtl:text-right">
                <tr>
                    <th class="whitespace-nowrap px-4 py-2 font-bold text-gray-900">No</th>
                    <th class="whitespace-nowrap px-4 py-2 font-bold text-gray-900">Nama</th>
                    <th class="whitespace-nowrap px-4 py-2 font-bold text-gray-900">Email</th>
                    <th class="whitespace-nowrap px-4 py-2 font-bold text-gray-900">No Hp</th>
                    <th class="whitespace-nowrap px-4 py-2 font-bold text-gray-900">No WA</th>
                    <th class="whitespace-nowrap px-4 py-2 font-bold text-gray-900">Role</th>
                    <th class="whitespace-nowrap px-4 py-2 font-bold text-gray-900">Action</th>
                </tr>
            </thead>

            <tbody class="divide-y divide-gray-200">
                @if ($users->isEmpty())
                    <tr>
                        <td class="whitespace-nowrap px-4 py-2 font-medium text-gray-900" colspan="8">Tidak Ada Data
                        </td>
                    </tr>
                @endif
                @foreach ($users as $data)
                    <tr class="odd:bg-gray-100">
                        <td class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">{{ $data->id }}</td>
                        <td class="whitespace-nowrap px-4 py-2 text-gray-700">{{ $data->name }}</td>
                        <td class="whitespace-nowrap px-4 py-2 text-gray-700">{{ $data->email }}</td>
                        <td class="whitespace-nowrap px-4 py-2 text-gray-700">{{ $data->nohp }}</td>
                        <td class="whitespace-nowrap px-4 py-2 text-gray-700">{{ $data->nowa }}</td>
                        <td class="whitespace-nowrap px-4 py-2 text-gray-700">{{ $data->role == 1 ? 'User' : 'Admin' }}
                        </td>
                        <td class="whitespace-nowrap px-4 py-2 flex space-x-2 justify-center items-center">
                            <!-- Button Edit -->
                            <a href="{{ route('updateUser.view', $data->id) }}"
                                class="inline-block rounded bg-blue-500 px-4 py-2 text-xs font-medium text-white hover:bg-blue-600">
                                Ubah
                            </a>

                            <!-- Button Delete -->
                            <form action="{{ route('users.delete', $data->id) }}" method="POST" class="inline"
                                onsubmit="return confirm('Are you sure you want to delete this user? This action cannot be undone.');">
                                @csrf
                                {{-- @method('DELETE') --}}
                                <button type="submit"
                                    class="inline-block rounded bg-red-500 px-4 py-2 text-xs font-medium text-white hover:bg-red-600">
                                    Hapus
                                </button>
                            </form>

                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    {{-- Pagination Links --}}
    <div class="flex mt-4 justify-center ">
        {{ $users->links() }}
    </div>
    </x-layout>
