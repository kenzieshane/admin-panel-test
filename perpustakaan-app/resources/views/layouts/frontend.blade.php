@yield('title', 'Perpustakaan Digital')
@vite(['resources/css/app.css', 'resources/js/app.js'])
📚 Perpustakaan Digital
 Cari Admin Panel
@yield('content')
© 2026 Perpustakaan Digital. Dibuat dengan Laravel Filament 5.
Buat halaman utama resources/views/frontend/index.blade.php:
@extends('layouts.frontend')
@section('title', 'Beranda - Perpustakaan Digital')
@section('content')
Selamat Datang di Perpustakaan Digital
Temukan ribuan buku berkualitas untuk menambah wawasan Anda
Kategori Buku
@foreach($categories as $category) @endforeach
Koleksi Buku Terbaru
@foreach($books as $book)
@if($book->cover_image)  @else@endif
@endforeach
{{ $books->links() }}
@endsection
Buat halaman detail buku resources/views/frontend/book-detail.blade.php:
@extends('layouts.frontend')
@section('title', $book->title . ' - Perpustakaan Digital')
@section('content')
@if($book->cover_image) 

 @else
📚
@endif
{{ $book->title }}
oleh {{ $book->author }}
ISBN: {{ $book->isbn }}
Penerbit: {{ $book->publisher }}
Tahun Terbit: {{ $book->publication_year }}
Kategori: {{ $book->category->name }}
Lokasi: {{ $book->location ?? '-' }}
Kondisi: {{ ucfirst($book->condition) }}
Ketersediaan
{{ $book->available_copies }}/{{ $book->total_copies }}
@if($book->available_copies > 0) ✓ Tersedia @else ✗ Dipinjam Semua @endif
@if($book->description)
Deskripsi
{{ $book->description }}
@endif
Catatan: Untuk meminjam buku ini, silakan datang ke perpustakaan dengan membawa kartu anggota Anda.
@if($relatedBooks->count() > 0)
Buku Terkait
@foreach($relatedBooks as $relatedBook)
@if($relatedBook->cover_image)  @else@endif
@endforeach
@endif
@endsection
