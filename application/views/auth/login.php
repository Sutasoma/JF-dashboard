<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Jasindo</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="<?php echo base_url('assets/node_modules/@coreui/icons/css/coreui-icons.min.css')?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/node_modules/flag-icon-css/css/flag-icon.min.css')?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/node_modules/font-awesome/css/font-awesome.min.css')?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/node_modules/simple-line-icons/css/simple-line-icons.css')?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/style.css')?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/vendors/pace-progress/css/pace.min.css')?>">
</head>
<body class="app flex-row align-items-center">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card-group">
                    <div class="card p-4">
                        <div class="card-body">
                            <h1>Login</h1>
                            <p class="text-muted">Sign In to your account</p>
                            <form id="formLogin" method="POST">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="icon-user"></i>
                                        </span>
                                    </div>
                                    <input class="form-control" type="text" name="username" id="username" placeholder="Username">
                                </div>
                                <div class="input-group mb-4">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="icon-lock"></i>
                                        </span>
                                    </div>
                                    <input class="form-control" type="password" name="password" id="password" placeholder="Password">
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <button class="btn btn-primary px-4" type="button" id="btnLogin">Login</button>
                                    </div>
                                    <div class="col-6 text-right">
                                        <button class="btn btn-link px-0" type="button">Forgot password?</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="card text-white bg-primary py-5 d-md-down-none" style="width:44%">
                        <div class="card-body text-center">
                            <div>
                                <h2>Sign up</h2>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                                <button class="btn btn-primary active mt-3" type="button">Register Now!</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<script src="<?php echo base_url('assets/node_modules/jquery/dist/jquery.min.js')?>"></script>
<script src="<?php echo base_url('assets/node_modules/popper.js/dist/umd/popper.min.js')?>"></script>
<script src="<?php echo base_url('assets/node_modules/bootstrap/dist/js/bootstrap.min.js')?>"></script>
<script src="<?php echo base_url('assets/node_modules/pace-progress/pace.min.js')?>"></script>
<script src="<?php echo base_url('assets/node_modules/perfect-scrollbar/dist/perfect-scrollbar.min.js')?>"></script>
<script src="<?php echo base_url('assets/node_modules/@coreui/coreui/dist/js/coreui.min.js')?>"></script>

<script type="text/javascript">

    $("#btnLogin").click(function() {
        var btn = $(this)
        btn.blur()
        var form = $("#formLogin").serialize();
        $.ajax({
            url: "<?php echo site_url();?>/auth/proses_login",
            type: "POST",
            data: form,
            beforeSend: function() {
                btn.prop("disabled", true)
                btn.text("Processing ...")
            },
            success: function (response) {
                
            },
            error: function(jqXHR, textStatus, errorThrown) {
                
            }
        });
    });

</script>

</body>
</html>