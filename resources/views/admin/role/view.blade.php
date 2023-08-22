<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="breadcrumb-main">
                <h4 class="text-capitalize breadcrumb-title">
                    <ul class="atbd-breadcrumb nav">
                        <li class="atbd-breadcrumb__item">
                            <a href="{{ route('dashboard_view_admin') }}">
                                <span class="la la-home"></span>
                            </a>
                            <span class="breadcrumb__seperator">
                                <span class="la la-slash"></span>
                            </span>
                        </li>
                        <li class="atbd-breadcrumb__item">
                            <span>{{ Helper::getCurrentUrlAdmin() }}</span>
                        </li>
                    </ul>
                </h4>
                <div class="breadcrumb-action justify-content-center flex-wrap">
                    {{-- <div class="action-btn">
                        <div class="form-group mb-0">
                            <div class="input-container icon-left position-relative">
                                <span class="input-icon icon-left">
                                    <span data-feather="calendar"></span>
                                </span>
                                <input type="text" class="form-control form-control-default date-ranger"
                                    name="date-ranger" placeholder="Oct 30, 2019 - Nov 30, 2019">
                                <span class="input-icon icon-right">
                                    <span data-feather="chevron-down"></span>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="dropdown action-btn">
                        <button class="btn btn-sm btn-default btn-white dropdown-toggle" type="button"
                            id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="la la-download"></i> Export
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
                            <span class="dropdown-item">Export With</span>
                            <div class="dropdown-divider"></div>
                            <a href="" class="dropdown-item">
                                <i class="la la-print"></i> Printer</a>
                            <a href="" class="dropdown-item">
                                <i class="la la-file-pdf"></i> PDF</a>
                            <a href="" class="dropdown-item">
                                <i class="la la-file-text"></i> Google Sheets</a>
                            <a href="" class="dropdown-item">
                                <i class="la la-file-excel"></i> Excel (XLSX)</a>
                            <a href="" class="dropdown-item">
                                <i class="la la-file-csv"></i> CSV</a>
                        </div>
                    </div>
                    <div class="dropdown action-btn">
                        <button class="btn btn-sm btn-default btn-white dropdown-toggle" type="button"
                            id="dropdownMenu3" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="la la-share"></i> Share
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenu3">
                            <span class="dropdown-item">Share Link</span>
                            <div class="dropdown-divider"></div>
                            <a href="" class="dropdown-item">
                                <i class="la la-facebook"></i> Facebook</a>
                            <a href="" class="dropdown-item">
                                <i class="la la-twitter"></i> Twitter</a>
                            <a href="" class="dropdown-item">
                                <i class="la la-google"></i> Google</a>
                            <a href="" class="dropdown-item">
                                <i class="la la-feed"></i> Feed</a>
                            <a href="" class="dropdown-item">
                                <i class="la la-instagram"></i> Instagram</a>
                        </div>
                    </div> --}}
                    <div class="action-btn">
                        <a href="{{ route('role_add_view') }}" class="btn btn-sm btn-primary btn-add">
                            <i class="la la-plus"></i> Add New</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header color-dark fw-500">
                    {{ Helper::getCurrentUrlAdmin() }} Data
                </div>
                <div class="card-body p-0">
                    <div class="table4  p-25 bg-white mb-30">
                        <div class="table-responsive">
                            <table class="table mb-0">
                                <thead>
                                    <tr class="userDatatable-header">
                                        <th>
                                            <span class="userDatatable-title">No</span>
                                        </th>
                                        <th>
                                            <span class="userDatatable-title">Name</span>
                                        </th>
                                        <th>
                                            <span class="userDatatable-title float-right">Action</span>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody id="data">

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        searchData();
        $(document).on('click', '.pagination a', function(event) {
            event.preventDefault();
            var page = $(this).attr('href').split('page=')[1];
            getData(page);
        })
    });

    function getData(page) {
        let formData = $('#formFilter').serialize();

        $.ajax({
            url: `role/data?page=` + page,
            method: 'GET',
            data: formData,
            beforeSend: function(e) {
                $('#overlay').css("display", "block");
            },
            success: function(data) {
                $('#overlay').css("display", "none");
                $('#data').html(data);
            },
            error: function(error) {
                $('#overlay').css("display", "none");
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: 'Something went wrong',
                    confirmButtonText: 'Close'
                })
            }
        })
    }

    function searchData() {
        let formData = $('#formFilter').serialize();

        $.ajax({
            url: `role/data`,
            method: 'GET',
            data: formData,
            beforeSend: function(e) {
                $('#overlay').css("display", "block");
            },
            success: function(data) {
                $('#overlay').css("display", "none");
                $('#data').html(data)
            },
            error: function(error) {
                $('#overlay').css("display", "none");
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: 'Something went wrong',
                    confirmButtonText: 'Close'
                })
            }
        })
    }

    function deleteData(id) {
        var url = `role/delete`;
        Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            })
            .then((result) => {
                if (result.isConfirmed) {
                    var CSRF_TOKEN = $('meta[name="_token"]').attr('content');
                    $.ajax({
                        url: `${url}/${id}`,
                        method: 'DELETE',
                        data: {
                            _token: CSRF_TOKEN
                        },
                        beforeSend: function(e) {
                            $('#overlay').css("display", "block");
                        },
                        success: function(res, data) {
                            $('#overlay').css("display", "none");
                            if (res.status == true) {
                                Swal.fire(
                                    'Deleted!',
                                    'Your data has been deleted.',
                                    'success'
                                )
                                searchData();
                            } else {
                                console.log(res);
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Error!',
                                    text: res.error,
                                    confirmButtonText: 'Close'
                                })
                            }
                        },
                        error: function(error) {
                            $('#overlay').css("display", "none");
                            Swal.fire({
                                icon: 'error',
                                title: 'Error!',
                                text: 'Something went wrong',
                                confirmButtonText: 'Close'
                            })
                        }
                    })
                }
            });
    }
</script>
