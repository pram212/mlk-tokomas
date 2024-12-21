<?php $general_setting = DB::table('general_settings')->find(1); ?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>{{$general_setting->site_title}}</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="all,follow">
    <link rel="manifest" href="{{url('manifest.json')}}">
    <link rel="icon" type="image/png" href="{{url('logo', $general_setting->site_logo)}}" />
    <!-- Bootstrap CSS-->
    <link rel="stylesheet" href="<?php echo asset('vendor/bootstrap/css/bootstrap.min.css') ?>" type="text/css">
    <link rel="stylesheet" href="<?php echo asset('vendor/bootstrap/css/bootstrap-datepicker.min.css') ?>"
        type="text/css">
    <link rel="stylesheet" href="<?php echo asset('vendor/bootstrap/css/bootstrap-select.min.css') ?>"
        type="text/css">
    <!-- Font Awesome CSS-->
    <link rel="stylesheet" href="<?php echo asset('vendor/font-awesome/css/font-awesome.min.css') ?>"
        type="text/css">
    <!-- Google fonts - Roboto -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700">
    <!-- jQuery Circle-->
    <link rel="stylesheet" href="<?php echo asset('css/grasp_mobile_progress_circle-1.0.0.min.css') ?>"
        type="text/css">
    <!-- Custom Scrollbar-->
    <link rel="stylesheet"
        href="<?php echo asset('vendor/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.css') ?>"
        type="text/css">
    <!-- theme stylesheet-->
    <link rel="stylesheet" href="<?php echo asset('css/style.default.css') ?>" id="theme-stylesheet"
        type="text/css">
    <!-- Custom stylesheet - for your changes-->
    <link rel="stylesheet" href="<?php echo asset('css/custom-'.$general_setting->theme) ?>" type="text/css">
    <!-- Tweaks for older IEs-->
    <script type="text/javascript" src="<?php echo asset('vendor/jquery/jquery.min.js') ?>"></script>
    <script type="text/javascript" src="<?php echo asset('vendor/jquery/jquery-ui.min.js') ?>"></script>
    <script type="text/javascript" src="<?php echo asset('vendor/jquery/bootstrap-datepicker.min.js') ?>">
    </script>
    <script type="text/javascript" src="<?php echo asset('vendor/popper.js/umd/popper.min.js') ?>">
    </script>
    <script type="text/javascript" src="<?php echo asset('vendor/bootstrap/js/bootstrap.min.js') ?>"></script>
    <script type="text/javascript" src="<?php echo asset('vendor/bootstrap/js/bootstrap-select.min.js') ?>">
    </script>
    <script type="text/javascript" src="<?php echo asset('js/grasp_mobile_progress_circle-1.0.0.min.js') ?>">
    </script>
    <script type="text/javascript" src="<?php echo asset('vendor/jquery.cookie/jquery.cookie.js') ?>">
    </script>
    <script type="text/javascript" src="<?php echo asset('vendor/jquery-validation/jquery.validate.min.js') ?>">
    </script>
    <script type="text/javascript"
        src="<?php echo asset('vendor/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.concat.min.js')?>">
    </script>
    <script type="text/javascript" src="<?php echo asset('js/front.js') ?>"></script>
    <style>
        .form-outer {
            max-width: 900px !important;
            max-height: 500px !important;
        }

        .form-inner {
            /* width: 900px !important; */
        }

        .btn-submit {
            color: #fff;
            background-color: #D3A945;
            border-color: #D3A945;
            display: block;
            width: 100%;
            padding: 0.375rem 0.75rem;
            font-size: 1rem;
            margin-top: 2rem;
        }

        .btn-submit:hover {
            color: #fff;
            background-color: #D5BF02;
            border-color: #D5BF02;
        }
    </style>
</head>

