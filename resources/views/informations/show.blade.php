@extends('layouts.app')

@section('content')
    <section class="py-12 bg-white">
        <div class="max-w-4xl mx-auto px-4">
            <h1 class="text-3xl font-bold text-gray-800 mb-4">{{ $information->title }}</h1>
            
            @if ($information->sub_title)
                <h2 class="text-xl text-gray-600 mb-4">{{ $information->sub_title }}</h2>
            @endif

            @if ($information->image)
                <img src="{{ asset('storage/' . $information->image) }}" alt="{{ $information->title }}" class="rounded-xl mb-6 w-full max-h-[400px] object-cover">
            @endif

            <div class="prose max-w-none">
                {!! $information->content !!}
            </div>

            @if ($information->start_date || $information->end_date)
                <div class="mt-6 text-sm text-gray-500">
                    <strong>Periode Promo:</strong>
                    {{ $information->start_date?->format('d M Y') ?? '–' }}
                    s/d
                    {{ $information->end_date?->format('d M Y') ?? '–' }}
                </div>
            @endif
        </div>
    </section>
@endsection
