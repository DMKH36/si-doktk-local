@extends('frontend.layouts.app')
@section('title', 'Beranda')
@section('content')
    <!-- ======= hero Section ======= -->
    <section id="hero" style="height: 85vh;">
        <div class="hero-content" data-aos="fade-up">
            <h2>Sistem Informasi</h2>
            <h1>Pengelolaan Dokumen</h1>
            <h1><a class="typewrite" data-period="2000" data-type='[ "Kemahasiswaan", "Alumni" ]'>
                    <span class="wrap"></span>
                </a></h1>
            <div class="text-center d-flex">
                <div class="">
                    <a href="/dokmasuk" class="btn-get-started scrollto">
                        <i class="bi bi-search" style="padding-right: 10px"></i> Cari Dokumen Masuk
                    </a>
                </div>
                <h3 class="mt-3" style="color: #001349"><i class="bi bi-distribute-horizontal"></i></h3>
                <div>
                    <a href="/dokkeluar" class="btn-get-started scrollto">
                        <i class="bi bi-search" style="padding-right: 10px"></i> Cari Dokumen Keluar
                    </a>
                </div>
            </div>
        </div>
        <div class="hero-slider swiper">
            <div class="swiper-wrapper">
                @foreach ($picture as $image)
                    <div class="swiper-slide" style="background-image: url('{{ asset($image->picture) }}');">
                    </div>
                @endforeach
            </div>
        </div>
    </section><!-- End Hero Section -->

    <main id="main">
        <!-- ======= About Section ======= -->
        <section id="about">
            <div class="container" data-aos="fade-up">
                <div class="row">
                    <div class="col-lg-4 about-img d-flex justify-content-center mb-3">
                        <img src="{{ asset($frontend->picture1) }}" alt="">
                    </div>
                    <div class="col-lg-7 ml-5 content">
                        <h2>{{ $frontend->title1 }}</h2>
                        <h3>{{ $frontend->subtitle1 }}</h3>
                        <p style="text-align: justify">{{ $frontend->body1 }}</p>
                    </div>
                </div>
                <div class="row mt-5">
                    <div class="col-lg-7 ml-5 content">
                        <h2>{{ $frontend->title2 }}</h2>
                        <h3>{{ $frontend->subtitle2 }}</h3>
                        <p style="text-align: justify">{{ $frontend->body2 }}</p>
                    </div>
                    <div class="col-lg-4 about-img d-flex justify-content-center">
                        <img src="{{ asset($frontend->picture2) }}" alt="">
                    </div>
                </div>
            </div>
        </section><!-- End About Section -->

        <!-- ======= Call To Action Section ======= -->
        <section id="call-to-action">
            <div class="container" data-aos="zoom-out">
                <div class="row">
                    <div class="col-lg-9 text-center text-lg-start">
                        <h3 class="cta-title">Perlu Bantuan?</h3>
                        <p class="cta-text"> Jika anda perlu bantuan kami, hubungi kami sekarang... </p>
                    </div>
                    <div class="col-lg-3 cta-btn-container text-center">
                        <a class="cta-btn align-middle"
                            href="https://api.whatsapp.com/send?phone=+62{{ $frontend->wanumber }}&text=Hello+Admin%2C+Saya+mau+bertanya"><i
                                class="bi bi-whatsapp" style="padding-right: 10px"></i> Hubungi Kami</a>
                    </div>
                </div>
            </div>
        </section><!-- End Call To Action Section -->

    </main>
@endsection

@section('script')
    <script>
        var TxtType = function(el, toRotate, period) {
            this.toRotate = toRotate;
            this.el = el;
            this.loopNum = 0;
            this.period = parseInt(period, 10) || 2000;
            this.txt = '';
            this.tick();
            this.isDeleting = false;
        };

        TxtType.prototype.tick = function() {
            var i = this.loopNum % this.toRotate.length;
            var fullTxt = this.toRotate[i];

            if (this.isDeleting) {
                this.txt = fullTxt.substring(0, this.txt.length - 1);
            } else {
                this.txt = fullTxt.substring(0, this.txt.length + 1);
            }

            this.el.innerHTML = '<span class="wrap">' + this.txt + '</span>';

            var that = this;
            var delta = 200 - Math.random() * 100;

            if (this.isDeleting) {
                delta /= 2;
            }

            if (!this.isDeleting && this.txt === fullTxt) {
                delta = this.period;
                this.isDeleting = true;
            } else if (this.isDeleting && this.txt === '') {
                this.isDeleting = false;
                this.loopNum++;
                delta = 500;
            }

            setTimeout(function() {
                that.tick();
            }, delta);
        };

        window.onload = function() {
            var elements = document.getElementsByClassName('typewrite');
            for (var i = 0; i < elements.length; i++) {
                var toRotate = elements[i].getAttribute('data-type');
                var period = elements[i].getAttribute('data-period');
                if (toRotate) {
                    new TxtType(elements[i], JSON.parse(toRotate), period);
                }
            }
            // INJECT CSS
            var css = document.createElement("style");
            css.type = "text/css";
            css.innerHTML = ".typewrite > .wrap { border-right: 0.08em solid #fff}";
            document.body.appendChild(css);
        };
    </script>
@endsection
