<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" property="og:description"
        content="Kelasbahasaturki.id adalah sebuah lembaga pendidikan bahasa dan persiapan kuliah di Turki dari alumni yang didirikan oleh Arsyah Nanda seorang diaspora Indonesia yang telah lama tinggal di Turki bersama alumni Turki. Belajar bahasa turki bersama kelasbahasaturki.id" />
    <title>{{ $post->title }}</title>

    <!-- css -->
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/post.css') }}">

    <!-- font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=EB+Garamond&family=Rubik&display=swap" rel="stylesheet">

    <!-- page icon -->
    <link rel="icon" type="image/png" href="{{ asset('assets/img/logokbt-icon.png') }}" />

    <!-- jquery -->
    <script type="text/javascript" src="{{ asset('assets/js/jquery.js') }}"></script>
</head>

<body>

    @include('public.layout.navbar')

    <div class="container">
        <div class="background"></div>
        <div class="content">
            <div class="post-attribute">
                <p class="category">{{ $post->category->name }}</p>
                <div>
                    <h1 class="post-title">{{ $post->title }}</h1>
                </div>
                <p>
                    
                    <span class="post-writer">
                        @php
                            $person = [];
                            foreach ($post->users as $user) {
                                array_push($person, $user->name);
                            }
                            echo implode(', ', $person);
                        @endphp    
                    </span><br>
                    <span class="post-date">Published {{ Str::limit($post->updated_at, 10, '') }}</span>
                </p>
            </div>
            <article class="post-content">
                @if ($post->banner_url != null)
                    <img src="{{ asset('storage/'.$post->banner_url) }}" alt="" width="100%">
                @else
                    <img src="{{ asset('assets/img/banner1.jpg') }}" alt="" width="100%">
                @endif
                {!! $post->post !!}
            </article>
        </div>
    </div>

    @include('public.layout.footer')

    <script src="{{ asset('assets/js/lib/swiper-bundle.min.js') }}"></script>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <script src="{{ asset('assets/js/jquery.js') }}"></script>
    <script src="{{ asset('assets/js/post.script.js') }}"></script>
</body>

</html>