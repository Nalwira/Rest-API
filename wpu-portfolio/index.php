<?php
function get_CURL($url) 
{
  $curl = curl_init();
  curl_setopt($curl, CURLOPT_URL, $url);
  curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
  $result = curl_exec($curl);
  curl_close($curl);
  
return json_decode($result, true);
}

$result = get_CURL ('https://www.googleapis.com/youtube/v3/channels?part=snippet,statistics&id=UC3-nEfI8jfrcEj1Fmv8kIdA&key=AIzaSyCa3Ee6IxCyg6cFZPThm1vY9hKqTRjtLGE');
 
$youtubeProfilePic = $result['items'][0]['snippet']['thumbnails']['medium']['url'];
$channelName = $result['items'][0]['snippet']['title'];
$subscriber = $result['items'][0]['statistics']['subscriberCount'];

// latest video
$urlLatest = 'https://www.googleapis.com/youtube/v3/search?key=AIzaSyCa3Ee6IxCyg6cFZPThm1vY9hKqTRjtLGE&channelId=UC3-nEfI8jfrcEj1Fmv8kIdA&maxResults=1&part=snippet&order=date';
$result = get_CURL($urlLatest);
$LatestVideoId = $result['items'][0]['id']['videoId'];


//Instagram API
$clientId = '17841417824771436';
$accessToken = 'IGAAc3CEeY2hBBZAE55WW1iMUpjMzQxR0FGNkZAiZAWtTZADhaY2RXcENnM0o5MDVqeUR4RTcwY0hDR0dpU1BDZAWI4UVVYdGlBcVU4QmFpeFZAKdXByOXkwS3R4WmdQalJkSnVWSi1HSWltdGRsYjY4bmVYMEgwZAGs4TGRYMTQ1cmppMAZDZD';

$result = get_CURL("https://graph.instagram.com/v22.0/me?fields=username,profile_picture_url,followers_count&access_token=$accessToken");
$usernameIG = $result['username'];
$profilePictureIG = $result['profile_picture_url'];
$followersIG = $result['followers_count'];

//media IG
$media = get_CURL("https://graph.instagram.com/me/media?fields=id,caption,media_url,media_type,timestamp&access_token=$accessToken");
$gambar = "";
if (isset($media['data']) && count($media['data']) >= 1) {
    $gambar = $media['data'][0]['media_url'];
}

