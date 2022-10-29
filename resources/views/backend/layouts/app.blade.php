<!doctype html>
<html lang="en">
@include('backend.partials.head')

<body>
    @include('backend.partials.navbar')
    @include('backend.partials.sidebar')
    <main id="main" class="main">
        @yield('content')
    </main>
    @include('backend.partials.footer')

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

    <!-- Vendor JS Files -->
    <script src="{{ asset('backend/vendor/apexcharts/apexcharts.min.js') }}"></script>
    <script src="{{ asset('backend/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('backend/vendor/chart.js/chart.min.js') }}"></script>
    <script src="{{ asset('backend/vendor/echarts/echarts.min.js') }}"></script>
    <script src="{{ asset('backend/vendor/quill/quill.min.js') }}"></script>
    <script src="{{ asset('backend/vendor/simple-datatables/simple-datatables.js') }}"></script>
    <script src="{{ asset('backend/vendor/tinymce/tinymce.min.js') }}"></script>
    <script src="{{ asset('backend/vendor/php-email-form/validate.js') }}"></script>

    <!-- Template Main JS File -->
    <script src="{{ asset('backend/js/main.js') }}"></script>

    <!-- Template Ajax Jquery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>

    <!-- Jquery Minified -->
    <script src="https://code.jquery.com/jquery-3.6.1.min.js"
        integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>

    <script src="{{ asset('backend/js/show-hide-password.js') }}"></script>

    <!-- Page Script -->
    @yield('script')
    @livewireScripts
</body>

</html>
