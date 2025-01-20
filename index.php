<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tri Cahya Armanditha - Website Pribadi</title>
    <link rel="stylesheet" href="CSS\personalwebsite.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <script src="https://unpkg.com/typed.js@2.1.0/dist/typed.umd.js"></script>
</head>
<style>
    .home {
    position: relative;
    width: 100%;
    justify-content: space-between;
    height: 100vh;
    background: url(back.jpg) no-repeat;
    background-size: cover;
    background-position: center;
    display: flex;
    align-items: center;
    padding: 70px 10% 0;
}
</style>

<body>
    <header class="header">
        <a href="#" class="logo">Crafting Digital Dreams</a>

        <nav class="navbar">
            <a href="#home" style="--i:1" class="active">Home</a>
            <a href="#about" style="--i:2">About</a>
            <a href="#services" style="--i:3">Services</a>
            <a href="#portfolio" style="--i:4">Product</a>
            <a href="#contact" style="--i:5">Contact</a>
            <a href="price.php" style="--i:6">Price</a>
            <a href="loginform.php" style="--i:7">Login to Dashboard</a>
        </nav>
    </header>

    <section class="home" id="home">
        <div class="home-content">
            <div class="text-content">
                <h3>Welcome to Crafting Digital Dreams!</h3>
                <h1>I specialize in delivering personalized services that bring your visions to life.</h1>
                <h3>What I Offer: <span class="text"></span></h3>
                <p>Let's turn your dreams into reality!.</p>
            </div>
            <a href="contact.php" class="btn-box">Check Info</a>
        </div>
    </section>

    <section class="about" id="about">
        <div class="about-content">
            <div class="about-img">
                <img src="images\ikonku.jpg" alt="About Picture" class="glow-effect">
            </div>
            <div class="about-text">
                <h2>About <span>Crafting Digital Dreams</span></h2>
                <h4>Creative Digital Solutions for a Modern World</h4>
                <p>Crafting Digital Dreams adalah wujud dari kreativitas dan hasratku terhadap teknologi modern. Layanan
                    ini dirancang
                    untuk menghadirkan solusi digital seperti website, aplikasi mobile, hingga desain UI/UX yang
                    memadukan fungsi dan
                    estetika. Saat ini, aku sedang mengembangkan proyek website sederhana menggunakan HTML, CSS, dan
                    PHP, serta terus
                    mengasah keterampilan untuk menghadirkan hasil terbaik bagi setiap klien.
                </p>
                <a href="#services" class="btn-box">Explore My Services</a>
            </div>
        </div>
    </section>

    <section>
        <div class="services" id="services">
            <div class="container">
                <h1 class="sub-title">My <span>Services</span></h1>
                <div class="services-list">
                    <div>
                        <i class='bx bx-code-alt' style='color:rgb(0, 217, 255)'></i>
                        <h2>Web Design</h2>
                        <p>Menyediakan layanan desain web dengan sentuhan estetika dan elegan, mengutamakan tampilan
                            yang lembut dan menenangkan untuk pengalaman browsing yang berkesan</p>
                        <a href="form.php?service=Web%20Design" class="read" target="_blank">Order Now</a>
                    </div>
                    <div>
                        <i class='bx bx-crop' style='color:rgb(0, 217, 255)'></i>
                        <h2>UI/UX Design</h2>
                        <p>Merancang antarmuka dan pengalaman pengguna yang halus dan intuitif, menghadirkan kesan
                            lembut dan estetis di setiap elemen agar tampilan terasa nyaman dan harmonis</p>
                        <a href="form.php?service=UI/UX%20Design" class="read" target="_blank">Order Now</a>
                    </div>
                    <div>
                        <i class='bx bxl-apple' style='color:rgb(0, 217, 255)'></i>
                        <h2>App Design</h2>
                        <p>Desain aplikasi yang memadukan kelembutan dan kesederhanaan, menekankan pada keindahan dan
                            kesan elegan untuk menciptakan pengalaman pengguna yang menenangkan</p>
                        <a href="form.php?service=App%20Design" class="read" target="_blank">Order Now</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section>
        <div id="portfolio" id="project">
            <div class="main-text" id="project">
                <h2>My <span>Product</span></h2>

                <div class="portfolio-content">
                    <div class="row">
                        <img src="images\project1.jpg">
                        <div class="layer">
                            <h5>Kalkulator BMI</h5>
                            <p>Proyek ini adalah aplikasi sederhana yang menghitung Indeks Massa Tubuh (BMI) berdasarkan
                                input berat badan dan tinggi badan pengguna. Aplikasi ini dirancang untuk memberikan
                                informasi kesehatan secara cepat dan praktis.
                            </p>
                            <a href="form.php?service=kalkulator%20BMI" class="read" target="_blank">Order Now</a>
                        </div>
                    </div>

                    <div class="row">
                        <img src="images\project2.jpg">
                        <div class="layer">
                            <h5>Personal Website</h5>
                            <p>Website pribadi yang dibuat menggunakan HTML, CSS, dan PHP ini menampilkan informasi
                                diri, pengalaman, dan cara menghubungi pemilik. Desain yang elegan dan user-friendly
                                memberikan kesan profesional dan mudah dinavigasi.
                            </p>
                            <a href="form.php?service=Personal%20Website" class="read" target="_blank">Order Now</a>
                        </div>
                    </div>

                    <div class="row">
                        <img src="images\project3.jpg">
                        <div class="layer">
                            <h5> App Management Event</h5>
                            <p>Aplikasi ini digunakan untuk mengelola acara, termasuk fitur pendaftaran peserta, jadwal
                                acara, dan notifikasi. Aplikasi ini dirancang untuk memudahkan pengorganisasian dan
                                pelaksanaan acara secara efisien.
                            </p>
                            <a href="form.php?service=App%20Management%20Event" class="read" target="_blank">Order Now</a>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="contact" id="contact">
        <div class="contact-text">
            <h2>Contact <span>Me</span></h2>
            <h4>Let's Work Together</h4>
            <p>
                Mari bersama-sama menciptakan karya digital yang tidak hanya fungsional, tetapi juga penuh estetika dan
                keunikan dengan Crafting Digital Dreams! Aku percaya bahwa setiap ide memiliki potensi luar biasa yang
                dapat diwujudkan melalui sentuhan kreatif dan inovatif. Dengan keahlian di bidang desain web,
                pengembangan aplikasi, dan solusi teknologi modern, aku siap membantu mewujudkan impian digitalmu.
            </p>
            <p>
                Baik itu proyek pribadi, kebutuhan bisnis, atau portofolio kreatif, aku akan menghadirkan hasil terbaik
                yang dirancang khusus untuk merepresentasikan visimu. Bersama, kita dapat mengubah konsep sederhana
                menjadi pengalaman digital yang memikat dan penuh kesan. Yuk, mulai perjalanan ini dan jadikan
                ide-idemu nyata!
            </p>
            <div class="contact-list">
                <li><i class='bx bxs-send'></i>initricahya@gmail.com</li>
                <li><i class='bx bx-phone'></i>087811127535</li>
            </div>

            <div class="contact-icon">
                <a href="https://www.tiktok.com/@chaaa111111?_t=ZS-8somhtgJjE8&_r=1" target="_blank"><i class='bx bxl-tiktok'></i></a>
                <a href="https://www.instagram.com/ezchaa.l?igsh=ZmwxbjR5aGUxMWwx" target="_blank"><i class='bx bxl-instagram-alt'></i></a>
                <a href="https://youtube.com/@initricahya?si=RHDnkLZ4TNEbu70G" target="_blank"><i class='bx bxl-youtube'></i></a>
                <a href="https://github.com/TriCahyaArmanditha" target="_blank"><i class='bx bxl-github'></i></a>
            </div>
        </div>

        <div class="contact-form">
        <form action="submit_message.php" method="POST">
        <input type="text" name="name" placeholder="Enter Your Name" required>
        <input type="email" name="email" placeholder="Enter Your Email" required>
        <input type="text" name="subject" placeholder="Enter Your Subject">
        <textarea name="message" id="" cols="48" rows="10" placeholder="Enter Your Message" required></textarea>
        <input type="submit" value="Submit" class="send">
    </form>
    </div>
    </section>
    <div class="last-text">
        <p>&copy; 2025 by Tri Cahya Armanditha. Crafted with passion and creativity.</p>
    </div>
    <a href="#" class="top"><i class='bx bxs-chevrons-up'></i></i></a>









    <script src="JS\personalwebsite.js"></script>
</body>

</html>