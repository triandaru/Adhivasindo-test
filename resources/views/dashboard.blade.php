@extends('layout.main')

@section('title', 'Dashboard - LMS')

@section('content')
    <div class="content">
        <div class="content-card">
            <span class="category">PEMOGRAMAN</span>
            <h2>Pemrograman Frontend Modern dengan React dan Angular</h2>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore
                magna aliqua. Quis ipsum suspendisse ultrices gravida.</p>
            <div class="meta-info">
                <div class="author">
                    <span><i class="bi bi-person m-3"></i></span> Pemateri By Josep
                </div>
                <div class="date">
                    <span><i class="bi bi-calendar3"></i></span> 14-06-2025
                </div>
            </div>
            <button class="start-learning">MULAI LEARNING</button>
        </div>

        <div class="modul-kompetensi">
            <div class="card-container">
                @include('components.card', [
                    'category' => 'PEMOGRAMAN',
                    'image' => 'assets/img/pemrograman.jpeg',
                    'competencies' => [
                        'Pemrograman Frontend Modern dengan React dan Angular',
                        'Pengembangan API Berstandar Industri dengan GraphQL dan REST',
                        'Menerapkan Clean Code dan Desain Pattern dalam Pengembangan Software',
                    ],
                ])
                <!-- Card 2: Creative Marketing -->
                @include('components.card', [
                    'category' => 'CREATIVE MARKETING',
                    'image' => 'assets/img/marketing.jpg',
                    'competencies' => [
                        'Storytelling dalam Pemasaran: Mengubah Data menjadi Cerita yang Menginspirasi',
                        'Pemasaran Viral: Bagaimana Menciptakan Konten yang Cepat Menyebar',
                        'Menggunakan User-Generated Content dalam Strategi Pemasaran Kreatif',
                    ],
                ])

                <!-- Card 3: Design -->
                @include('components.card', [
                    'category' => 'MANAGEMENT SDM',
                    'image' => 'assets/img/sdm.jpeg',
                    'competencies' => [
                        'Storytelling dalam Pemasaran: Mengubah Data menjadi Cerita yang Menginspirasi',
                        'Pemasaran Viral: Bagaimana Menciptakan Konten yang Cepat Menyebar',
                        'Menggunakan User-Generated Content dalam Strategi Pemasaran Kreatif',
                    ],
                ])
            </div>
        </div>
    </div>
    <script>
        document.getElementById('logout').addEventListener('click', function() {
            fetch('/auth/logout', {
                method: 'POST',
                headers: {
                    'Authorization': 'Bearer ' + localStorage.getItem('token'),
                },
            }).then(() => {
                alert('Logout berhasil');
                localStorage.removeItem('token');
                window.location.href = '/auth/login';
            });
        });
    </script>
@endsection
