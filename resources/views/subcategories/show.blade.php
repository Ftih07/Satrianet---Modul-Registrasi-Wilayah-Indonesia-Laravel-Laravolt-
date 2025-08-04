@extends('layouts.app') {{-- kalau tanpa layout, hapus baris ini --}}

@section('content')
<section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h1 class="text-4xl font-bold text-gray-800">{{ $subcategory->name }}</h1>
            @if ($subcategory->sub_title)
                <p class="text-lg text-gray-600">{{ $subcategory->sub_title }}</p>
            @endif
        </div>

        {{-- Banner --}}
        @if ($subcategory->banner)
            <div class="mb-12 text-center">
                <img src="{{ asset('storage/' . $subcategory->banner) }}"
                     alt="{{ $subcategory->name }}"
                     class="rounded-xl mx-auto max-w-4xl">
            </div>
        @endif

        {{-- Deskripsi --}}
        @if ($subcategory->description)
            <div class="prose max-w-3xl mx-auto mb-16">
                {!! nl2br(e($subcategory->description)) !!}
            </div>
        @endif

        {{-- Fitur --}}
        @if ($subcategory->features && count($subcategory->features))
            <div class="mb-16">
                <h2 class="text-2xl font-semibold text-gray-800 text-center mb-6">Fitur Sub Kategori</h2>
                <ul class="grid md:grid-cols-2 gap-4 max-w-3xl mx-auto text-left list-disc list-inside">
                    @foreach ($subcategory->features as $feature)
                        <li class="text-gray-700">{{ $feature['feature'] }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- Produk --}}
        <div class="mb-16">
            <h2 class="text-2xl font-semibold text-gray-800 text-center mb-6">Daftar Produk</h2>
            @if ($subcategory->products->count())
                <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach ($subcategory->products as $product)
                        <div class="bg-gray-100 p-6 rounded-xl shadow-md hover:shadow-lg transition">
                            <h3 class="text-xl font-bold text-gray-800 mb-2">{{ $product->name }}</h3>
                            <p class="text-sm text-gray-600 mb-4">{{ \Illuminate\Support\Str::limit(strip_tags($product->description), 100) }}</p>
                            <div class="text-blue-600 font-semibold mb-2">Rp {{ number_format($product->price, 0, ',', '.') }}</div>
                            <a href="#" class="text-sm text-blue-500 hover:underline">Lihat Detail</a>
                        </div>
                    @endforeach
                </div>
            @else
                <p class="text-center text-gray-500">Belum ada produk tersedia.</p>
            @endif
        </div>
    </div>
</section>
@endsection
