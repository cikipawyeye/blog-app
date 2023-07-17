<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="description" property="og:description"
        content="Kelasbahasaturki.id adalah sebuah lembaga pendidikan bahasa dan persiapan kuliah di Turki dari alumni yang didirikan oleh Arsyah Nanda seorang diaspora Indonesia yang telah lama tinggal di Turki bersama alumni Turki. Belajar bahasa turki bersama kelasbahasaturki.id" />
    <title>About Us</title>

    {{-- css --}}
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/about.css') }}">

    {{-- font --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=EB+Garamond&family=Rubik&display=swap" rel="stylesheet">

    <!-- page icon -->
    <link rel="icon" type="image/png" href="{{ asset('assets/img/logokbt-icon.png') }}" />
</head>

<body>
    @include('public.layout.navbar')
    <div class="hero">
        <h1>About Us</h1>
        <p>Lembaga bahasa dan Persiapan Kuliah di Turki & lembaga terbesar yang didirikan oleh alumni Turki!</p>
    </div>
    <div class="container">
        <div class="row">
            <div class="col">
                <img src="{{ asset('assets/img/m1_orig.png') }}" alt="" srcset="" width="100%">
            </div>
            <div class="col">
                <p>Kelasbahasaturki.id dirintis pertama kali sebagai sebuah komunitas budaya bernama learn from Turkey
                    pada tahun 2017. Awal mulanya komunitas ini hanya membahas tentang budaya dan kuliah di Turki secara
                    umum, namun seiring tumbuhnya tingkat ketertarikan pelajar Indonesia terhadap negara Turki serta
                    jaringan komunitas yang kuat saat itu, maka Arsyah Nanda kemudian bersama rekan rekannya Ahmed
                    Stevan, Wardah Hani Nurul Izza dan Annisa Nur Hidayah sesama mahasiswa di negara Turki memutuskan
                    untuk mendirikan lembaga Kelasbahasaturki.id pada tahun 2020 sebagai sebuah lembaga bahasa Turki
                    yang kemudian terus tumbuh dan berkembang hingga saat ini.
                </p>
                <p>Pada tahun 2021 kelasbahasaturki.id pun memutuskan untuk mengadakan program keberangkatan ke Turki
                    pertama kali sebagai respon atas permintaan ratusan siswa kami yang ingin melanjutkan pendidikannya
                    di Turki. Dengan komitmen untuk menyediakan fasilitas pendidikan yang baik dengan harga yang
                    terjangkau, serta membangun jaringan alumni yang kelasbahasaturki.id yang kelak dapat berkontribusi
                    bagi Indonesia kami berharap akan mampu memberikan solusi bagi seluruh calon mahasiswa Indonesia
                    yang ingin melanjutkan pendidikan di Turki. Karena bagi kami sebagai sesama alumni Turki "siswa
                    adalah adik kelas kami sendiri" sehingga harus kami bimbing hingga bisa tumbuh dan berkembang di
                    negara Turki.
                </p>
                <a class="btn">Hubungi Kami (via WhatsApp)</a>
            </div>
        </div>
        <div class="row section offer">
            <div class="content">
                <h2>Pelopor pembelajaran bahasa Turki</h2>
                <p>Kelasbahasaturki.id merupakan pelopor pembelajaran bahasa Turki dengan menggunakan bahasa Indonesia terbaik di Indonesia dengan 2000+ murid sejak tahun 2020.</p>
                <button >Lihat di sini</button>
            </div>
        </div>
    </div>


    @include('public.layout.footer')
</body>

</html>
