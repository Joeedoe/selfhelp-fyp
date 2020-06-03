<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>Chat2U | Log in</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport" />
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="{{ asset('vendors/bootstrap/dist/css/bootstrap.min.css') }}" />
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('vendors/font-awesome/css/font-awesome.min.css') }}" />
    <!-- Ionicons -->
    <link rel="stylesheet" href="{{ asset('vendors/Ionicons/css/ionicons.min.css') }}" />
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('css/AdminLTE.min.css') }}" />
    <!-- iCheck -->
    <link rel="stylesheet" href="{{ asset('vendors/iCheck/square/blue.css') }}" />

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
            <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->

    <!-- Google Font -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic" />
</head>

<body class="hold-transition login-page">
    <div class="login-box">
        <div class="login-logo">
            <a href="/"><b>Chat</b>2U</a>
            <hr>
            <img src="{{ asset('img/uitm.png') }}" height="100" alt="Universiti Teknologi Mara">
            <hr>
        </div>
        <!-- /.login-logo -->

        @if ($errors->any())
            <div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4>Error!</h4>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if (isset($_GET['logout']))
        <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h4>Success!</h4>
            Successfully logged out!
        </div>
        @endif

        <!-- CHOOSE ROLE -->
        <div class="login-box-body role">
            <p class="login-box-msg">Choose your role...</p>

            <div class="social-auth-links text-center">
                <a onclick="loginBox(0)" class="btn btn-lg btn-block btn-social btn-facebook btn-flat"><i
                        class="glyphicon glyphicon-education"></i>
                    Student</a>
                    <span><b>- OR -</b></span>
                <a onclick="loginBox(1)" class="btn btn-lg btn-block btn-social btn-google btn-flat"><i
                        class="glyphicon glyphicon-heart"></i> Counsellor</a>
            </div>
        </div>

        <!-- STUDENT LOGIN -->
        <div class="login-box-body student bg-navy" style="display: none">
            <a onclick="loginBox()" class="btn btn-block btn-social btn-warning btn-flat"><i
                    class="glyphicon glyphicon-chevron-left"></i> Back</a>
            <hr />
            <p class="login-box-msg">
                Welcome, student! Need some advice? Login first...
            </p>
            <form action="{{ route('login') }}" method="post">
                @csrf
                <div class="form-group has-feedback">
                    <input type="text" name="uniId" class="form-control" placeholder="Student ID" required />
                    <span class="glyphicon glyphicon-user form-control-feedback"></span>
                </div>
                <div class="form-group has-feedback">
                    <input type="password" name="password" class="form-control" placeholder="Password" required />
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                </div>
                <div class="row">
                    <div class="col-xs-8">
                        <div class="checkbox icheck">
                            <label>
                                <input type="checkbox" name="remember_me" /> Remember Me
                            </label>
                        </div>
                    </div>
                    <!-- /.col -->
                    <div class="col-xs-4">
                        <button type="submit" class="btn btn-primary btn-block btn-flat">
                            Sign In
                        </button>
                    </div>
                    <!-- /.col -->
                </div>
            </form>

            <a href="#">I forgot my password</a><br />
            <a href="#" class="text-center st-reg-btn" >Register a new membership</a>
            <br>
            <hr>
            <form action="{{ route('register') }}" class="st-reg-form" method="post" style="display: none">
                @csrf
                <input type="hidden" name="userRole" value="3">
                <div class="form-group has-feedback">
                  <input type="text" name="uniId" class="form-control" placeholder="Student ID" required>
                  <span class="glyphicon glyphicon-user form-control-feedback"></span>
                </div>
                <div class="form-group has-feedback">
                    <input type="text" name="username" class="form-control" placeholder="Username" required>
                    <span class="fa fa-user-secret form-control-feedback"></span>
                </div>
                <div class="form-group has-feedback">
                  <input type="email" name="email" class="form-control" placeholder="Email" required>
                  <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                </div>
                <div class="form-group has-feedback">
                  <input type="password" name="password" class="form-control" placeholder="Password" required>
                  <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                </div>
                <div class="form-group has-feedback">
                  <input type="password" name="password_confirmation" class="form-control" placeholder="Retype password" required>
                  <span class="glyphicon glyphicon-log-in form-control-feedback"></span>
                </div>
                <div class="row">
                  <div class="col-xs-8">
                    <div class="checkbox icheck">
                      <label>
                        <input type="checkbox" required> I agree to the <a href="#">terms</a>
                      </label>
                    </div>
                  </div>
                  <!-- /.col -->
                  <div class="col-xs-4">
                    <button type="submit" class="btn btn-primary btn-block btn-flat">Register</button>
                  </div>
                  <!-- /.col -->
                </div>
              </form>
        </div>

        <!-- COUNSELLOR LOGIN -->
        <div class="login-box-body counsellor" style="display: none;background-color: darkred;color:white;">
            <a onclick="loginBox()" class="btn btn-block btn-social btn-warning btn-flat"><i
                    class="glyphicon glyphicon-chevron-left"></i> Back</a>
            <hr />
            <p class="login-box-msg">
                Welcome, counsellor! Thank you for helping the needs.
            </p>
            <form action="{{ route('login') }}" method="post">
                @csrf
                <div class="form-group has-feedback">
                    <input type="text" name="uniId" class="form-control" placeholder="Staff ID" required/>
                    <span class="glyphicon glyphicon-user form-control-feedback"></span>
                </div>
                <div class="form-group has-feedback">
                    <input type="password" name="password" class="form-control" placeholder="Password" required/>
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                </div>
                <div class="row">
                    <div class="col-xs-8">
                        <div class="checkbox icheck">
                            <label>
                                <input type="checkbox" name="remember_me" /> Remember Me
                            </label>
                        </div>
                    </div>
                    <!-- /.col -->
                    <div class="col-xs-4">
                        <button type="submit" class="btn btn-primary btn-block btn-flat">
                            Sign In
                        </button>
                    </div>
                    <!-- /.col -->
                </div>
            </form>

            <a href="#">I forgot my password</a><br />
            <a href="#" class="text-center cl-reg-btn" >Register a new membership</a>
            <br>
            <hr>
            <form action="{{ route('register') }}" class="cl-reg-form" method="post" style="display: none">
                @csrf
                <input type="hidden" name="userRole" value="2">
                <div class="form-group has-feedback">
                  <input type="text" name="uniId" class="form-control" placeholder="Staff ID" required>
                  <span class="glyphicon glyphicon-user form-control-feedback"></span>
                </div>
                <div class="form-group has-feedback">
                    <input type="text" name="username" class="form-control" placeholder="Full Name" required>
                    <span class="fa fa-user-secret form-control-feedback"></span>
                </div>
                <div class="form-group has-feedback">
                  <input type="email" name="email" class="form-control" placeholder="Email" required>
                  <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                </div>
                <div class="form-group has-feedback">
                  <input type="password" name="password" class="form-control" placeholder="Password" required>
                  <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                </div>
                <div class="form-group has-feedback">
                  <input type="password" name="password_confirmation" class="form-control" placeholder="Retype password" required>
                  <span class="glyphicon glyphicon-log-in form-control-feedback"></span>
                </div>
                <div class="row">
                  <div class="col-xs-8">
                    <div class="checkbox icheck">
                      <label>
                        <input type="checkbox" required> I agree to the <a href="#">terms</a>
                      </label>
                    </div>
                  </div>
                  <!-- /.col -->
                  <div class="col-xs-4">
                    <button type="submit" class="btn btn-primary btn-block btn-flat">Register</button>
                  </div>
                  <!-- /.col -->
                </div>
              </form>
        </div>



    </div>
    <!-- /.login-box -->

    <!-- jQuery 3 -->
    <script src="{{ asset('vendors/jquery/dist/jquery.min.js') }}"></script>
    <!-- Bootstrap 3.3.7 -->
    <script src="{{
                asset('vendors/bootstrap/dist/js/bootstrap.min.js')
            }}"></script>
    <!-- iCheck -->
    <script src="{{ asset('vendors/iCheck/icheck.min.js') }}"></script>
    <script>
        $(function () {
            $("input").iCheck({
                checkboxClass: "icheckbox_square-blue",
                radioClass: "iradio_square-blue",
                increaseArea: "20%" /* optional */
            });

            $('.st-reg-btn').click(function(){
                $('.st-reg-form').slideToggle()
            })

            $('.cl-reg-btn').click(function(){
                $('.cl-reg-form').slideToggle()
            })
        });

        let role = 0;

        function loginBox(id = 2) {
            if (role) {
                $(".counsellor").fadeOut("fast", function () {
                    $(".student").fadeOut("fast", function () {
                        $(".role").fadeIn("fast");
                        $('.st-reg-form').slideUp();
                        $('.cl-reg-form').slideUp();
                    });
                });

                role = 0;
            } else {
                if (id) {
                    $(".role").fadeOut("fast", function () {
                        $(".counsellor").fadeIn("fast");
                    });
                    role = 1;
                } else {
                    $(".role").fadeOut("fast", function () {
                        $(".student").fadeIn("fast");
                    });
                    role = 1;
                }
            }
        }
    </script>
</body>

</html>