<body>
    <!-- <div class="alert alert-danger alert-dismissible text-center"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Please close the envato preview window from the top-right corner before accessing the demo. Thank you.</div> -->
    <div class="page login-page">
        <div class="container">
            <div class="form-outer text-center d-flex align-items-center">
                <div class="form-inner">

                    @if(session()->has('delete_message'))
                    <div class="alert alert-danger alert-dismissible text-center"><button type="button" class="close"
                            data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>{{
                        session()->get('delete_message') }}</div>
                    @endif
                    <div class="row">
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-12">
                                    <img src="{{ asset('logo/bima_text_1.png') }}" width="302px">
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-md-12">
                                    <img src="{{ asset('logo/bima_logo_1.png') }}" width="233px">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="row mt-3">
                                <div class="col-md-12 text-left">
                                    <span style="color:#D5BF02">Sign In</span><br>
                                    <small>Enter your username and password to access admin panel.</small>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">

                                    <form method="POST" action="{{ route('login') }}" id="login-form"
                                        style="margin: 2rem 0rem !important;max-width:90% !important">
                                        @csrf

                                        <div class="form-group text-left">
                                            <label for="login-username"
                                                class="label-material small">{{trans('file.UserName')}}</label>
                                            <div class="input-group flex-nowrap">
                                                <span class="input-group-text" id="addon-wrapping"><i
                                                        class="fa fa-user"></i></span>
                                                <input id="login-username" type="text" name="name" required
                                                    class="form-control" placeholder="Enter your username" value="">
                                            </div>

                                            @if ($errors->has('name'))
                                            <p>
                                                <strong>{{ $errors->first('name') }}</strong>
                                            </p>
                                            @endif
                                        </div>

                                        <div class="form-group text-left">
                                            <label for="login-password"
                                                class="label-material small">{{trans('file.Password')}}</label>
                                            <div class="input-group flex-nowrap">
                                                <span class="input-group-text" id="addon-wrapping"><i class="fa fa-key"
                                                        aria-hidden="true"></i></span>
                                                <input id="login-password" type="password" name="password" required
                                                    class="form-control" placeholder="Enter your password" value="">
                                            </div>

                                            @if ($errors->has('password'))
                                            <p>
                                                <strong>{{ $errors->first('password') }}</strong>
                                            </p>
                                            @endif
                                        </div>

                                        <button type="submit" class="btn btn-submit">{{trans('file.LogIn')}}</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="copyrights text-center">
                    <p>{{trans('file.Developed By')}} <span class="external">{{$general_setting->developed_by}}</span>
                    </p>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
<script>
    if ('serviceWorker' in navigator ) {
        window.addEventListener('load', function() {
            navigator.serviceWorker.register('/saleproposmajed/service-worker.js').then(function(registration) {
                // Registration was successful
                console.log('ServiceWorker registration successful with scope: ', registration.scope);
            }, function(err) {
                // registration failed :(
                console.log('ServiceWorker registration failed: ', err);
            });
        });
    }
</script>
<script type="text/javascript">
    $('.admin-btn').on('click', function(){
        $("input[name='name']").focus().val('admin');
        $("input[name='password']").focus().val('admin');
    });

  $('.staff-btn').on('click', function(){
      $("input[name='name']").focus().val('staff');
      $("input[name='password']").focus().val('staff');
  });

  $('.customer-btn').on('click', function(){
      $("input[name='name']").focus().val('shakalaka');
      $("input[name='password']").focus().val('shakalaka');
  });
  // ------------------------------------------------------- //
    // Material Inputs
    // ------------------------------------------------------ //

    var materialInputs = $('input.input-material');

    // activate labels for prefilled values
    materialInputs.filter(function() { return $(this).val() !== ""; }).siblings('.label-material').addClass('active');

    // move label on focus
    materialInputs.on('focus', function () {
        $(this).siblings('.label-material').addClass('active');
    });

    // remove/keep label on blur
    materialInputs.on('blur', function () {
        $(this).siblings('.label-material').removeClass('active');

        if ($(this).val() !== '') {
            $(this).siblings('.label-material').addClass('active');
        } else {
            $(this).siblings('.label-material').removeClass('active');
        }
    });
</script>