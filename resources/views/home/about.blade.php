
{{-- resources/views/home/about.blade.php --}}
@extends('layouts.app')

@section('title', 'Tentang Kami - MatraMent Thrifting')

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
    <h1 class="text-4xl font-bold text-center mb-8">Tentang MatraMent Thrifting</h1>
    
    <div class="prose prose-lg max-w-none">
        <div class="bg-white rounded-lg shadow-lg p-8 mb-8">
            <h2 class="text-2xl font-bold mb-4">Misi Kami</h2>
            <p class="text-gray-700 leading-relaxed mb-4">
                MatraMent Thrifting adalah toko online yang menyediakan pakaian bekas berkualitas dengan harga terjangkau. 
                Kami berkomitmen untuk mempromosikan sustainable fashion dan mengurangi limbah tekstil dengan memberikan 
                kehidupan baru pada pakaian yang masih layak pakai.
            </p>
            <p class="text-gray-700 leading-relaxed">
                Setiap produk yang kami jual telah melalui proses kurasi yang ketat untuk memastikan kualitas dan 
                kondisi terbaik bagi pelanggan kami.
            </p>
        </div>

        <div class="bg-white rounded-lg shadow-lg p-8 mb-8">
            <h2 class="text-2xl font-bold mb-4">Mengapa Thrifting?</h2>
            <ul class="space-y-3 text-gray-700">
                <li class="flex items-start">
                    <span class="text-2xl mr-3">🌍</span>
                    <span><strong>Ramah Lingkungan:</strong> Mengurangi limbah tekstil dan jejak karbon industri fashion</span>
                </li>
                <li class="flex items-start">
                    <span class="text-2xl mr-3">💰</span>
                    <span><strong>Hemat Biaya:</strong> Dapatkan pakaian branded dengan harga jauh lebih murah</span>
                </li>
                <li class="flex items-start">
                    <span class="text-2xl mr-3">✨</span>
                    <span><strong>Unik & Berkelas:</strong> Temukan item vintage yang tidak dijual di toko biasa</span>
                </li>
                <li class="flex items-start">
                    <span class="text-2xl mr-3">🤝</span>
                    <span><strong>Ekonomi Sirkular:</strong> Mendukung ekonomi berkelanjutan dan konsumsi bertanggung jawab</span>
                </li>
            </ul>
        </div>

        <div class="bg-white rounded-lg shadow-lg p-8">
            <h2 class="text-2xl font-bold mb-4">Komitmen Kualitas</h2>
            <p class="text-gray-700 leading-relaxed mb-4">
                Kami hanya menjual produk yang telah melewati quality control ketat. Setiap produk dikategorikan 
                berdasarkan kondisinya (Baru, Seperti Baru, Baik, Bekas) sehingga Anda tahu persis apa yang Anda beli.
            </p>
            <p class="text-gray-700 leading-relaxed">
                Kepuasan pelanggan adalah prioritas utama kami. Jika ada masalah dengan produk yang Anda terima, 
                silakan hubungi kami dan kami akan dengan senang hati membantu.
            </p>
        </div>
    </div>
</div>
@endsection

