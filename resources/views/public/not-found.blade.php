<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" property="og:description"
        content="Kelasbahasaturki.id adalah sebuah lembaga pendidikan bahasa dan persiapan kuliah di Turki dari alumni yang didirikan oleh Arsyah Nanda seorang diaspora Indonesia yang telah lama tinggal di Turki bersama alumni Turki. Belajar bahasa turki bersama kelasbahasaturki.id" />
    <title>KelasBahasaTurki</title>

    <!-- css -->
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <style>
        nav {
            background-color: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(4px);
            box-shadow: 0px 1px 5px rgba(155, 155, 155, 0.484);
            position: -webkit-sticky;
        }
        .container {
            text-align: center;
            margin: 190px 20px;
        }
    </style>

    <!-- font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=EB+Garamond&family=Rubik&display=swap" rel="stylesheet">

    <!-- page icon -->
    <link rel="icon" type="image/png" href="{{ asset('assets/img/logokbt.png') }}" />

    <!-- jquery -->
    <script type="text/javascript" src="{{ asset('assets/js/jquery.js') }}"></script>
</head>

<body>
    @include('public.layout.navbar')

    <div class="container">
        <h1>Oops, halaman yang kamu cari tidak ditemukan</h1>
    </div>

    <footer class="section footer">
        <div class="social-media">

        </div>
        <h2>Kantor Pusat</h2>
        <p>Jl. DI Panjaitan No.102 RW.03, Suryodiningratan, Kec. Mantrijeron, ​Kota Yogyakarta, DI Yogyakarta 55143 (7
            Menit dari malioboro)</p>

        <h2>RUKISAMA (Camp Siswa KBT)</h2>
        <p>Jl. Minggiran Baru MJ. 961 RT.49 RW.14 Kel Suryodiningratan, Kec. Mantrijeron, ​Kota Yogyakarta, DI
            Yogyakarta 55143 (8 Menit dari malioboro)</p>

        <strong><ion-icon name="call-outline"></ion-icon> +6285162 700100</strong>

        <p class="copyright">&copy 2023 Kelasbahasaturki.id by Faire+</p>
    </footer>

    <script src="{{ asset('assets/js/lib/swiper-bundle.min.js') }}"></script>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <script src="{{ asset('assets/js/jquery.js') }}"></script>
    <script src="{{ asset('assets/js/post.script.js') }}"></script>
</body>

</html>