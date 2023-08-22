<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Register for Event</title>
    <!-- Mobile Specific Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <!-- Font-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/register_event/css/roboto-font.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('assets/register_event/fonts/font-awesome-5/css/fontawesome-all.min.css') }}">
    <!-- Main Style Css -->
    <link rel="stylesheet" href="{{ asset('assets/register_event/css/style.css') }}" />
    <!-- Toasttr -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <!-- Sweet Alert -->
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</head>

<body class="form-v5">
    <div class="page-content">
        <div class="form-v5-content">
            <form class="form-detail" id="formEvent">
                @csrf
                <h2>Form Pendaftaran {{ $event->title }}</h2>
                <p>Tanggal Event : {{ \Carbon\Carbon::parse($event->date)->isoFormat('D MMMM Y') }}</p>
                <p>Lokasi Event : {{ $event->location }}</p>
                <div class="form-row">
                    <label for="full-name">Full Name</label>
                    <input type="text" name="name" id="full-name" class="input-text" placeholder="Your Name"
                        required>
                    <i class="fas fa-user"></i>
                </div>
                <div class="form-row">
                    <label for="your-email">Your Email</label>
                    <input type="text" name="email" id="your-email" class="input-text" placeholder="Your Email"
                        required pattern="[^@]+@[^@]+.[a-zA-Z]{2,6}">
                    <i class="fas fa-envelope"></i>
                </div>
                <div class="form-row">
                    <label for="your-phone">Your Phone</label>
                    <input type="text" name="phone" id="your-phone" class="input-text" placeholder="Your Phone"
                        required>
                    <i class="fas fa-phone"></i>
                </div>
                <div class="text-center" id="loadingIndicator" style="display: none;">
                    <center>
                        <i class="fa fa-spinner fa-spin"></i> Loading...
                    </center>
                </div>
                <div class="form-row-last">
                    <input type="submit" name="register" class="register" id="registerButtton" value="Register">
                </div>
            </form>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>
        $('#formEvent').submit(function(e) {
            e.preventDefault();
            $.ajax({
                url: "{{ route('event_processRegistration', ['token' => $event->token]) }}",
                type: "POST",
                data: $('#formEvent').serialize(),
                beforeSend: function() {
                    $('#registerButtton').hide();
                    $('#loadingIndicator').show();
                },
                complete: function() {
                    $('#loadingIndicator').hide();
                },
                success: function(res) {
                    if (res.status == true) {
                        swal({
                            title: "Registration Success",
                            text: "QR-Code has been sent to your email, please check your email",
                            icon: "success",
                            button: "Ok!",
                        }).then((value) => {
                            clearInputVal();
                            $('#registerButtton').show();
                        });
                    } else {
                        toastr.error(res.error);
                        $('#registerButtton').show();
                    }
                },
                error: function(res) {
                    $('#registerButtton').show();
                    var errors = res.responseJSON;
                    if ($.isEmptyObject(errors) == false) {
                        $.each(errors.errors, function(key, value) {
                            toastr.error(value);
                        })
                    }
                }
            });
            return false;
        });

        function clearInputVal() {
            $('#full-name').val('');
            $('#your-email').val('');
            $('#your-phone').val('');
        }
    </script>
</body>

</html>
