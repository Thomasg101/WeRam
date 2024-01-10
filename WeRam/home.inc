<div class="nav" id="navBar">
    <div class="s" id="s">
        <input type="text" id="search" name="search" placeholder="Search..">
        <input type="submit" id="searchbttn" value="🔍" onclick="search()">
    </div>

    <a href="?pageNum=1" id="addPro">Create Account</a>
    <a href="https://www.youtube.com/watch?v=iik25wqIuFo" id="delete">Delete Gallery</a>
    <a href="http://142.31.53.220/~droppingfries/WeRam/downloadall.php?" id="downAll"> Download All</a>
    <a href="login.php" id="Login">Log in</a>
    <a href="logout.php" id="logout">Log out</a>
</div>
<br>


<div id="imageB">

    <div id="lightbox" class="hidden" onclick="displayLightBox('','')">
    </div>

    <div id="positionBigImage">

        <div id="boundaryBigImage" class="unhidden">
            <b id="butt" onclick="displayLightBox('','')">X</b>


            <b id="butt" onclick="changeImage(0)">
                <---< /b>

                    <div id="acutalImg">
                        <img id="bigImage" src="" alt="">
                    </div>
                    <b id="butt2" onclick="changeImage(1)">---></b>
                    <div id="name2" class="output"></div>
                    <div id="grade2" class="output"></div>
                    <div id="textInput2" class="output"></div>
                    <div id="connection2" class="output"></div>
                    <a href="" download id="download">Download this image</a>
        </div>

    </div>
</div>
<div id="filter">

</div>

<div class="dropdown">
    <button class="dropbtn" onclick="myFunction()">Filter By</button>
    <div class="dropdown-content" id="myDropdown">
        <a href="#" onclick="loadImages('all')">All images</a>
        <a href="#" onclick="loadImages('Staff')">Staff Images</a>
        <a href="#" onclick="loadImages('Current Student')">Student Images</a>
        <a href="#" onclick="loadImages('Alumni')">Alumni Images</a>
    </div>
</div>
<div id="main">

</div>

<?php
$file = "userprofiles.json";
if ( !file_exists( "userprofiles.json" ) ) {
    touch( "userprofiles.json" );
}

$dir = "thumbnails/";
$uid = file_get_contents( "identifier.txt" );
$uid--;
$count = 1;

echo "<br>";
if ( $dh = opendir( $dir ) ) {
    while (  ( $file = readdir( $dh ) ) !== false ) {

        if ( !is_dir( $dir . $file ) ) {
            //echo "<img src='" . $dir . $file . "' onclick=displayLightBox(\"thumbnails\",\"" . $file . "\") >";

            if (  ( $count % 4 ) == 0 ) {
                echo "<br>";
            }
            $count++;
        }
    }
    closedir( $dh );
}

?>