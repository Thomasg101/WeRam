<a href="?pageNum=2" class="return">Return to Gallery</a><br><br><br>
<form method="post" action="<?php echo htmlspecialchars( $_SERVER["PHP_SELF"] ) . "?pageNum=2"; ?>"
    enctype="multipart/form-data">

    <div class="form" id="formIn">
        <br>
        <label for="name"> Name:</label><br>
        <input type="text" id="name" name="name" value="<?php echo $name; ?>" placeholder="Your First Name....">
        <span class="error">* <?php echo $nameErr; ?></span>
        <br><br>
        <label>Username:</label><br>
        <input type="text" id="username" name="username" value="<?php echo $username; ?>"
            placeholder="Your Username....">
        <span class="error">* <?php echo $usernameErr; ?></span><br><br>

        <label>Password:</label><br>
        <input type="password" id="Password" name="password" minlength="8">
        <input type="checkbox" onclick="showPassword()"><label>Show Password</label>
        <br><br>
        <label>Date of Birth:</label><br>
        <input type="date" id="birthday" name="birthday"><br><br>


        <label>Mobile Number:</label><br>
        <input type="tel" id="phone" name="phone" placeholder="123-456-7891"
            pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}"><br><br>

        <label>Email:</label><br>
        <input type="email" id="email" name="email" required>
        <br>
        <br>
        <label>Connection to Mount Douglas:</label>
        <span class="error">* <?php echo $connectionErr; ?></span><br><br>


        <input type="radio" id="currentStudent" name="connection" onclick="ShowHideDiv()" <?php if ( isset( $connection ) && $connection == "Current Student" ) {
    echo "checked ";
}
?>value="Current Student">
        <label for="currentStudent">Current Student</label><br>
        <div id="grade1" style="display: none">
            <select name="grade" id="grade">
                <option <?php if ( isset( $grade ) && $grade == "9" ) {
    echo "selected";
}
?> value="9">Grade 9</option>
                <option <?php if ( isset( $grade ) && $grade == "10" ) {
    echo "selected";
}
?> value="10">Grade 10</option>
                <option <?php if ( isset( $grade ) && $grade == "11" ) {
    echo "selected";
}
?> value="11">Grade 11</option>
                <option <?php if ( isset( $grade ) && $grade == "12" ) {
    echo "selected";
}
?> value="12">Grade 12</option>
            </select>

        </div>
        <input type="radio" id="alumni" name="connection" onclick="ShowHideDiv()" <?php if ( isset( $connection ) && $connection == "Alumni" ) {
    echo "checked";
}
?> value="Alumni">
        <label for="alumni">Alumni</label><br>
        <input type="radio" id="staff" name="connection" onclick="ShowHideDiv()" <?php if ( isset( $connection ) && $connection == "Staff" ) {
    echo "checked ";
}
?> value="Staff">
        <label for="staff">Staff</label><br><br>
        <input type="checkbox" id="Agreement" name="Agreement" <?php if ( isset( $agreement ) && $agreement == "Yes" ) {
    echo "checked";
}
?> value="Yes">
        <label for="Agreement">I give RamBook non-exclusive, transferable, sub-licensable, royalty-free, worldwide
            license to use this photo.</label>
        <span class="error">* <?php echo $agreementErr; ?></span><br><br>
        <label for="myfile">Profile Picture:</label><br>
        <input type="file" id="myfile" name="myfile">
        <span class="error">* <?php echo $myFileErr; ?></span><br><br>
        <label for="textInput">Say Something About Yourself</label><br><br>
        <textarea name="textInput" id="textInput"><?php echo $textInput; ?></textarea>
        <span class="error">* <?php echo $textInputErr; ?></span>



        <br>
        <input type="submit" value="Submit" id="formsub" name="createprofile">
    </div>
</form>