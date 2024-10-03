@extends('frontend/layout')

@section('title')
    Members
@endsection

@section('custom_link_css')
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('/assets/frontend/css/bootstrap.min.css') }}">
    <!-- Nice Select CSS -->
    <link rel="stylesheet" href="{{ asset('/assets/frontend/css/nice-select.css') }}">
    <!-- Font Awesome CSS -->
    <link rel="stylesheet" href="{{ asset('/assets/frontend/css/font-awesome.min.css') }}">
    <!-- icofont CSS -->
    <link rel="stylesheet" href="{{ asset('/assets/frontend/css/icofont.css') }}">
    <!-- Slicknav -->
    <link rel="stylesheet" href="{{ asset('/assets/frontend/css/slicknav.min.css') }}">
    <!-- Owl Carousel CSS -->
    <link rel="stylesheet" href="{{ asset('/assets/frontend/css/owl-carousel.css') }}">
    <!-- Datepicker CSS -->
    <link rel="stylesheet" href="{{ asset('/assets/frontend/css/datepicker.css') }}">
    <!-- Animate CSS -->
    <link rel="stylesheet" href="{{ asset('/assets/frontend/css/animate.min.css') }}">
    <!-- Magnific Popup CSS -->
    <link rel="stylesheet" href="{{ asset('/assets/frontend/css/magnific-popup.css') }}">
    <!-- Medipro CSS -->
    <link rel="stylesheet" href="{{ asset('/assets/frontend/css/normalize.css') }}">
    <link rel="stylesheet" href="{{ asset('/assets/frontend/style.css') }}">
    <link rel="stylesheet" href="{{ asset('/assets/frontend/css/responsive.css') }}">
@endsection

<style>
    .label {
        display: inline-block;
        width: 100px; /* Sesuaikan lebar sesuai kebutuhan */
    }
</style>

@section('custom_content')
    <div class="breadcrumbs overlay">
        <div class="container">
            <div class="bread-inner">
                <div class="row">
                    <div class="col-12">
                        <h2>List Of Members</h2>
                        <ul class="bread-list">
                            <li><a href="{{ route('home.index') }}">Home</a></li>
                            <li><i class="icofont-simple-right"></i></li>
                            <li class="active">List Of Members</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <section class="pf-details section">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="inner-content">
                        <div class="body-text">
                            <h3>Anggota Alfakes Indonesia</h3>
                            <p>Terdiri dari beberapa Perusahaan Laboratorium Pengujian, Kalibrasi, Pemeliharaan dan
                                Perbaikan Fasilitas Kesehatan di Indonesia yang mempunyai standar sertifikasi KAN, antara
                                lain yaitu :</p>
                        </div>
                    </div>
                    <br>
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <input type="text" id="nameFilter" class="form-control" placeholder="Filter by Name">
                        </div>
                        <div class="col-md-4">
                            <input type="text" id="addressFilter" class="form-control" placeholder="Filter by Address">
                        </div>
                        <div class="col-md-4">
                            <input type="text" id="regionFilter" class="form-control" placeholder="Filter by Region">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <select id="sortSelect" class="form-control">
                                <option value="">Sort By Name</option>
                                <option value="asc">A-Z</option>
                                <option value="desc">Z-A</option>
                            </select>
                        </div>
                    </div>
                    <div class="row" id="membersList">
                        @foreach ($datas as $data)
                            <div class="col-md-4 mb-4 member-card">
                                <div class="card h-100">
                                    <div class="card-body">
                                        <div class="mb-3 text-center">
                                            @php
                                                $dir_path = '/assets/img/logo/';
                                                $image_path = !empty($data->logo)
                                                    ? public_path() . $dir_path . $data->logo
                                                    : asset('/assets/img/no_image.png');
                                                $image_url = file_exists($image_path)
                                                    ? asset($dir_path . $data->logo)
                                                    : asset('/assets/img/no_image.png');
                                            @endphp
                                            <a href="{{ route('member.index', ['id' => $data->id]) }}">
                                                <img src="{{ $image_url }}" class="rounded" style="width: 200px; height: 200px; display: block; margin: 0 auto;">
                                            </a>
                                        </div>
                                        <ul class="list-group list-group-flush">
                                            <?php
                                            $description = $data->description;
                                            $dom = new DOMDocument();
                                            libxml_use_internal_errors(true);
                                            $dom->loadHTML($description);
                                            libxml_clear_errors();
                                            
                                            $tables = $dom->getElementsByTagName('table');
                                            $alamat = '';
                                            $wilayah = '';
                                            
                                            if ($tables->length > 0) {
                                                $rows = $tables->item(0)->getElementsByTagName('tr');
                                                foreach ($rows as $row) {
                                                    $cols = $row->getElementsByTagName('td');
                                                    if ($cols->length > 1) {
                                                        if (strpos($cols->item(0)->nodeValue, 'Alamat Perusahaan') !== false) {
                                                            $alamat = $cols->item(1)->nodeValue;
                                                        }
                                                        if (strpos($cols->item(0)->nodeValue, 'Wilayah') !== false) {
                                                            $wilayah = $cols->item(1)->nodeValue;
                                                        }
                                                    }
                                                }
                                            }
                                            ?>
                                            <li class="list-group-item">
                                                <strong>Nama</strong><span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</span> {{ $data->name }}
                                            </li>
                                            <li class="list-group-item">
                                                <strong>Alamat</strong><span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</span> {{ $alamat }}
                                            </li>
                                            <li class="list-group-item">
                                                <strong>Wilayah</strong><span>&nbsp;&nbsp;&nbsp;:</span> {{ $wilayah }}
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <!-- Pagination Controls -->
                    {{-- <div class="row">
                        <div class="col-12 text-center">
                            <button id="prevPage" class="btn btn-primary">Previous</button>
                            <span id="pageInfo"></span>
                            <button id="nextPage" class="btn btn-primary">Next</button>
                        </div>
                    </div> --}}
                </div>
            </div>
        </div>
    </section>
