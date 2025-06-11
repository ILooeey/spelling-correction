@extends('layouts.app')

@section('content')
    <h1 style="font-size: 32px; font-weight: bold; margin-bottom: 20px;">Edit Blog</h1>

    <form method="POST" action="{{ route('blogs.update', $blog) }}">
        @csrf
        @method('PUT')

        <!-- Judul -->
        <div style="margin-bottom: 20px;">
            <label for="title">Judul:</label><br>
            <input type="text" name="title" id="title" value="{{ $blog->title }}"
                style="width: 100%; padding: 8px; margin-top: 5px; font-size: 16px; border-radius: 8px; border: 1px solid #ccc;">
        </div>

        <!-- Konten: Input teks & koreksi -->
        <div style="display: flex; flex-wrap: wrap; gap: 20px; align-items: flex-start; max-width: 100%;">
            <!-- Input teks -->
            <div style="flex: 1; min-width: 0;">
                <label for="content">Masukkan teks:</label><br>
                <textarea name="content" id="content" rows="12"
                    style="width: 100%; padding: 10px; font-size: 16px; overflow: auto; resize: none; border-radius: 8px; border: 1px solid #ccc;">{{ $blog->content }}</textarea>
            </div>

            <!-- Tombol koreksi -->
            <div style="width: 140px; flex-shrink: 0; margin-left: 20px; display: flex; align-items: center; justify-content: center;">
                <button type="button" onclick="koreksi()"
                    style="width: 100%; padding: 12px 16px; font-size: 16px; background-color: #007BFF; color: white; border: none; border-radius: 8px; cursor: pointer; transition: background-color 0.3s;"
                    onmouseover="this.style.backgroundColor='#0056b3'"
                    onmouseout="this.style.backgroundColor='#007BFF'">
                    Koreksi →
                </button>
            </div>

            <!-- Hasil koreksi -->
            <div style="flex: 1; min-width: 0;">
                <label for="corrected_content">Hasil koreksi:</label><br>
                <textarea id="corrected_content" name="corrected_content" readonly rows="12"
                    style="width: 100%; padding: 10px; font-size: 16px; background: #f0f0f0; overflow: auto; resize: none; border-radius: 8px; border: 1px solid #ccc;">{{ $blog->corrected_content }}</textarea>
            </div>
        </div>

        <!-- Submit -->
        <button type="submit"
            style="margin-top: 30px; padding: 10px 20px; font-size: 16px; background-color: #007BFF; color: white; border: none; border-radius: 8px; cursor: pointer; transition: background-color 0.3s;"
            onmouseover="this.style.backgroundColor='#0056b3'"
            onmouseout="this.style.backgroundColor='#007BFF'">
            Update
        </button>
    </form>

    <!-- Script Koreksi -->
    <script>
        async function koreksi() {
            const content = document.getElementById('content').value;

            const response = await fetch('{{ route('blogs.correct') }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ text: content })
            });

            const data = await response.json();
            document.getElementById('corrected_content').value = data.corrected;
        }
    </script>
@endsection
