<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Learning Management System')</title>
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/favicon.ico') }}" />
    <!-- CSS Libraries -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script>
        // Set Authorization header dengan token dari localStorage
        const token = localStorage.getItem('token');
        if (token) {
            axios.defaults.headers.common['Authorization'] = `Bearer ${token}`;
        }

        // Fetch data pengguna saat tombol diklik
        document.getElementById('fetchData').addEventListener('click', function() {
            axios.get('/api/auth/me')
                .then(function(response) {
                    document.getElementById('userData').innerText = JSON.stringify(response.data, null, 2);
                })
                .catch(function(error) {
                    alert('Gagal mengambil data pengguna. Silakan login kembali.');
                    console.error(error);

                    // Jika gagal autentikasi, arahkan kembali ke login
                    if (error.response.status === 401) {
                        window.location.href = '/login';
                    }
                });
        });
    </script>
</head>

<body>
    <div class="container">
        <!-- Sidebar -->
        @include('components.sidebar')

        <!-- Main Content -->
        <div class="main-content">
            @include('components.header')
            @yield('content')
        </div>

        <!-- Right Panel -->
        @include('components.right-panel')
    </div>
    <script>
        // Jika token sudah ada di localStorage, set Authorization header untuk semua permintaan Axios
        const token = localStorage.getItem('token');
        if (token) {
            axios.defaults.headers.common['Authorization'] = `Bearer ${token}`;
        }
    </script>
</body>

</html>