?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">

    <!-- My CSS -->
    <link rel="stylesheet" href="css/style.css">

    <title>My Portfolio</title>
  </head>
  <body>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
      <div class="container">
        <a class="navbar-brand" href="#home">Naura Zavia</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
          <ul class="navbar-nav">
            <li class="nav-item">
              <a class="nav-link" href="#home">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#about">About</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#portfolio">Portfolio</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>


    <div class="jumbotron" id="home">
      <div class="container">
        <div class="text-center">
          <img src="img/profile5.png" class="rounded-circle img-thumbnail" style="width: 200px; height: 200px; object-fit: cover;">
          <h1 class="display-4">Naura Zavia</h1>
          <h3 class="lead">College Student | Programmer | Youtuber</h3>
        </div>
      </div>
    </div>


    <!-- About -->
    <section class="about" id="about">
      <div class="container">
        <div class="row mb-4">
          <div class="col text-center">
            <h2>About</h2>
          </div>
        </div>
        <div class="row justify-content-center">
          <div class="col-md-5">
            <p>Sebagai mahasiswa, aku meyakini bahwa proses belajar tidak berhenti di ruang kelas. Setiap hari adalah kesempatan untuk memahami hal-hal baru, mencoba, dan tumbuh. Aku suka menjelajahi dunia teknologi, mengeksplorasi berbagai ide, dan menantang diriku untuk terus berkembang. Bagiku, perjalanan ini bukan sekadar mencari nilai akademik, tetapi juga membentuk karakter, cara berpikir, dan semangat untuk tidak cepat puas dengan apa yang sudah dicapai.</p>
          </div>
          <div class="col-md-5">
            <p>Di sisi lain, aku melihat pentingnya memiliki keterampilan yang relevan di era digital saat ini. Oleh karena itu, aku terus mengasah kemampuan di bidang yang aku minati—terutama teknologi, pemrograman, dan konten kreatif. Aku percaya bahwa dengan terus belajar dan beradaptasi, kita bisa menciptakan dampak yang nyata. Tujuanku sederhana: menjadi pribadi yang tidak hanya berkembang untuk diri sendiri, tetapi juga bisa memberi kontribusi positif bagi lingkungan sekitar.</p>
          </div>
        </div>
      </div>
    </section>


    <!-- Youtube & IG -->
    <section class="social bg-light" id="social">
      <div class="container">
        <div class="row pt-4 mb-4">
          <div class="col text-center">
            <h2>Social Media</h2>
          </div>
        </div>

        <div class="row justify-content-center">
          <div class="col-md-5">
            <div class="row">
              <div class="col-md-4">
                <img src="<?= $youtubeProfilePic; ?>" width="200" class="rounded-circle img-thumbnail">
              </div>
              <div class="col-md-8">
                <h5><?= $channelName; ?></h5>  
                <p><?= $subscriber; ?> Subscriber</p>
                <div class="g-ytsubscribe" data-channelid="UC3-nEfI8jfrcEj1Fmv8kIdA" data-layout="default" data-count="default"></div>
              </div>
            </div>
            <div class="row">
              <div class="col">
                <div class="embed-responsive embed-responsive-16by9">
                  <iframe src="https://www.youtube.com/embed/<?= $LatestVideoId; ?>?rel=0" title="YouTube video" allowfullscreen></iframe>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-5">
            <div class="row">
              <div class="col-md-4">
                <img src="<?= $profilePictureIG; ?>" width="200" class="rounded-circle img-thumbnail">
              </div>
              <div class="col-md-8">
                <h5><?= $usernameIG; ?></h5>
                <p><?= $followersIG; ?> Followers</p>
              </div>
            </div>

            <div class="row">
              <div class="col">
                <div class="embed-responsive embed-responsive-5by2">
                  <img src="<?= $gambar; ?>" class="img-fluid rounded mb-2" style="width: 500px; height: 400px; object-fit: cover;">
                </div>
              </div>
            </div>
          </div>
        </div>
    </section>


    <!-- Portfolio -->
    <section class="portfolio" id="portfolio">
      <div class="container">
        <div class="row pt-4 mb-4">
          <div class="col text-center">
            <h2>Portfolio</h2>
          </div>
        </div>
        <div class="row">
          <div class="col-md mb-4">
            <div class="card">
              <img class="card-img-top" src="img/thumbs/7.png" alt="Card image cap" style="width: 345px; height: 300px; object-fit: cover;">
              <div class="card-body">
                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
              </div>
            </div>
          </div>

          <div class="col-md mb-4">
            <div class="card">
              <img class="card-img-top" src="img/thumbs/10.png" alt="Card image cap" style="width: 345px; height: 300px; object-fit: cover;">
              <div class="card-body">
                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
              </div>
            </div>
          </div>

          <div class="col-md mb-4">
            <div class="card">
              <img class="card-img-top" src="img/thumbs/12.png" alt="Card image cap" style="width: 345px; height: 300px; object-fit: cover;">
              <div class="card-body">
                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
              </div>
            </div>
          </div>   
        </div>

        <div class="row">
          <div class="col-md mb-4">
            <div class="card">
              <img class="card-img-top" src="img/thumbs/4.png" alt="Card image cap">
              <div class="card-body">
                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
              </div>
            </div>
          </div> 
          <div class="col-md mb-4">
            <div class="card">
              <img class="card-img-top" src="img/thumbs/5.png" alt="Card image cap">
              <div class="card-body">
                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.
                </p>
              </div>
            </div>
          </div>

          <div class="col-md mb-4">
            <div class="card">
              <img class="card-img-top" src="img/thumbs/6.png" alt="Card image cap">
              <div class="card-body">
                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>


    <!-- Contact -->
    <section class="contact bg-light" id="contact">
      <div class="container">
        <div class="row pt-4 mb-4">
          <div class="col text-center">
            <h2>Contact</h2>
          </div>
        </div>

        <div class="row justify-content-center">
          <div class="col-lg-4">
            <div class="card bg-primary text-white mb-4 text-center">
              <div class="card-body">
                <h5 class="card-title">Contact Me</h5>
                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
              </div>
            </div>
            
            <ul class="list-group mb-4">
              <li class="list-group-item"><h3>Location</h3></li>
              <li class="list-group-item">My Office</li>
              <li class="list-group-item">Seiba, Padang</li>
              <li class="list-group-item">West Sumatera, Indonesia</li>
            </ul>
          </div>

          <div class="col-lg-6">
            
            <form>
              <div class="form-group">
                <label for="nama">Nama</label>
                <input type="text" class="form-control" id="nama">
              </div>
              <div class="form-group">
                <label for="email">Email</label>
                <input type="text" class="form-control" id="email">
              </div>
              <div class="form-group">
                <label for="phone">Phone Number</label>
                <input type="text" class="form-control" id="phone">
              </div>
              <div class="form-group">
                <label for="message">Message</label>
                <textarea class="form-control" id="message" rows="3"></textarea>
              </div>
              <div class="form-group">
                <button type="button" class="btn btn-primary">Send Message</button>
              </div>
            </form>

          </div>
        </div>
      </div>
    </section>


    <!-- footer -->
    <footer class="bg-dark text-white mt-5">
      <div class="container">
        <div class="row">
          <div class="col text-center">
            <p>naurazavia@gmail.com</p>
          </div>
        </div>
      </div>
    </footer>





