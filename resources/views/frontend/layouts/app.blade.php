<!doctype html>
<html lang="en">
@include('frontend.partials.head')

<body>
    @include('frontend.partials.header')
    @yield('content')
    @include('frontend.partials.footer')

    <a href="#" class="back-to-top d-flex bg-secondary align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

    <!-- Vendor JS Files -->
    <script src="{{ asset('frontend/vendor/aos/aos.js') }}"></script>
    <script src="{{ asset('frontend/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('frontend/vendor/glightbox/js/glightbox.min.js') }}"></script>
    <script src="{{ asset('frontend/vendor/isotope-layout/isotope.pkgd.min.js') }}"></script>
    <script src="{{ asset('frontend/vendor/swiper/swiper-bundle.min.js') }}"></script>
    <script src="{{ asset('frontend/vendor/php-email-form/validate.js') }}"></script>

    <!-- Template Main JS File -->
    <script src="{{ asset('frontend/js/main.js') }}"></script>

    <!-- Jquery Minified -->
    <script src="https://code.jquery.com/jquery-3.6.1.min.js"
        integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>

    <!-- Data Tables -->
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.js"></script>

    <!-- Page Script -->
    @yield('script')
</body>

</html>
