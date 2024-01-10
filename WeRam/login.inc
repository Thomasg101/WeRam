  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inconsolata:wght@300&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="style.css">
  <br><a href="http://142.31.53.220/~droppingfries/WeRam/index.php?pageNum=2" class="return">Return to
      Gallery</a><br>

  <form method="post" action="<?php echo htmlspecialchars( $_SERVER["PHP_SELF"] ); ?>">
      <div id="yo">
          <label for="Username">Username:</label>
          <input name="username" type="text" class="form-control" id="username">
          <span <?php echo $usernameErr ?>></span>
          <span <?php echo $passwordVerifyErr ?>></span>
          <br>
          <label>Password: </label>
          <input type="password" id="Password" name="password"> <input type="checkbox" onclick="showPassword()"
              class="form-control" class="Input"><label>Show Password</label>
          <span <?php echo $passwordErr ?>></span>
          <br>
          <input type="submit" name="login" id="formsub">
      </div>
  </form>


  <style>

  </style>