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
                    <div class="dropdown action-btn">
                        <a href="#" class="btn btn-sm btn-default btn-white" onclick="sendCertificateAll()"
                            type="button">
                            <img src="{{ asset('icons/send.svg') }}" width="16" alt=""> Send Certificate to
                            All Participant
                        </a>
                    </div>
                    <div class="action-btn">
                        {{-- <a href="{{ route('certificate_add_view') }}" class="btn btn-sm btn-primary btn-add">
                            <i class="la la-plus"></i> Add New</a> --}}
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
                    <form id="formFilter">
                        <div id="filter-form-container">
                            <div class="form-group footable-filtering-search"><label class="sr-only">Search</label>
                                <div class="input-group"><input type="text" class="form-control" placeholder="Search"
                                        name="search" onkeyup="searchData()">
                                    <div class="input-group-btn"><button type="button" class="btn btn-primary"><span
                                                class="fooicon fooicon-search"></span></button><button type="button"
                                            class="btn btn-default dropdown-toggle"><span
                                                class="caret"></span></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
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
                                            <span class="userDatatable-title">Participant Name</span>
                                        </th>
                                        <th>
                                            <span class="userDatatable-title">Event Name</span>
                                        </th>
                                        <th>
                                            <span class="userDatatable-title">Status</span>
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
            url: `certificate/data?page=` + page,
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
            url: `certificate/data`,
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

    function sendCertificate(participant_id) {
        var participant_id = participant_id;
        var CSRF_TOKEN = $('meta[name="_token"]').attr('content');
        $.ajax({
            url: `certificate/send-certificate/` + participant_id,
            method: 'POST',
            data: {
                _token: CSRF_TOKEN,
                participant_id: participant_id
            },
            beforeSend: function(e) {
                $('#overlay').css("display", "block");
            },
            success: function(data) {
                $('#overlay').css("display", "none");
                if (data.status == true) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Success!',
                        text: data.message,
                        confirmButtonText: 'Close'
                    });
                    searchData();
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        text: data.message,
                        confirmButtonText: 'Close'
                    });
                }
            },
            error: function(error) {
                $('#overlay').css("display", "none");
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: 'Something went wrong',
                    confirmButtonText: 'Close'
                });
            }
        });
    }

    function sendCertificateAll() {
        var CSRF_TOKEN = $('meta[name="_token"]').attr('content');
        $.ajax({
            url: `{{ route('certificate_view_send-to-all') }}`,
            method: 'POST',
            data: {
                _token: CSRF_TOKEN
            },
            beforeSend: function(e) {
                $('#overlay').css("display", "block");
            },
            success: function(data) {
                $('#overlay').css("display", "none");
                if (data.status == true) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Success!',
                        text: data.message,
                        confirmButtonText: 'Close'
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        text: data.message,
                        confirmButtonText: 'Close'
                    });
                }
            },
            error: function(error) {
                $('#overlay').css("display", "none");
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: 'Something went wrong',
                    confirmButtonText: 'Close'
                });
            }
        });
    }
</script>
