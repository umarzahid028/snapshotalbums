<!DOCTYPE html>
<html data-scompiler-id="0" dir="ltr" lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1" name="viewport">
    <meta content="telephone=no" name="format-detection">
    <title>Arbortrue Laboratoires Dashboard</title><!-- icon -->
    <link href="<?php echo url('/') ?>/images/logo.png" rel="icon" type="image/png"><!-- fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,500,500i,700,700i,900,900i" rel="stylesheet"><!-- css -->
    <link href="<?php echo url('/') ?>/vendor/bootstrap/css/bootstrap.ltr.css" rel="stylesheet">
    <link href="<?php echo url('/') ?>/vendor/highlight.js/styles/github.css" rel="stylesheet">
    <link href="<?php echo url('/') ?>/vendor/simplebar/simplebar.min.css" rel="stylesheet">
    <link href="<?php echo url('/') ?>/vendor/quill/quill.snow.css" rel="stylesheet">
    <link href="<?php echo url('/') ?>/vendor/air-datepicker/css/datepicker.min.css" rel="stylesheet">
    <link href="<?php echo url('/') ?>/vendor/select2/css/select2.min.css" rel="stylesheet">
    <link href="<?php echo url('/') ?>/vendor/datatables/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <link href="<?php echo url('/') ?>/vendor/nouislider/nouislider.min.css" rel="stylesheet">
    <link href="<?php echo url('/') ?>/vendor/fullcalendar/main.min.css" rel="stylesheet">
    <link href="<?php echo url('/') ?>/css/style.css" rel="stylesheet">
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-97489509-8">
    </script>
    <script>
           window.dataLayer = window.dataLayer || [];
           function gtag(){dataLayer.push(arguments);}
           gtag('js', new Date());

           gtag('config', 'UA-97489509-8');
    </script>
</head>
<body>
    <div class="min-h-100 p-0 p-sm-6 d-flex align-items-stretch">
        <div class="card w-25x flex-grow-1 flex-sm-grow-0 m-sm-auto">
            <div class="card-body p-sm-5 m-sm-3 flex-grow-0">
                <h1 class="mb-0 fs-3">Sign Up</h1>
                <div class="fs-exact-14 text-muted mt-2 pt-1 mb-5 pb-2">
                    Fill out the form to create a new account.
                </div>
                <form method="POST" action="{{ route('register') }}" class="signin-form">
                      @csrf
                <div class="mb-4">
                    <label class="form-label">Full name</label>
                    <input class="form-control form-control-lg @error('name') is-invalid @enderror" type="text" name="name" required>
                    @error('name')
                            <span class="invalid-feedback-black" role="alert">
                                 <strong>{{ $message }}</strong>
                            </span>
                    @enderror
                </div>
                <div class="mb-4">
                    <label class="form-label">Email Address</label>
                    <input class="form-control form-control-lg @error('email') is-invalid @enderror" type="email" name="email" required>
                    @error('email')
                            <span class="invalid-feedback-black" role="alert">
                                 <strong>{{ $message }}</strong>
                            </span>
                    @enderror
                </div>
                <div class="mb-4">
                    <label class="form-label">Company Name </label>
                    <input class="form-control form-control-lg @error('company_name') is-invalid @enderror" type="text" name="company_name">
                    @error('company_name')
                            <span class="invalid-feedback-black" role="alert">
                                 <strong>{{ $message }}</strong>
                            </span>
                    @enderror
                </div>
                <div class="mb-4">
                    <label class="form-label">User Type</label>

                    <select name="role_id" class="form-select mt-3 @error('role_id') is-invalid @enderror">
                        <option value="2">Retailer</option>
                         <option value="3" >Distributor </option>
                          <option value="4" >Wholesaler </option>
                    </select>
                    @error('role_id')
                            <span class="invalid-feedback-black" role="alert">
                                 <strong>{{ $message }}</strong>
                            </span>
                    @enderror
                </div>
                <div class="mb-4">
                    <label class="form-label">Password</label>
                    <input id="password" class="form-control form-control-lg @error('password') is-invalid @enderror" type="password" name="password" required autocomplete="new-password">
                    @error('password')
                            <span class="invalid-feedback-black" role="alert">
                                 <strong>{{ $message }}</strong>
                            </span>
                    @enderror
                </div>
                <div class="mb-4">
                    <label class="form-label">Confirm Password</label>
                    <input id="password-confirm" class="form-control form-control-lg @error('password') is-invalid @enderror" type="password" name="password_confirmation" required autocomplete="new-password">
                    @error('password')
                            <span class="invalid-feedback-black" role="alert">
                                 <strong>{{ $message }}</strong>
                            </span>
                    @enderror
                </div>
                <div class="mb-4 py-2">
                    <label class="form-check mb-0">
                    <input class="form-check-input" type="checkbox"><span class="form-check-label">I agree to the <a href="page-terms.html">terms and conditions</a>.</span></label>
                </div>
                <div>
                    <button class="btn btn-primary btn-lg w-100" type="submit">Sign Up</button>
                </div>
            </div>
            </form>
            <div class="card-body p-sm-5 m-sm-3 flex-grow-0">
                
                <div class="form-group mb-0 mt-4 pt-2 text-center text-muted">
                    Already have an account? <a href="/login">Sign in</a>
                </div>
            </div>
        </div>
    </div><!-- scripts -->
    <script src="<?php echo url('/') ?>/vendor/jquery/jquery.min.js">
    </script>
    <script src="<?php echo url('/') ?>/vendor/feather-icons/feather.min.js">
    </script>
    <script src="<?php echo url('/') ?>/vendor/simplebar/simplebar.min.js">
    </script>
    <script src="<?php echo url('/') ?>/vendor/bootstrap/js/bootstrap.bundle.min.js">
    </script>
    <script src="<?php echo url('/') ?>/vendor/highlight.js/highlight.pack.js">
    </script>
    <script src="<?php echo url('/') ?>/vendor/quill/quill.min.js">
    </script>
    <script src="<?php echo url('/') ?>/vendor/air-datepicker/js/datepicker.min.js">
    </script>
    <script src="<?php echo url('/') ?>/vendor/air-datepicker/js/i18n/datepicker.en.js">
    </script>
    <script src="<?php echo url('/') ?>/vendor/select2/js/select2.min.js">
    </script>
    <script async data-auto-replace-svg="" src="<?php echo url('/') ?>/vendor/fontawesome/js/all.min.js">
    </script>
    <script src="<?php echo url('/') ?>/vendor/chart.js/chart.min.js">
    </script>
    <script src="<?php echo url('/') ?>/vendor/datatables/js/jquery.dataTables.min.js">
    </script>
    <script src="<?php echo url('/') ?>/vendor/datatables/js/dataTables.bootstrap5.min.js">
    </script>
    <script src="<?php echo url('/') ?>/vendor/nouislider/nouislider.min.js">
    </script>
    <script src="<?php echo url('/') ?>/vendor/fullcalendar/main.min.js">
    </script>
    <script src="<?php echo url('/') ?>/js/stroyka.js">
    </script>
    <script src="<?php echo url('/') ?>/js/custom.js">
    </script>
    <script src="<?php echo url('/') ?>/js/calendar.js">
    </script>
    <script src="<?php echo url('/') ?>/js/demo.js">
    </script>
    <script src="<?php echo url('/') ?>/js/demo-chart-js.js">
    </script>
</body>
</html>