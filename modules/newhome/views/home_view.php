<!DOCTYPE html>
<html lang="en" class="no-js">

    <head>

        <meta charset="utf-8">
        <title>Fullscreen Login</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">

        <!-- CSS -->
        <link rel='stylesheet' href='http://fonts.googleapis.com/css?family=PT+Sans:400,700'>
        <link rel="stylesheet" href="http://localhost/CI/assets/css/reset.css">
        <link rel="stylesheet" href="http://localhost/CI/assets/css/supersized.css">
        <link rel="stylesheet" href="http://localhost/CI/assets/css/style.css">

        <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
        <!--[if lt IE 9]>
            <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->
<style>
input[type=radio] { width:15px !important; margin-right:10px; height: 10px;}
#consumerform label {margin-right:25px;}

</style>
    </head>

    <body>

        <div class="page-container" id="consumerform" action="/users" method="POST">
            <h1>Login</h1>
            <form action="" method="post">
			
			<div><input name="login_usertype" value="1" class="login_usertype" type="radio" id="Cunsumer"> <label> Customer </label><input name="login_usertype" value="1" class="login_usertype" type="radio" id="SBP"><label>  Vendor </label></div>
			
			
                <input type="text" name="login_username" class="username" placeholder="Username">
                <input type="password" name="login_password" class="password" placeholder="Password">
                <button type="submit">Sign me in</button>
				<button type="submit">Sign Up Here</button>
                <div class="error"><span>+</span></div>
            </form>
            <div class="connect">
                <p>Or connect with:</p>
                <p>
                    <a class="facebook" href=""></a>
                    <a class="twitter" href=""></a>
                </p>
            </div>
        </div>
		
		 <div class="page-container" id="SBPform" action="/users" method="POST">
            <h1>Login</h1>
            <form action="" method="post">
			
		<div><input name="login_usertype" value="1" class="login_usertype" type="radio" id="Cunsumer"> <label> Customer </label><input name="login_usertype" value="1" class="login_usertype" type="radio" id="SBP"><label>  Vendor </label></div>
			
                <input type="text" name="login_username" class="username" placeholder="Username">
                <input type="password" name="login_password" class="password" placeholder="Password">
                <input type="text" name="login_user_no" class="password" placeholder="Vendor Code">
                <button type="submit">Sign me in</button>
				<button type="submit">Sign Up Here</button>
                <div class="error"><span>+</span></div>
            </form>
            <div class="connect">
                <p>Or connect with:</p>
                <p>
                    <a class="facebook" href=""></a>
                    <a class="twitter" href=""></a>
                </p>
            </div>
        </div>

        <!-- Javascript -->
        <script src="http://localhost/CI/assets/js/jquery-1.8.2.min.js"></script>
        <script src="http://localhost/CI/assets/js/supersized.3.2.7.min.js"></script>
        <script src="http://localhost/CI/assets/js/supersized-init.js"></script>
        <script src="http://localhost/CI/assets/js/scripts.js"></script>

    </body>
	
<script>

$('document').ready(function(){
	
	$('#SBPform').hide();
	
	$('#Consumer').click(function(){
		$('#SBPform').hide();
		$('#SBPform').find('input').text('');
		$('#consumerform').show();
		
	});
	
	$('#SBP').click(function(){
		$('#consumerform').hide();
		$('#Consumer').find('input').text('');
		$('#SBPform').show();
	});
	
});

</script>
</html>