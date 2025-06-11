@extends('layouts.app')

@section('content')
    <h1 style="font-size: 32px; font-weight: bold; margin-bottom: 20px;">Buat Blog</h1>

    <form method="POST" action="{{ route('blogs.store') }}">
        @csrf

        <!-- Judul -->
        <div style="margin-bottom: 20px;">
            <label for="title">Judul:</label><br>
            <input type="text" name="title" id="title" style="width: 100%; padding: 8px; margin-top: 5px; font-size: 16px; border-radius: 8px; border: 1px solid #ccc;">
        </div>

            <!-- Konten: Input teks & koreksi -->
        <div style="display: flex; flex-wrap: wrap; gap: 20px; align-items: flex-start; max-width: 100%;">
            <!-- Input teks -->
            <div style="flex: 1; min-width: 0;">
                <label for="content">Masukkan teks:</label><br>
                <textarea name="content" id="content" rows="12"
                    style="width: 100%; padding: 10px; font-size: 16px; overflow: auto; resize: none; border-radius: 8px; border: 1px solid #ccc;"></textarea>
            </div>

            <!-- Tombol koreksi -->
            <div style="width: 120px; flex-shrink: 0; margin-left: 20px; display: flex; align-items: center; justify-content: center;">
                <button type="button" onclick="koreksi()"
                    style="width: 100%; padding: 12px 16px; font-size: 16px; background-color: #007BFF; color: white; border: none; border-radius: 8px; cursor: pointer; transition: background-color 0.3s;"
                    onmouseover="this.style.backgroundColor='#0056b3'"
                    onmouseout="this.style.backgroundColor='#007BFF'">
                    Koreksi →
                </button>
            </div>

            <!-- Hasil koreksi -->
            <div style="flex: 1; min-width: 0;">
                <label for="koreksi">Hasil koreksi:</label><br>
                <textarea id="koreksi" readonly rows="12"
                    style="width: 100%; padding: 10px; font-size: 16px; background: #f0f0f0; overflow: auto; resize: none; border-radius: 8px; border: 1px solid #ccc;"></textarea>
            </div>
        </div>

        <!-- Simpan -->
        <button type="submit"
            style="margin-top: 30px; padding: 10px 20px; font-size: 16px; background-color: #007BFF; color: white; border: none; border-radius: 6px; cursor: pointer;">
            Simpan
        </button> 
    </form>

    <!-- Script Koreksi -->
    <script>
        function koreksi() {
            const text = document.getElementById("content").value;

            fetch("http://127.0.0.1:5000/correct", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json"
                },
                body: JSON.stringify({ text })
            })
            .then(response => response.json())
            .then(data => {
                document.getElementById("koreksi").value = data.corrected;
            })
            .catch(err => {
                alert("Gagal koreksi: " + err);
            });
        }
    </script>
@endsection
