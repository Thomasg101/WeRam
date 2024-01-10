<!DOCTYPE html>
<html>

<head>
    <title>Bootstrap Hide Show Password</title>
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-show-password/1.0.3/bootstrap-show-password.min.js"></script>
</head>

<body>

    <!-- Bootstrap navbar -->
    <nav class="navbar navbar-inverse">
        <div class="container-fluid">
            <div class="navbar-header">
                <a class="navbar-brand" href="index.php">Best CS Project</a>
            </div>
            <ul class="nav navbar-nav">
                <!-- <li class="active"><a href="index.php">Home</a></li> -->
                <li><a href="about.php">About Us</a></li>
                <!-- <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">Gallery<span class="caret"></span></a>
	  <ul class="dropdown-menu">
		<li><a href="http://142.31.53.220/~thomas/Rambook6/">All</a></li>
		<li><a href="#">Staff</a></li>
		<li><a href="#">Student</a></li>
		<li><a href="#">Alumni</a></li>
	  </ul>
	</li> -->
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li><a href="signup.php"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
                <li><a href="login.php"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
                <!-- <li><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li> -->
            </ul>
        </div>
    </nav>
    <div class="container">
        <h1>Sign In</h1>
        <h3>Password eye / bi-eye sample</h3>
        <br />
        <form>
            <div class="form-group">
                <label>Username:</label>
                <input type="text" name="username" class="form-control">
            </div>
            <div class="form-group">
                <label>Password:</label>
                <input type="password" id="password" name="password" class="form-control" data-toggle="password">
            </div>
            <div class="form-group">
                <button class="btn btn-success">Submit</button>
            </div>
        </form>
    </div>

    <script type="text/javascript">
        $("#password").password('toggle');
    </script>

</body>

</html>