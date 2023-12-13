<!doctype html>
<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Attendance Event | Boxity</title>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <!-- inject:css-->
    <link rel="stylesheet" href="{{ asset('assets/vendor_assets/css/bootstrap/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor_assets/css/daterangepicker.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor_assets/css/fontawesome.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor_assets/css/footable.standalone.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor_assets/css/fullcalendar@5.2.0.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor_assets/css/jquery-jvectormap-2.0.5.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor_assets/css/jquery.mCustomScrollbar.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor_assets/css/leaflet.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor_assets/css/line-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor_assets/css/magnific-popup.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor_assets/css/MarkerCluster.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor_assets/css/MarkerCluster.Default.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor_assets/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor_assets/css/slick.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor_assets/css/star-rating-svg.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor_assets/css/trumbowyg.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor_assets/css/wickedpicker.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <!-- endinject -->
    {{-- <link rel="icon" type="image/png" sizes="16x16"
        href="https://res.cloudinary.com/boxity-id/image/upload/v1693136775/Logo_ABPPTSI_nfb8ns.png"> --}}
    <link rel="icon" type="image/png" sizes="16x16"
        href="{{ asset('brand/App icon - primary orange color.png') }}">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</head>

<body class="layout-light side-menu overlayScroll">
    <div class="mobile-search">
        <form class="search-form">
            <span data-feather="search"></span>
            <input class="form-control mr-sm-2 box-shadow-none" type="text" placeholder="Search...">
        </form>
    </div>
    <div class="mobile-author-actions"></div>
    <main class="main-content">
        <div class="container-fluid">
            <div class="row mb-3">
                <div class="col-lg-12 text-center">
                    {{-- <img src="https://res.cloudinary.com/boxity-id/image/upload/v1693136775/Logo_ABPPTSI_nfb8ns.png"
                        width="130px" style="padding-top:30px; padding-bottom:30px;" alt="boxity"> --}}
                    <img src="{{ asset('brand/logo primary.png') }}" width="230px"
                        style="padding-top:30px; padding-bottom:30px;" alt="boxity">
                    <div class="user-member justify-content-center">
                        <small>Fill your data for attendance this event</small>
                        <h4 class="text-capitalize fw-500 breadcrumb-title" style="font-weight: bold;">
                            {{ ucfirst($event->name) }}
                        </h4>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-lg-7 mb-30">
                    <div class="card position-relative user-member-card">
                        <div class="card-body text-center p-30">
                            <div class="row">
                                <div class="col" style="max-height: 300px; overflow: hidden;">
                                    <img src="{{ $event->cover_path }}" alt="event cover"
                                        style="width: 100%; height: 100%; object-fit: cover;">
                                </div>
                            </div>
                            <form id="formAttendance">
                                @csrf
                                <div class="row justify-content-center">
                                    <div class="col-md-6">
                                        <div class="row mt-2">
                                            <div class="col">
                                                <div class="form-group text-left">
                                                    <label for="deskripsi"
                                                        class="color-dark fs-14 fw-500 align-center">Deskripsi
                                                        Event</label>
                                                    <p>{{ $event->description }}</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col">
                                                <div class="form-group">
                                                    <label for="nama"
                                                        class="color-dark fs-14 fw-500 align-center">Nama
                                                        Lengkap <small class="text-danger">*</small></label>
                                                    <input type="text"
                                                        class="form-control ih-medium ip-gray radius-xs b-light px-15"
                                                        id="nama" name="name" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col">
                                                <div class="form-group">
                                                    <label for="email"
                                                        class="color-dark fs-14 fw-500 align-center">Email <small
                                                            class="text-danger">*</small></label>
                                                    <input type="email"
                                                        class="form-control ih-medium ip-gray radius-xs b-light px-15"
                                                        id="email" name="email" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col">
                                                <div class="form-group">
                                                    <label for="no_hp"
                                                        class="color-dark fs-14 fw-500 align-center">No. Hp / No. WA
                                                        aktif <small class="text-danger">*</small></label>
                                                    <input type="number" maxlength="15"
                                                        class="form-control ih-medium ip-gray radius-xs b-light px-15"
                                                        id="no_hp" name="no_hp" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col">
                                                <div class="form-group">
                                                    <label for="Instansi"
                                                        class="color-dark fs-14 fw-500 align-center">Instansi </label>
                                                    <input type="text"
                                                        class="form-control ih-medium ip-gray radius-xs b-light px-15"
                                                        id="Instansi" name="instansi">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col">
                                                <div class="form-group">
                                                    <label for="jabatan"
                                                        class="color-dark fs-14 fw-500 align-center">Jabatan </label>
                                                    <input type="text"
                                                        class="form-control ih-medium ip-gray radius-xs b-light px-15"
                                                        id="jabatan" name="jabatan">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-check mb-3">
                                            <input class="form-check-input" type="checkbox" value="1"
                                                id="check">
                                            <label class="form-check-label" for="check">
                                                Saya benar menyatakan bahwa saya telah menghadiri seluruh
                                                rangkaian kegiatan ini
                                            </label>
                                        </div>
                                        <button type="submit" class="btn btn-warning w-100"
                                            style="background-color: #2a4594">Submit</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <footer class="footer">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md">
                        <div class="footer-copyright text-center">
                            <?php $y = date('Y'); ?>
                            <p>Copyright &copy; {{ $y }} All Rights Reserved by <a href="#">PT Boxity
                                    Central
                                    Indonesia</a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
    </main>
    <div id="overlayer">
        <span class="loader-overlay">
            <div class="atbd-spin-dots spin-lg">
                <span class="spin-dot badge-dot dot-primary"></span>
                <span class="spin-dot badge-dot dot-primary"></span>
                <span class="spin-dot badge-dot dot-primary"></span>
                <span class="spin-dot badge-dot dot-primary"></span>
            </div>
        </span>
    </div>
    <div class="overlay-dark-sidebar"></div>
    <!-- inject:js-->
    <script src="{{ asset('assets/vendor_assets/js/jquery/jquery-3.5.1.min.js') }}"></script>
    <script src="{{ asset('assets/vendor_assets/js/jquery/jquery-ui.js') }}"></script>
    <script src="{{ asset('assets/vendor_assets/js/bootstrap/popper.js') }}"></script>
    <script src="{{ asset('assets/vendor_assets/js/bootstrap/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/vendor_assets/js/moment/moment.min.js') }}"></script>
    <script src="{{ asset('assets/vendor_assets/js/accordion.js') }}"></script>
    <script src="{{ asset('assets/vendor_assets/js/autoComplete.js') }}"></script>
    <script src="{{ asset('assets/vendor_assets/js/Chart.min.js') }}"></script>
    <script src="{{ asset('assets/vendor_assets/js/charts.js') }}"></script>
    <script src="{{ asset('assets/vendor_assets/js/daterangepicker.js') }}"></script>
    <script src="{{ asset('assets/vendor_assets/js/drawer.js') }}"></script>
    <script src="{{ asset('assets/vendor_assets/js/dynamicBadge.js') }}"></script>
    <script src="{{ asset('assets/vendor_assets/js/dynamicCheckbox.js') }}"></script>
    <script src="{{ asset('assets/vendor_assets/js/feather.min.js') }}"></script>
    <script src="{{ asset('assets/vendor_assets/js/footable.min.js') }}"></script>
    <script src="{{ asset('assets/vendor_assets/js/fullcalendar@5.2.0.js') }}"></script>
    <script src="{{ asset('assets/vendor_assets/js/google-chart.js') }}"></script>
    <script src="{{ asset('assets/vendor_assets/js/jquery-jvectormap-2.0.5.min.js') }}"></script>
    <script src="{{ asset('assets/vendor_assets/js/jquery-jvectormap-world-mill-en.js') }}"></script>
    <script src="{{ asset('assets/vendor_assets/js/jquery.countdown.min.js') }}"></script>
    <script src="{{ asset('assets/vendor_assets/js/jquery.filterizr.min.js') }}"></script>
    <script src="{{ asset('assets/vendor_assets/js/jquery.magnific-popup.min.js') }}"></script>
    <script src="{{ asset('assets/vendor_assets/js/jquery.mCustomScrollbar.min.js') }}"></script>
    <script src="{{ asset('assets/vendor_assets/js/jquery.peity.min.js') }}"></script>
    <script src="{{ asset('assets/vendor_assets/js/jquery.star-rating-svg.min.js') }}"></script>
    <script src="{{ asset('assets/vendor_assets/js/leaflet.js') }}"></script>
    <script src="{{ asset('assets/vendor_assets/js/leaflet.markercluster.js') }}"></script>
    <script src="{{ asset('assets/vendor_assets/js/loader.js') }}"></script>
    <script src="{{ asset('assets/vendor_assets/js/message.js') }}"></script>
    <script src="{{ asset('assets/vendor_assets/js/moment.js') }}"></script>
    <script src="{{ asset('assets/vendor_assets/js/muuri.min.js') }}"></script>
    <script src="{{ asset('assets/vendor_assets/js/notification.js') }}"></script>
    <script src="{{ asset('assets/vendor_assets/js/popover.js') }}"></script>
    <script src="{{ asset('assets/vendor_assets/js/select2.full.min.js') }}"></script>
    <script src="{{ asset('assets/vendor_assets/js/slick.min.js') }}"></script>
    <script src="{{ asset('assets/vendor_assets/js/trumbowyg.min.js') }}"></script>
    <script src="{{ asset('assets/vendor_assets/js/wickedpicker.min.js') }}"></script>
    <script src="{{ asset('assets/theme_assets/js/drag-drop.js') }}"></script>
    <script src="{{ asset('assets/theme_assets/js/footable.js') }}"></script>
    <script src="{{ asset('assets/theme_assets/js/full-calendar.js') }}"></script>
    <script src="{{ asset('assets/theme_assets/js/googlemap-init.js') }}"></script>
    <script src="{{ asset('assets/theme_assets/js/icon-loader.js') }}"></script>
    <script src="{{ asset('assets/theme_assets/js/jvectormap-init.js') }}"></script>
    <script src="{{ asset('assets/theme_assets/js/leaflet-init.js') }}"></script>
    <script src="{{ asset('assets/theme_assets/js/main.js') }}"></script>
    <script script src="https://unpkg.com/html5-qrcode"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script type="text/javascript">
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        })

        $('#formAttendance').on('submit', function(event) {
            event.preventDefault();
            var attendanceForm = $('#formAttendance');
            var loader = $('.loader-overlay');
            var event_name = "{{ Helper::strReplace($event->name, ' ', '-') }}";
            var token = "{{ $event->token }}"
            $.ajax({
                url: `{{ url('/attendance/${event_name}/${token}') }}`,
                type: "POST",
                data: attendanceForm.serialize(),
                dataType: "json",
                beforeSend: function() {
                    loader.show();
                    attendanceForm.find('button[type="submit"]').prop('disabled', true);
                },
                complete: function() {
                    loader.hide();
                },
                success: function(res) {
                    if (res.status == true) {
                        Toast.fire({
                            icon: 'success',
                            title: res.message
                        });
                        setTimeout(function() {
                            window.location.reload();
                        }, 2000);
                    } else {
                        Toast.fire({
                            icon: 'error',
                            title: res.error
                        });
                    }
                },
                error: function(xhr, status, error) {
                    loader.hide();
                    attendanceForm.find('button[type="submit"]').prop('disabled', false);
                    Toast.fire({
                        icon: 'success',
                        title: 'Something Was Wrong'
                    });
                }
            });
            return false;
        })
    </script>
    <!-- endinject-->
</body>

</html>
