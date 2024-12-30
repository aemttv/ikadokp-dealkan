<x-admin-layout>
    <div class=" mx-auto p-6">
        <div class="flex justify-between items-center mb-6">
            {{-- page title --}}
            <h2 class="text-2xl font-semibold text-gray-700">Tambah Primary Baru</h2>
            {{-- back button --}}
            <a href="{{ route('propertyPrimary.view') }}"
                class="bg-gradient-to-r from-orange-400 to-orange-600 hover:to-orange-500 text-white px-4 py-2 rounded-lg">Kembali</a>
        </div>

        {{-- Alert --}}
        @if (session('success'))
            <x-ui.alert type="success" :message="session('success')" />
        @elseif ($errors->any())
            @foreach ($errors->all() as $error)
                <x-ui.alert type="error" :message="$error" />
            @endforeach
        @endif

        {{-- form --}}
        <form class="max-w-sm mx-auto" action="{{ route('addListPrimary.submit') }}" enctype="multipart/form-data"
            method="POST">
            @csrf
            <label for="large-image" class="block text-sm font-medium text-gray-900 "> Gambar </label>
            <div class="flex mb-5">
                <!-- Large image upload box -->
                <label for="large-image"
                    class="flex items-center text-center justify-center w-80 h-36 border-2 border-dashed rounded-lg bg-gray-50 text-gray-500 cursor-pointer relative">
                    <span id="large-image-placeholder">+<br>Masukkan Gambar</span>
                    <img id="large-image-preview" class="absolute inset-0 w-full h-full object-cover hidden" />
                    <input id="large-image" type="file" accept="image/*" class="hidden"
                        onchange="handleFileUpload(event, 'large-image-preview', 'large-image-placeholder')"
                        name="image_main" required />
                </label>

                <!-- Small image upload boxes -->
                <div class="flex flex-col space-y-2 ml-1.5">
                    <label for="small-image-1"
                        class="flex items-center justify-center w-28 h-[68px] border-2 border-dashed rounded-lg bg-gray-50 text-gray-500 cursor-pointer relative">
                        <span id="small-image-1-placeholder">+</span>
                        <img id="small-image-1-preview" class="absolute inset-0 w-full h-full object-cover hidden" />
                        <input id="small-image-1" type="file" accept="image/*" class="hidden"
                            onchange="handleFileUpload(event, 'small-image-1-preview', 'small-image-1-placeholder')"
                            name="image_second" />
                    </label>
                    <label for="small-image-2"
                        class="flex items-center justify-center w-28 h-[68px] border-2 border-dashed rounded-lg bg-gray-50 text-gray-500 cursor-pointer relative">
                        <span id="small-image-2-placeholder">+</span>
                        <img id="small-image-2-preview" class="absolute inset-0 w-full h-full object-cover hidden" />
                        <input id="small-image-2" type="file" accept="image/*" class="hidden"
                            onchange="handleFileUpload(event, 'small-image-2-preview', 'small-image-2-placeholder')"
                            name="image_third" />
                    </label>
                </div>
            </div>
            <div class="mb-5">
                <label for="address" class="block mb-2 text-sm font-medium text-gray-900 ">Judul
                    Properti</label>
                <input type="name" id="title" name="title"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 "
                    value="{{ old('title') }}" required />
            </div>

            <!-- Hidden input for agentID -->
            <input type="hidden" name="agentID" value="{{ Auth::user()->id ?? '' }}">

            <div class="flex space-x-4 mb-5">
                <div class="w-1/2 group">
                    <label for="hargaJual" class="block mb-2 text-sm font-medium text-gray-900 ">Harga Dimulai </label>
                    <input type="number" id="hargaJual" name="hargaJual"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 "
                        value="{{ old('hargaJual') }}" required min="150000000" step="10000" max="999999999999999" />
                </div>
                <div class="w-1/2 group">
                    <label for="hargaJualMax" class="block mb-2 text-sm font-medium text-gray-900 whitespace-nowrap">Harga Jual
                        Maksimal</label>
                    <input type="number" id="hargaJualMax" name="hargaJualMax"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 "
                        value="{{ old('hargaJualMax') }}" min="150000000" step="10000" max="999999999999999" />
                </div>
            </div>
            <div class="mb-5">
                <label for="address" class="block mb-2 text-sm font-medium text-gray-900 ">Orientasi</label>
                <select name="orientasiID" id="floating_orientasiID"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 "
                    required>
                    <option value="1" selected>Barat</option>
                    <option value="2">Selatan</option>
                    <option value="3">Timur</option>
                    <option value="4">Utara</option>
                </select>
            </div>

            <div class="mb-5">
                <label for="price" class="block mb-2 text-sm font-medium text-gray-900 ">Deskripsi
                    Properti</label>
                <textarea type="text" name="deskripsi" id="floating_deskripsi"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 "
                    placeholder=" " required></textarea>
            </div>

            <!-- Hidden input for ownershipListingID-->
            <input type="hidden" name="ownershipListingID" value="{{ Auth::user()->id ?? '' }}">

            <!-- Hidden input for statusListing -->
            <input type="hidden" name="isPrimary" value="1">

            <!-- Hidden input for statusListing -->
            <input type="hidden" name="statusListing" value="2">

            <button type="submit"
                class="text-white bg-gradient-to-r from-orange-400 to-orange-600 hover:to-orange-500 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center ">Simpan</button>
        </form>
    </div>

    <script>
        function handleFileUpload(event, previewId, placeholderId) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const preview = document.getElementById(previewId);
                    const placeholder = document.getElementById(placeholderId);
                    preview.src = e.target.result;
                    preview.classList.remove('hidden');
                    placeholder.classList.add('hidden');
                };
                reader.readAsDataURL(file);
            }
        }
    </script>

</x-admin-layout>
