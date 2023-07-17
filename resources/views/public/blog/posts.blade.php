<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="description" property="og:description"
        content="Kelasbahasaturki.id adalah sebuah lembaga pendidikan bahasa dan persiapan kuliah di Turki dari alumni yang didirikan oleh Arsyah Nanda seorang diaspora Indonesia yang telah lama tinggal di Turki bersama alumni Turki. Belajar bahasa turki bersama kelasbahasaturki.id" />
    <title>Blog | KelasBahasaTurki</title>

    <!-- css -->
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/posts.css">

    <!-- font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=EB+Garamond&family=Rubik&display=swap" rel="stylesheet">

    <!-- page icon -->
    <link rel="icon" type="image/png" href="assets/img/logokbt-icon.png" />
</head>

<body>
    @include('public.layout.navbar')
    <div class="hero">
        <h1>Blog</h1>
        {{-- <p>Lembaga bahasa dan Persiapan Kuliah di Turki & lembaga terbesar yang didirikan oleh alumni Turki!</p> --}}
    </div>
    <div class="container">
        <div class="row">
            @foreach ($posts as $post)
                <article class="card">
                    @if ($post->banner_url != null)
                        <img src="{{ asset('storage/'.$post->banner_url) }}" alt="" width="100%"
                            height="100%">
                    @else
                        <img src="{{ asset('assets/img/Ankara-University.jpg') }}" alt="" width="100%"
                            height="100%">
                    @endif
                    <div class="card_content">
                        <a href="/blog/{{ $post->slug }}" class="card_title">{{ $post->title }}</a>
                        <a href="#" class="category">
                            {{ $post->category->name }}
                        </a>
                        <p class="card_description">{{ strip_tags(Str::limit($post->post, 200, '...')) }}</p>
                    </div>
                </article>
            @endforeach
        </div>
    </div>
</body>

</html>
