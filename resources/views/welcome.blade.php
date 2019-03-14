<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=no">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="author" content="">
    <meta property="og:title" content="">
    <meta property="og:site_name" content="">
    <meta property="og:url" content="">
    <meta property="og:description" content="">
    <meta property="og:image" content="">
    <meta property="og:type" content="website">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:domain" content="">
    <meta name="twitter:description" content="">
    <meta name="twitter:title" content="">
    <meta name="twitter:image" content="">
    <meta name="twitter:image:width" content="1300">
    <meta name="twitter:image:height" content="697">
    <meta name="twitter:url" content="">
    <meta name="theme-color" content="#FF6347">
    <title>Glosari</title>
    <link rel="shortcut icon" type="image/x-icon" href="https://amanz.my/wp-content/uploads/2018/08/favicon-glosari.ico">
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.0/normalize.min.css" integrity="sha256-oSrCnRYXvHG31SBifqP2PM1uje7SJUyX0nTwO2RJV54=" crossorigin="anonymous">
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>
    <!--[if lt IE 10]> 
        <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a target="_blank" href="http://outdatedbrowser.com/">upgrade your browser</a> to improve your experience.</p>
    <![endif]-->
    <section class="gs-hero-section">
        <div class="container">
            <div class="wrapper">
                <div><img src="https://amanz.my/wp-content/uploads/2019/02/desktop.jpg" alt="bg-hero"></div>
                <div>
                    <h4>Glosari</h4>
                    <hr />
                    <p>Glosari menggunakan sokongan pembelajaran mesin (teknologi pemprosesan bahasa komunikasi) dalam menambah-baik serta membaiki kesilapan ejaan dan tatabahasa. Teknologi kami dibangunkan dalam bentuk sumber terbuka bersama komuniti.</p>
                    <div class="cta">
                    @if (Auth::guest())	
                        <a href="{{ url('/register') }}">
                            <button class="btn btn-grey">Jadi Penyumbang</button>
                        </a>
                        <a href="{{ url('/login') }}">
                            <button class="btn btn-black">Daftar Masuk</button>
                        </a>
                    @else 
						<a href="{{ url('/dashboard') }}">
                            <button class="btn btn-black">Daftar Masuk</button>
                        </a>
                    @endif
                    </div>
                </div>
            </div>
            <p class="copyright">© <b><a href="https://amanz.my/" target="_blank">Amanz</a></b> 2018. Hak Cipta Bersama.</p>
        </div>
    </section>
</body>

</html>