@endsection

@section('custom_link_js')
@section('custom_link_js')
<script src="{{ asset('/assets/frontend/js/jquery.min.js') }}"></script>
<script src="{{ asset('/assets/frontend/js/jquery-migrate-3.0.0.js') }}"></script>
<script src="{{ asset('/assets/frontend/js/jquery-ui.min.js') }}"></script>
<script src="{{ asset('/assets/frontend/js/easing.js') }}"></script>
<script src="{{ asset('/assets/frontend/js/colors.js') }}"></script>
<script src="{{ asset('/assets/frontend/js/popper.min.js') }}"></script>
<script src="{{ asset('/assets/frontend/js/bootstrap-datepicker.js') }}"></script>
<script src="{{ asset('/assets/frontend/js/jquery.nav.js') }}"></script>
<script src="{{ asset('/assets/frontend/js/slicknav.min.js') }}"></script>
<script src="{{ asset('/assets/frontend/js/jquery.scrollUp.min.js') }}"></script>
<script src="{{ asset('/assets/frontend/js/niceselect.js') }}"></script>
<script src="{{ asset('/assets/frontend/js/tilt.jquery.min.js') }}"></script>
<script src="{{ asset('/assets/frontend/js/owl-carousel.js') }}"></script>
<script src="{{ asset('/assets/frontend/js/jquery.counterup.min.js') }}"></script>
<script src="{{ asset('/assets/frontend/js/steller.js') }}"></script>
<script src="{{ asset('/assets/frontend/js/wow.min.js') }}"></script>
<script src="{{ asset('/assets/frontend/js/jquery.magnific-popup.min.js') }}"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/waypoints/2.0.3/waypoints.min.js"></script>
<script src="{{ asset('/assets/frontend/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('/assets/frontend/js/main.js') }}"></script>
<script src="//cdn.datatables.net/2.0.0/js/dataTables.min.js"></script>

<script>
    $(document).ready(function() {
        // Initialize DataTable
        let table = $('#table').DataTable({
            "paging": true,
            "lengthChange": true,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
        });

        // Filter functionality
        function filterMembers() {
            let nameFilter = $('#nameFilter').val().toLowerCase();
            let addressFilter = $('#addressFilter').val().toLowerCase();
            let regionFilter = $('#regionFilter').val().toLowerCase();
            let cards = $('.member-card');

            cards.each(function() {
                let name = $(this).find('li').eq(0).text().toLowerCase();
                let address = $(this).find('li').eq(1).text().toLowerCase();
                let region = $(this).find('li').eq(2).text().toLowerCase();

                if (name.includes(nameFilter) && address.includes(addressFilter) && region.includes(regionFilter)) {
                    $(this).show();
                } else {
                    $(this).hide();
                }
            });
        }

        $('#nameFilter, #addressFilter, #regionFilter').on('keyup', filterMembers);

        $('#sortSelect').on('change', function() {
            let sortOrder = $(this).val();
            let sortedCards = $('.member-card').sort(function(a, b) {
                let nameA = $(a).find('li').eq(0).text();
                let nameB = $(b).find('li').eq(0).text();

                return sortOrder === 'asc' ? nameA.localeCompare(nameB) : nameB.localeCompare(nameA);
            });

            $('#membersList').html(sortedCards);
        });
    });
</script>
    {{-- <script>
        $(document).ready(function() {
            const membersPerPage = 9; // Jumlah anggota per halaman
            let currentPage = 1;
            const members = $('.member-card');
            const totalMembers = members.length;
            const totalPages = Math.ceil(totalMembers / membersPerPage);

            function showPage(page) {
                members.hide(); // Sembunyikan semua anggota
                const start = (page - 1) * membersPerPage;
                const end = start + membersPerPage;
                members.slice(start, end).show(); // Tampilkan anggota untuk halaman saat ini
                $('#pageInfo').text(`Page ${page} of ${totalPages}`);
            }

            $('#prevPage').click(function() {
                if (currentPage > 1) {
                    currentPage--;
                    showPage(currentPage);
                }
            });

            $('#nextPage').click(function() {
                if (currentPage < totalPages) {
                    currentPage++;
                    showPage(currentPage);
                }
            });

            // Tampilkan halaman pertama
            showPage(currentPage);
        });
    </script> --}}
@endsection
