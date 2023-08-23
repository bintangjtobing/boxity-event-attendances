<div class="container-fluid">
    <div class="social-dash-wrap">
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
                        </div>
                        <div class="action-btn">
                            <a href="" class="btn btn-sm btn-primary btn-add">
                                <i class="la la-plus"></i> Add New</a>
                        </div> --}}
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <p class="color-dark fw-500 fs-20 mb-3">{{ ucfirst(Helper::getCurrentUrlAdmin()) }} Data</p>
                        <div class="Vertical-form">
                            <form id="formAuth" class="w-100">
                                @csrf
                                <div class="d-flex align-items-center flex-container mb-3">
                                    <div class="flex-grow-1">
                                        <div class="row mt-auto">
                                            <div class="col-md-3 filter">
                                                <div class="atbd-select">
                                                    <select name="role" id="select-search" class="form-control"
                                                        onchange="getData()">
                                                        @foreach ($role as $r)
                                                            <option value="{{ $r->id }}">{{ $r->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-2 mt-1">
                                                <button type="button" onclick="updateAuthorization()"
                                                    class="btn btn-primary ml-2">Update</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div id="data">
                                    @include('admin.authorization.data')
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    function getData() {
        let role = $('#select-search').find(':selected').val();
        $.ajax({
            url: `authorization/data/${role}`,
            method: 'GET',
            success: function(data) {
                $('#data').html(data);
            },
            error: function(error) {
                toastr['error']('Something Error');
            }
        })
    }

    function updateAuthorization() {
        let formData = $('#formAuth').serialize();
        $.ajax({
            url: `authorization`,
            method: 'POST',
            data: formData,
            success: function(data) {
                Swal.fire({
                    icon: 'success',
                    title: 'Success!',
                    text: 'Edit Successful',
                });
                getData();
                window.location.reload();
            },
            error: function(error) {
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: 'Change the data first!',
                    confirmButtonText: 'Close'
                }).then((value) => {
                    $(".submit").prop('disabled', false);
                });
            }
        })
    }

    $('#select-all').click(function(event) {
        if (this.checked) {
            // Iterate each checkbox
            $(':checkbox').each(function() {
                this.checked = true;
            });
        } else {
            $(':checkbox').each(function() {
                this.checked = false;
            });
        }
    });
</script>
