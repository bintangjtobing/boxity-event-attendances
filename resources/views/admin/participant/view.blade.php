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
                        <a href="javascript:void(0)" class="btn btn-lg btn-white btn-upload"
                            onclick="window.location.href = '{{ route('participant_view_template') }}'">
                            <i class="la la-download"></i> Click to Download Template
                        </a>
                    </div>
                    <div class="dropdown action-btn">
                        <a href="" class="btn btn-sm btn-default btn-white" data-toggle="modal"
                            data-target="#modal-import-participant" type="button">
                            <i class="la la-file-import"></i> Import
                        </a>
                    </div>
                    <div class="action-btn">
                        <a href="{{ route('participant_add_view') }}" class="btn btn-sm btn-primary btn-add">
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
                <div id="filter-form-container"></div>
                <div class="card-body p-0">
                    <div class="table4  p-25 bg-white mb-30">
                        <div class="table-responsive">
                            <table class="table mb-0 table-borderless adv-table" data-sorting="true"
                                data-filter-container="#filter-form-container" data-paging-current="1"
                                data-paging-position="right" data-paging-size="10">
                                <thead>
                                    <tr class="userDatatable-header">
                                        <th>
                                            <span class="userDatatable-title">ID Participant</span>
                                        </th>
                                        <th>
                                            <span class="userDatatable-title">Participant Name</span>
                                        </th>
                                        <th>
                                            <span class="userDatatable-title">Jabatan</span>
                                        </th>
                                        <th>
                                            <span class="userDatatable-title">Instansi</span>
                                        </th>
                                        {{-- <th>
                                            <span class="userDatatable-title float-right">Action</span>
                                        </th> --}}
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
@include('admin.participant.modal.import')
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
            url: `participant/data?page=` + page,
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
            url: `participant/data`,
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
        var url = `participant/delete`;
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

    function importParticipant() {
        let formData = new FormData($('#formImport')[0]);
        if ($('#upload-1').val() == '') {
            Swal.fire({
                timer: 2000,
                icon: 'error',
                text: 'Please upload file first',
                showConfirmButton: false,
                timer: 1500
            })
            return false;
        }
        if ($('.event_id').val() == '') {
            Swal.fire({
                timer: 2000,
                icon: 'error',
                text: 'Please select event first',
                showConfirmButton: false,
                timer: 1500
            })
            return false;
        }
        $.ajax({
            url: `participant/import`,
            method: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            beforeSend: function(e) {
                $('#overlay').css("display", "block");
            },
            success: function(data) {
                $('#overlay').css("display", "none");
                if (data.status == true) {
                    $('#modal-import-participant').modal('hide');
                    searchData();
                    Swal.fire(
                        'Success!',
                        data.message,
                        'success'
                    )
                } else {
                    Swal.fire({
                        timer: 2000,
                        icon: 'error',
                        text: data.message,
                        showConfirmButton: false,
                        timer: 1500
                    })
                    return false;
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
