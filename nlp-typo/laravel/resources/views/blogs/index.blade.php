@extends('layouts.app')

@section('content')
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
        <h1 style="font-size: 32px; font-weight: bold;">Daftar Blog</h1>
        <a href="{{ route('blogs.create') }}"
            style="padding: 10px 16px; background-color: #007BFF; color: white; border-radius: 8px; text-decoration: none; font-weight: bold; transition: background-color 0.3s;"
            onmouseover="this.style.backgroundColor='#0056b3'"
            onmouseout="this.style.backgroundColor='#007BFF'">
            + Tambah Blog
        </a>
    </div>

    @if ($blogs->isEmpty())
        <div style="text-align: center; font-size: 18px; color: #777; margin-top: 60px;">
            Tidak ada blog yang tersedia.
        </div>
    @else
        <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(300px, 1fr)); gap: 20px;">
            @foreach ($blogs as $blog)
                <div style="border: 1px solid #ddd; border-radius: 12px; padding: 20px; background-color: #f9f9f9; box-shadow: 0 2px 6px rgba(0,0,0,0.1);">
                    <h3 style="margin-bottom: 10px;">{{ $blog->title }}</h3>
                    <p style="color: #555; max-height: 80px; overflow: hidden; text-overflow: ellipsis;">
                        {{ Str::limit(strip_tags($blog->content), 100) }}
                    </p>
                    <div style="margin-top: 15px;">
                        <a href="{{ route('blogs.edit', $blog) }}"
                            style="padding: 8px 12px; background-color: #007BFF; color: white; border-radius: 6px; text-decoration: none; font-size: 14px; margin-right: 10px; transition: background-color 0.3s;"
                            onmouseover="this.style.backgroundColor='#0056b3'"
                            onmouseout="this.style.backgroundColor='#007BFF'">
                            Edit
                        </a>
                        <form action="{{ route('blogs.destroy', $blog) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                onclick="return confirm('Yakin ingin menghapus blog ini?')"
                                style="padding: 8px 12px; background-color: #dc3545; color: white; border: none; border-radius: 6px; font-size: 14px; cursor: pointer; transition: background-color 0.3s;"
                                onmouseover="this.style.backgroundColor='#a71d2a'"
                                onmouseout="this.style.backgroundColor='#dc3545'">
                                Hapus
                            </button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
@endsection
