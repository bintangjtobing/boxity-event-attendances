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
                                <a
                                    href="{{ route(Helper::getCurrentRouteAdmin()) }}">{{ Helper::getCurrentUrlAdmin() }}</a>
                                <span class="breadcrumb__seperator">
                                    <span class="la la-slash"></span>
                                </span>
                            </li>
                            <li class="atbd-breadcrumb__item">
                                <span>Add</span>
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
                        <p class="color-dark fw-500 fs-20 mb-3">Detail {{ ucfirst(Helper::getCurrentUrlAdmin()) }}</p>
                        <div class="Vertical-form">
                            <form id="formAdd">
                                @csrf
                                <div class="form-group">
                                    <label for="formGroupExampleInput"
                                        class="color-dark fs-14 fw-500 align-center">Event</label>
                                    <div class="atbd-select ">
                                        <select name="event_id" id="select-search" class="form-control">
                                            @foreach ($events as $item)
                                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="formGroupExampleInput" class="color-dark fs-14 fw-500 align-center">Name
                                        <small class="text-danger">*</small></label>
                                    <input type="text" class="form-control ih-medium ip-gray radius-xs b-light px-15"
                                        id="formGroupExampleInput" name="name">
                                </div>
                                <div class="form-group">
                                    <label for="formGroupExampleInput"
                                        class="color-dark fs-14 fw-500 align-center">Email <small
                                            class="text-danger">*</small></label>
                                    <input type="email" class="form-control ih-medium ip-gray radius-xs b-light px-15"
                                        id="formGroupExampleInput" name="email">
                                </div>
                                <div class="form-group">
                                    <label for="formGroupExampleInput"
                                        class="color-dark fs-14 fw-500 align-center">Jabatan</label>
                                    <input type="text" class="form-control ih-medium ip-gray radius-xs b-light px-15"
                                        id="formGroupExampleInput" name="jabatan">
                                </div>
                                <div class="form-group">
                                    <label for="formGroupExampleInput" class="color-dark fs-14 fw-500 align-center">No
                                        Hp <small class="text-danger">*</small></label>
                                    <input type="number" maxlength="15"
                                        class="form-control ih-medium ip-gray radius-xs b-light px-15"
                                        id="formGroupExampleInput" name="no_hp">
                                </div>
                                <div class="form-group">
                                    <label for="formGroupExampleInput"
                                        class="color-dark fs-14 fw-500 align-center">Instansi</label>
                                    <input type="text" class="form-control ih-medium ip-gray radius-xs b-light px-15"
                                        id="formGroupExampleInput" name="instansi">
                                </div>
                                <div class="form-group form-element-textarea">
                                    <label for="exampleFormControlTextarea1"
                                        class="il-gray fs-14 fw-500 align-center">Alamat Instansi</label>
                                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="alamat_instansi"></textarea>
                                </div>
                                <div class="row">
                                    <div class="col-md">
                                        <label for="event_date" class="il-gray fs-14 fw-500 align-center">Tanggal
                                            Kedatangan & Tanggal Kembali</label>
                                        <div class="atbd-date-ranger position-relative d-flex align-items-center">
                                            <div class="form-group mb-0">
                                                <input type="text" name="date-range-from"
                                                    class="form-control form-control-default" id="tanggal_kedatangan"
                                                    placeholder="Tanggal Kedatangan">
                                            </div>
                                            <span class="divider">-</span>
                                            <div class="form-group mb-0">
                                                <input type="text" name="date-range-to"
                                                    class="form-control form-control-default" id="tanggal_kembali"
                                                    placeholder="Tanggal Kembali">
                                            </div>
                                            <a class="date-picker-icon" href="#"><span
                                                    data-feather="calendar"></span></a>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="formGroupExampleInput"
                                        class="color-dark fs-14 fw-500 align-center">Penginapan</label>
                                    <input type="text"
                                        class="form-control ih-medium ip-gray radius-xs b-light px-15"
                                        id="formGroupExampleInput" name="penginapan">
                                </div>
                                <div class="form-group">
                                    <label for="formGroupExampleInput"
                                        class="color-dark fs-14 fw-500 align-center">Ukuran
                                        Baju <small class="text-danger">*</small></label>
                                    <div class="atbd-select">
                                        <select name="size" id="select-search" class="form-control">
                                            @foreach (Helper::getSizes() as $key => $value)
                                                <option value="{{ $key }}">
                                                    {{ $value }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                        </div>
                        <div class="layout-button mt-25">
                            <button type="button" class="btn btn-default btn-squared border-normal bg-normal px-20"
                                onclick="window.location.href='{{ route('participant_view_index') }}';">back</button>
                            <button type="submit"
                                class="btn btn-primary btn-default btn-squared px-30 submit">save</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<script>
    $('#formAdd').submit(function(e) {
        $(".submit").prop('disabled', true);
        e.preventDefault();
        $('.is-invalid').each(function() {
            $('.is-invalid').removeClass('is-invalid');
        });
        $.ajax({
            url: "{{ route('participant_add_post') }}",
            type: "POST",
            data: $('#formAdd').serialize(),
            success: function(res) {
                if (res.status == true) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Success!',
                        text: 'Add Successful',
                    })
                    setTimeout(function() {
                        window.location.href = "{{ route('participant_view_index') }}";
                    }, 2000);
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        text: res.error,
                        confirmButtonText: 'Close'
                    }).then((value) => {
                        $(".submit").prop('disabled', false);
                    });
                }
            },
            error: function(res) {
                $(".submit").prop('disabled', false);
                if (res.status != 422)
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        text: 'Something went wrong',
                        confirmButtonText: 'Close'
                    })
                showError(res.responseJSON.errors, "#formAdd");
                $.each(res.responseJSON.errors, function(idx, item) {
                    toastr.error(idx = item);
                });
            }
        });
        return false;
    })
</script>
