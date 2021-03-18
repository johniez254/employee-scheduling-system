<?php
echo doctype('html5');
?>
<head>
	<meta charset="utf-8">
	<title>err404</title>
    <?php echo link_tag('components/css/plugins/bootstrap/css/bootstrap.min.css'); ?>
    <?php echo link_tag('components/css/icons/font-awesome/css/font-awesome.min.css'); ?>
    <?php echo link_tag('components/css/style.css'); ?>
    <?php echo link_tag('components/css/plugins.css'); ?>
    <?php echo link_tag('components/css/demo.css'); ?>

</head>
<body>

<div id="wrapper">
 <!-- begin MAIN PAGE CONTENT -->
        <div id="page-wrapper-error">

                <div class="row">
                    <div class="col-lg-6 col-lg-offset-3">
                    <br><br<br><br><br<br>
                        <h1 class="error-title">404</h1>
                        <h4 class="error-msg"><i class="fa fa-warning text-red"></i> Page Not Found</h4>
                        <p><b>URL</b> =  <?php echo base_url(uri_string()); ?></p>
                        <p class="lead">The page you've requested could not be found on the server. Please <a href="Mailto:johnsonmatoke@gmail.com"><B class="text text-blue">contact your webmaster</B></a>, or use the back button <strong>(<i class="fa fa-arrow-left"></i>)</strong> in your browser to navigate back to your most recent active page.</p>
                        
                        <ul class="list-inline">
                            <li>
                                <a class="logout_open btn btn-red" href="<?php echo base_url() ?>login/logout">Logout</a>
                            </li>
                        </ul>
                    </div>
                    <!-- /.col-lg-6 -->
                </div>
                <!-- /.row -->

          

        </div>
        <!-- /#page-wrapper -->
        <!-- end MAIN PAGE CONTENT -->
</div>


<script src="<?php echo base_url(); ?>components/js/jquery.min.js"></script>
<script src="<?php echo base_url(); ?>components/js/plugins/bootstrap/bootstrap.min.js"></script>
</body>
</html>