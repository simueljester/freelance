<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="icon" type="image/gif/png" href="{{ asset('system_info/').'/'.App\SystemInformation::whereActive(1)->first()->logo }}">
    
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">

    <title>TakeToQ Account Recovery</title>
</head>
<body class="bg-light">
    <form action="{{route('password-update')}}" method="POST">
        @csrf
        @method('POST')
        <div class="container text-center">
            <div class="row justify-content-center">
                <div class="col-md-8">
                 
                    <div class="card shadow-sm mt-3 float-center">
                        <div class="card-header">
                            <strong> Account Recovery </strong>
                        </div>
                        <div class="card-body">
                            <i class="fas fa-envelope-open-text fa-5x text-muted"></i>
                            <br><br>
                            <small class="text-muted mt1"> We have sent an <strong> One Time Password (OTP) </strong> to your account's indicated email address. Please check OTP then paste it here. </small>
                            <div class="form-group mt-5">
                                <small class="text-muted"> OTP (sent from your email) </small>
                                <input type="text" class="form-control" name="otp" id="otp" required>
                            </div>
                            <div class="form-group">
                                <small class="text-muted"> New Password </small>
                                <input type="password" class="form-control" name="password" id="password" required>
                            </div>
                            <div class="form-group">
                                <small class="text-muted"> Confirm Password </small>
                                <input type="password" name="confirm_password" class="form-control" id="confirm_password" required>
                            </div>
                            <button class="btn btn-info"> Update </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>

</body>
</html>