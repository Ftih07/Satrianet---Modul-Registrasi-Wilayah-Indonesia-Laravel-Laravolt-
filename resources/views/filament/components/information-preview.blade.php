<div class="bg-white p-6 rounded-lg shadow-sm max-h-96 overflow-y-auto">
    <!-- Header Article -->
    <div class="mb-6 border-b pb-4">
        <div class="flex items-center justify-between mb-2">
            <div class="flex items-center space-x-2">
                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                    {{ $record->category?->title ?? 'Tidak ada kategori' }}
                </span>
                @if($record->is_featured)
                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                    <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                    </svg>
                    Unggulan
                </span>
                @endif
                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $record->status ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800' }}">
                    {{ $record->status ? 'Dipublikasikan' : 'Draft' }}
                </span>
            </div>
            <div class="text-sm text-gray-500">
                {{ $record->created_at->format('d M Y, H:i') }}
            </div>
        </div>

        <h1 class="text-2xl font-bold text-gray-900 mb-2">
            {{ $record->title }}
        </h1>

        @if($record->sub_title)
        <p class="text-lg text-gray-600 mb-3">
            {{ $record->sub_title }}
        </p>
        @endif

        <div class="text-sm text-gray-500">
            <span class="font-medium">Slug:</span>
            <code class="bg-gray-100 px-2 py-1 rounded">{{ $record->slug }}</code>
        </div>
    </div>

    <!-- Article Image -->
    @if($record->image)
    <div class="mb-6">
        <img src="{{ Storage::url($record->image) }}"
            alt="{{ $record->title }}"
            class="w-full h-64 object-cover rounded-lg shadow-sm">
    </div>
    @endif

    <!-- Article Content -->
    <div class="prose prose-sm max-w-none mb-6">
        {!! $record->content !!}
    </div>

    <!-- Meta Keywords -->
    @if($record->meta_keywords)
    <div class="border-t pt-4">
        <h3 class="text-sm font-medium text-gray-900 mb-2">Meta Keywords:</h3>
        <div class="flex flex-wrap gap-1">
            @foreach(explode(',', $record->meta_keywords) as $keyword)
            <span class="inline-flex items-center px-2 py-1 rounded-md text-xs bg-gray-100 text-gray-700">
                {{ trim($keyword) }}
            </span>
            @endforeach
        </div>
    </div>
    @endif

    <!-- Article Stats -->
    <div class="border-t mt-6 pt-4">
        <div class="grid grid-cols-2 gap-4 text-sm text-gray-600">
            <div>
                <span class="font-medium">Dibuat:</span>
                {{ $record->created_at->format('l, d F Y \p\u\k\u\l H:i:s') }}
            </div>
            <div>
                <span class="font-medium">Diperbarui:</span>
                {{ $record->updated_at->format('l, d F Y \p\u\k\u\l H:i:s') }}
            </div>
        </div>
    </div>
</div>

<style>
    /* Custom prose styles for content preview */
    .prose h1,
    .prose h2,
    .prose h3,
    .prose h4,
    .prose h5,
    .prose h6 {
        color: #1f2937;
        font-weight: 600;
    }

    .prose h1 {
        font-size: 1.5rem;
        margin-bottom: 0.5rem;
    }

    .prose h2 {
        font-size: 1.25rem;
        margin-bottom: 0.5rem;
    }

    .prose h3 {
        font-size: 1.125rem;
        margin-bottom: 0.5rem;
    }

    .prose p {
        margin-bottom: 1rem;
        line-height: 1.6;
        color: #374151;
    }

    .prose ul,
    .prose ol {
        margin-bottom: 1rem;
        padding-left: 1.5rem;
    }

    .prose li {
        margin-bottom: 0.25rem;
        color: #374151;
    }

    .prose a {
        color: #3b82f6;
        text-decoration: underline;
    }

    .prose a:hover {
        color: #1d4ed8;
    }

    .prose blockquote {
        border-left: 4px solid #e5e7eb;
        padding-left: 1rem;
        margin: 1rem 0;
        font-style: italic;
        color: #6b7280;
    }

    .prose code {
        background-color: #f3f4f6;
        padding: 0.125rem 0.25rem;
        border-radius: 0.25rem;
        font-size: 0.875rem;
        color: #1f2937;
    }

    .prose pre {
        background-color: #1f2937;
        color: #f9fafb;
        padding: 1rem;
        border-radius: 0.5rem;
        overflow-x: auto;
        margin: 1rem 0;
    }

    .prose img {
        border-radius: 0.5rem;
        margin: 1rem 0;
        max-width: 100%;
        height: auto;
    }

    .prose table {
        width: 100%;
        border-collapse: collapse;
        margin: 1rem 0;
    }

    .prose th,
    .prose td {
        border: 1px solid #e5e7eb;
        padding: 0.5rem;
        text-align: left;
    }

    .prose th {
        background-color: #f9fafb;
        font-weight: 600;
    }
</style>