<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Naura Zavia Portfolio</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" />
    <style>
      /* --- CSS untuk header unik dan menarik --- */

      body {
        padding-top: 70px;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        background-color: #f8f9fa;
      }

      /* Navbar with subtle shadow and smooth background transition */
      nav.navbar {
        background: linear-gradient(90deg, #6a11cb 0%, #2575fc 100%);
        box-shadow: 0 4px 8px rgba(0,0,0,0.15);
        transition: background-color 0.3s ease;
      }
      nav.navbar:hover {
        background: linear-gradient(90deg, #2575fc 0%, #6a11cb 100%);
      }
      nav.navbar .navbar-brand {
        font-weight: 700;
        font-size: 1.8rem;
        letter-spacing: 2px;
        color: #fff !important;
        text-shadow: 0 1px 4px rgba(0,0,0,0.6);
      }
      nav.navbar .nav-link {
        color: #e0e0e0 !important;
        font-weight: 600;
        transition: color 0.3s ease;
      }
      nav.navbar .nav-link:hover {
        color: #fff !important;
        text-shadow: 0 0 5px #fff;
      }

      /* Jumbotron with animated gradient background */
      .jumbotron {
        position: relative;
        background: linear-gradient(-45deg, #ee7752, #e73c7e, #23d5ab, #23a6d5);
        background-size: 400% 400%;
        animation: gradientBG 15s ease infinite;
        color: white;
        padding-top: 4rem;
        padding-bottom: 4rem;
        margin-bottom: 0;
        text-align: center;
        overflow: hidden;
      }

      @keyframes gradientBG {
        0% {background-position: 0% 50%;}
        50% {background-position: 100% 50%;}
        100% {background-position: 0% 50%;}
      }

      /* Profile image with glowing effect */
      .jumbotron img {
        border-radius: 50%;
        width: 200px;
        height: 200px;
        object-fit: cover;
        border: 5px solid rgba(255,255,255,0.7);
        box-shadow: 0 0 20px rgba(255,255,255,0.9);
        transition: box-shadow 0.3s ease;
      }
      .jumbotron img:hover {
        box-shadow: 0 0 40px #fff, 0 0 60px #23d5ab, 0 0 80px #23a6d5;
      }

      /* Animated typing effect for subtitle */
      .typed-text {
        font-size: 1.5rem;
        font-weight: 600;
        font-family: 'Courier New', Courier, monospace;
        white-space: nowrap;
        overflow: hidden;
        border-right: 0.15em solid white;
        animation: typing 4s steps(30, end), blink-caret 0.75s step-end infinite;
        margin-top: 1rem;
      }

      @keyframes typing {
        from {width: 0;}
        to {width: 100%;}
      }

      @keyframes blink-caret {
        0%, 100% {border-color: transparent;}
        50% {border-color: white;}
      }

      /* --- About Section --- */
      #about {
        max-width: 1000px;
        margin: 70px auto 90px auto;
        padding: 20px;
        background: white;
        border-radius: 15px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        opacity: 0;
        transform: translateY(40px);
        animation: fadeInUp 1s ease forwards;
        animation-delay: 0.5s;
      }

      #about h2 {
        font-size: 2.2rem;
        font-weight: 700;
        color: #2575fc;
        margin-bottom: 15px;
        letter-spacing: 1.5px;
        text-align: center;
      }

      #about p {
        font-size: 1.1rem;
        line-height: 1.6;
        color: #444;
        text-align: justify;
        padding: 0 15px;
      }

      /* --- Portfolio Section --- */
      #portfolio {
        max-width: 1500px;
        margin: 0 auto 70px auto;
      }

      #portfolio h2 {
        font-size: 2.4rem;
        font-weight: 700;
        color: #2575fc;
        margin-bottom: 40px;
        text-align: center;
        letter-spacing: 1.7px;
      }

      .portfolio-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit,minmax(280px,1fr));
        gap: 30px;
      }

      .portfolio-item {
        background: white;
        border-radius: 15px;
        box-shadow: 0 10px 25px rgba(0,0,0,0.12);
        overflow: hidden;
        cursor: pointer;
        transform: translateY(30px);
        opacity: 0;
        animation: fadeInUp 0.7s ease forwards;
      }

      .portfolio-item:hover {
        transform: translateY(0) scale(1.05);
        box-shadow: 0 15px 40px rgba(37,117,252,0.4);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
      }

      .portfolio-item img {
        width: 100%;
        height: 180px;
        object-fit: cover;
        display: block;
      }

      .portfolio-item .content {
        padding: 20px;
      }

      .portfolio-item .title {
        font-weight: 700;
        font-size: 1.3rem;
        color: #2575fc;
        margin-bottom: 8px;
      }

      .portfolio-item .description {
        font-size: 1rem;
        color: #555;
        line-height: 1.4;
      }

      .portfolio-item:nth-child(1) {
        animation-delay: 0.3s;
      }
      .portfolio-item:nth-child(2) {
        animation-delay: 0.6s;
      }
      .portfolio-item:nth-child(3) {
        animation-delay: 0.9s;
      }
      .portfolio-item:nth-child(4) {
        animation-delay: 1.2s;
      }
      .portfolio-item:nth-child(5) {
        animation-delay: 1.5s;
      }
      .portfolio-item:nth-child(6) {
        animation-delay: 1.8s;
      }

      /* Keyframes */
      @keyframes fadeInUp {
        to {
          opacity: 1;
          transform: translateY(0);
        }
      }
    </style>
  </head>
  <body>

    <nav class="navbar navbar-expand-lg navbar-dark fixed-top">
      <div class="container">
        <a class="navbar-brand" href="#home">Naura Zavia</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" 
          aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item"><a class="nav-link" href="#home">Home</a></li>
            <li class="nav-item"><a class="nav-link" href="#about">About</a></li>
            <li class="nav-item"><a class="nav-link" href="#portfolio">Portfolio</a></li>
          </ul>
        </div>
      </div>
    </nav>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html>
