<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="A fully featured admin theme which can be used to build CRM, CMS, etc.">
        <meta name="author" content="Coderthemes">

        <link rel="shortcut icon" href="<?php echo base_url();?>assets/mega/logo.ico">
        <title>Bank Mega Syariah</title>
        <link href="<?php echo base_url();?>assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url();?>assets/css/core.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url();?>assets/css/components.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url();?>assets/css/icons.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url();?>assets/css/pages.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url();?>assets/css/responsive.css" rel="stylesheet" type="text/css" />
        <script src="<?php echo base_url();?>assets/js/modernizr.min.js"></script>       
    </head>
    <body>

        <div class="account-pages"></div>
        <div class="clearfix" ></div>
        <div class="wrapper-page">
	            <div class="panel-body" style="margin-top: -40px;position: absolute;margin: auto;width: 100%;height: 310px;border-radius: 5px;background: rgba(3,3,3,0.25);box-shadow: 1px 1px 50px #000;margin-left: -20px;">
	                <h3 class="text-center"> <img src="<?php echo base_url();?>assets/mega/logo.ico" style="width: 20%;" > <strong class="text-custom" style="font-size: 35px;color: #fff;">Memo Dinas</strong> </h3>
		            <form class="form-horizontal m-t-20" action="<?php echo base_url();?>auth/auth" method="post" >
		                 
		                <div class="form-group ">
		                    <div class="col-xs-12">
		                        <input class="form-control" type="text" required="" name="USER_ID" placeholder="Username" style="background: rgba(3,3,3,0.25);box-shadow: 1px 1px 50px #000;color: #fff;">
		                    </div>
		                </div>

		                <div class="form-group">
		                    <div class="col-xs-12">
		                        <input class="form-control" type="password" required="" name="USER_PASSWORD" placeholder="Password" style="background: rgba(3,3,3,0.25);box-shadow: 1px 1px 50px #000;color: #fff;"	>
		                    </div>
		                </div>
		                <div class="form-group text-center m-t-40">
		                    <div class="col-xs-12">
		                        <button class="btn btn-info btn-block text-uppercase waves-effect waves-light" type="submit">Log In</button>
		                    </div>
		                </div>
		            </form> 
	            </div>                                 
        </div>
    	<script>
            var resizefunc = [];
        </script>
        <!-- jQuery  -->
        <script src="<?php echo base_url();?>assets/js/jquery.min.js"></script>
        <script src="<?php echo base_url();?>assets/js/bootstrap.min.js"></script>
        <script src="<?php echo base_url();?>assets/js/detect.js"></script>
        <script src="<?php echo base_url();?>assets/js/fastclick.js"></script>
        <script src="<?php echo base_url();?>assets/js/jquery.slimscroll.js"></script>
        <script src="<?php echo base_url();?>assets/js/jquery.blockUI.js"></script>
        <script src="<?php echo base_url();?>assets/js/waves.js"></script>
        <script src="<?php echo base_url();?>assets/js/wow.min.js"></script>
        <script src="<?php echo base_url();?>assets/js/jquery.nicescroll.js"></script>
        <script src="<?php echo base_url();?>assets/js/jquery.scrollTo.min.js"></script>
        <script src="<?php echo base_url();?>assets/js/jquery.core.js"></script>
        <script src="<?php echo base_url();?>assets/js/jquery.app.js"></script>
	</body>
</html>