<div class="comment-container">
    <div class="comments">
        <h3>Comments:</h3>
        <?php
if ( count( $comments ) !== 0 ) {
    foreach ( $comments as $comment ) {
        include "/home/droppingfries/public_html/WeRam" . '/templates/post/comment.inc';
    }
}
?>
    </div>
    <form method="post" id="comment-form">
        <hr>
        Comment:<br>
        <input type="hidden" name="post-id" value="<?php echo $post_id; ?>">
        <textarea name="comment-content" rows="2" cols="44" placeholder=".........Type your comment here........"
            required></textarea><br>
        <input type="text" name="comment-name" id="comment-name"><br>
        <input type="submit" id="comment-submit" value="Submit">
    </form>
</div>


<script type="text/javascript">
var submitBtn = document.getElementById('comment-submit');
var form = document.getElementById('comment-form');
submitBtn.addEventListener('click', function(event) {
    event.preventDefault();
    var formData = new FormData(form);
    var data = {};
    formData.forEach(function(value, key) {
        data[key] = value;
    });
    console.log(data);
    fetch('/posts/comments-actions.php', {
            method: 'POST',
            mode: "same-origin",
            credentials: "same-origin",
            headers: {
                'Accept': 'application/json, text/plain',
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(data)
        })
        .then(res => res.json())
        .then(data => {
            document.getElementsByClassName('comments')[0].innerHTML += data.data.data;
        })
})
</script>