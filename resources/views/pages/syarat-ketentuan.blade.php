@extends('layouts.app')

@section('title', 'Syarat & Ketentuan')

@section('content')
<div class="bg-[#fff4f7] py-16">
    <div class="max-w-5xl mx-auto px-6">

        <!-- CARD -->
        <div class="bg-white/85 backdrop-blur rounded-2xl shadow-sm p-8 md:p-12">

            <!-- TITLE -->
            <h1 class="text-center text-[22px] font-semibold text-pink-600 mb-1">
                Syarat & Ketentuan Bouquetde Fleur
            </h1>
            <p class="text-center text-sm text-gray-400 mb-12">
                Terakhir diperbarui: <span class="font-medium text-gray-500">16 Desember 2025</span>
            </p>

            <div class="space-y-7 text-[15px] leading-[1.9]">

                <div>
                    <h3 class="text-pink-600 font-semibold text-lg mb-6">
                        1 Pendahuluan
                    </h3>
                    <p class="text-gray-600">
                        Bouquetde Fleur merupakan layanan pemesanan buket yang dapat diakses
                        melalui website resmi kami. Dengan menggunakan layanan ini, pelanggan
                        dianggap telah membaca dan menyetujui seluruh ketentuan yang berlaku.
                    </p>
                </div>

                <div>
                    <h3 class="text-pink-600 font-semibold text-lg mb-6">
                        2 Ruang Lingkup Layanan
                    </h3>
                    <p class="text-gray-600">
                        Kami menyediakan layanan pembuatan buket bunga, buket snack, dan buket uang
                        sesuai dengan permintaan pelanggan serta ketersediaan bahan.
                    </p>
                </div>

                <div>
                    <h3 class="text-pink-600 font-semibold text-lg mb-6">
                        3 Pemesanan
                    </h3>
                    <ul class="list-disc pl-5 space-y-2 text-gray-600">
                        <li>Pemesanan dilakukan melalui media resmi Bouquetde Fleur</li>
                        <li>Data pesanan wajib diisi dengan benar</li>
                        <li>Kesalahan data menjadi tanggung jawab pelanggan</li>
                    </ul>
                </div>

                <div>
                    <h3 class="text-pink-600 font-semibold text-lg mb-6">
                        4 Pembayaran
                    </h3>
                    <p class="text-gray-600">
                        Pembayaran dilakukan sesuai total harga yang tertera.
                        Pesanan akan diproses setelah pembayaran dikonfirmasi.
                    </p>
                </div>

                <div>
                    <h3 class="text-pink-600 font-semibold text-lg mb-6">
                        5 Pembatalan Pesanan
                    </h3>
                    <p class="text-gray-600">
                        Pembatalan hanya dapat dilakukan sebelum proses pembuatan dimulai.
                        Pesanan yang telah diproses tidak dapat dibatalkan.
                    </p>
                </div>

                <div>
                   <h3 class="text-pink-600 font-semibold text-lg mb-6">
                        6 Pengiriman
                    </h3>
                    <p class="text-gray-600">
                        Waktu pengiriman disesuaikan dengan kesepakatan.
                        Keterlambatan akibat faktor eksternal berada di luar tanggung jawab kami.
                    </p>
                </div>

                <div>
                    <h3 class="text-pink-600 font-semibold text-lg mb-6">
                        7 Hak Cipta
                    </h3>
                    <p class="text-gray-600">
                        Seluruh konten dan desain merupakan milik Bouquetde Fleur
                        dan tidak diperkenankan digunakan tanpa izin.
                    </p>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
