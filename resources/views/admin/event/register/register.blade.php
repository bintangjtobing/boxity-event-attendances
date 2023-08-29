<!doctype html>
<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Register Event | Boxity</title>
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
    <link rel="icon" type="image/png" sizes="16x16"
        href="https://res.cloudinary.com/boxity-id/image/upload/v1693136775/Logo_ABPPTSI_nfb8ns.png">
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
                    <img src="https://res.cloudinary.com/boxity-id/image/upload/v1693136775/Logo_ABPPTSI_nfb8ns.png"
                        width="130px" style="padding-top:30px; padding-bottom:30px;" alt="boxity">
                    <div class="user-member justify-content-center">
                        <small>Register your data to this event</small>
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
                            <form id="formRegister">
                                @csrf
                                <div class="row justify-content-center">
                                    <div class="col-md-6">
                                        <div class="row mt-2">
                                            <div class="col">
                                                <div class="form-group">
                                                    <label for="formGroupExampleInput"
                                                        class="color-dark fs-14 fw-500 align-center">Nama
                                                        Lengkap <small class="text-danger">*</small></label>
                                                    <input type="text"
                                                        class="form-control ih-medium ip-gray radius-xs b-light px-15"
                                                        id="formGroupExampleInput" name="name" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col">
                                                <div class="form-group">
                                                    <label for="formGroupExampleInput"
                                                        class="color-dark fs-14 fw-500 align-center">Email <small
                                                            class="text-danger">*</small></label>
                                                    <input type="email"
                                                        class="form-control ih-medium ip-gray radius-xs b-light px-15"
                                                        id="formGroupExampleInput" name="email" required>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="form-group">
                                                    <label for="formGroupExampleInput"
                                                        class="color-dark fs-14 fw-500 align-center">No. Hp / No. WA
                                                        aktif <small class="text-danger">*</small></label>
                                                    <input type="number" maxlength="15"
                                                        class="form-control ih-medium ip-gray radius-xs b-light px-15"
                                                        id="formGroupExampleInput" name="no_hp" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col">
                                                <div class="form-group">
                                                    <label for="formGroupExampleInput"
                                                        class="color-dark fs-14 fw-500 align-center">Instansi <small
                                                            class="text-danger">*</small></label>
                                                    <input type="text"
                                                        class="form-control ih-medium ip-gray radius-xs b-light px-15"
                                                        id="formGroupExampleInput" name="instansi" required>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="form-group">
                                                    <label for="formGroupExampleInput"
                                                        class="color-dark fs-14 fw-500 align-center">Jabatan <small
                                                            class="text-danger">*</small></label>
                                                    <input type="text"
                                                        class="form-control ih-medium ip-gray radius-xs b-light px-15"
                                                        id="formGroupExampleInput" name="jabatan" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col">
                                                <div class="form-group form-element-textarea">
                                                    <label for="exampleFormControlTextarea1"
                                                        class="il-gray fs-14 fw-500 align-center">Alamat
                                                        Instansi</label>
                                                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="alamat_instansi" required></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col">
                                                <div class="form-group">
                                                    <label for="formGroupExampleInput"
                                                        class="color-dark fs-14 fw-500 align-center">Penginapan <small
                                                            class="text-danger">*</small></label>
                                                    <input type="text"
                                                        class="form-control ih-medium ip-gray radius-xs b-light px-15"
                                                        id="formGroupExampleInput" name="penginapan" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col">
                                                <div class="form-group">
                                                    <label for="formGroupExampleInput"
                                                        class="color-dark fs-14 fw-500 align-center">Ukuran
                                                        Baju <small class="text-danger">*</small></label>
                                                    <div class="atbd-select">
                                                        <select name="size" id="select-search"
                                                            class="form-control">
                                                            @foreach (Helper::getSizes() as $key => $value)
                                                                <option value="{{ $key }}">
                                                                    {{ $value }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
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
                            <p>Copyright &copy; {{ $y }} All Rights Reserved by <a
                                    href="#">{{ ucfirst($event->name) }}</a>
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

        $('#formRegister').on('submit', function(event) {
            event.preventDefault();
            var registerForm = $('#formRegister');
            var loader = $('.loader-overlay');
            var event_name = "{{ Helper::strReplace($event->name, ' ', '-') }}";
            $.ajax({
                url: `{{ url('/register/${event_name}') }}`,
                type: "POST",
                data: registerForm.serialize(),
                dataType: "json",
                beforeSend: function() {
                    loader.show();
                    registerForm.find('button[type="submit"]').prop('disabled', true);
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
                    registerForm.find('button[type="submit"]').prop('disabled', false);
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
