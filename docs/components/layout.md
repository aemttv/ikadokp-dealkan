# Layout Komponen

Komponen Layout ini digunakan sebagai tampilan dasar dari halaman web. Komponen ini menyertakan elemen-elemen yang umum digunakan seperti Navbar, Main Content, dan Footer. Komponen ini juga menyertakan pengaturan CSS dan JavaScript yang dibutuhkan.

## Props

-   `title` (wajib): sebagai title halaman website.
-   @section('css') (Tidak Wajib): jika kita ingin menggunakan CSS external.
-   @section('js') (Tidak Wajib): jika kita ingin menggunakan JS external.

## Penggunaan

Contoh penggunaan komponen:

```html
<x-layout title="Home">
    <h1>Halo Dunia!</h1>
</x-layout>
```
