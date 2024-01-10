<form method="post" action="<?php echo htmlspecialchars( $_SERVER["PHP_SELF"] ); ?>" enctype="multipart/form-data">
    <script type="text/javascript" src="javascript.js"></script>

    <label>Full Name:</label>
    <input type="text" id="name" name="name" value=""><br>

    <label>Username:</label>
    <input type="text" id="username" name="username" value=""><br>

    <label>Password:</label>
    <input type="password" id="Password" name="password" minlength="8">
    <input type="checkbox" onclick="showPassword()"><label>Show Password</label>
    <br>
    <label>Gender:</label><br>
    <input type="radio" id="Male" name="gender">
    <label>Male</label><br>

    <input type="radio" id="Female" name="gender">
    <label>Female</label><br>

    <input type="radio" id="Other" name="gender" onclick="showHideDivOther()">
    <label>Other</label><br>
    <div id="otherGender" style="display: none">

        <input type="text" name="otherGender">

    </div>



    <br>
    <label>Date of Birth</label>
    <input type="date" id="birthday" name="birthday"><br>

    <label>Mobile Number</label>
    <input type="tel" id="phone" name="phone" placeholder="123-456-7891" pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}"
        required><br>

    <label>Email</label>
    <input type="email" id="email" name="email"><br>


    <input type="submit" value="Create Account">