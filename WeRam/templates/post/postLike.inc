<button hidden id="unlike-post" data-post_id="<?php echo $post_id; ?>">Unlike</button>
<button id="like-post" data-post_id="<?php echo $post_id; ?>">Like</button>
<p class="like-container"><span id="like-counter"><?php echo $likes; ?></span><span>:&nbsp;&nbsp;Likes</span></p>

<script type="text/javascript">
var likeBtn = document.getElementById('like-post');
var unlikeBtn = document.getElementById('unlike-post')
var post_id = parseInt(likeBtn.dataset.post_id);
likeBtn.addEventListener('click', function(event) {
    event.preventDefault();
    var data = {
        post_id: post_id,
        action: 'like'
    };
    fetch('/posts/like-actions.php', {
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
            document.getElementById('like-counter').innerText = data.data.data;
            document.getElementById('like-post').hidden = true;
            document.getElementById('unlike-post').hidden = false;
        })
})
unlikeBtn.addEventListener('click', function(event) {
    event.preventDefault();
    var data = {
        post_id: post_id,
        action: 'unlike'
    };
    fetch('/posts/like-actions.php', {
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
            document.getElementById('like-counter').innerText = data.data.data;
            document.getElementById('like-post').hidden = false;
            document.getElementById('unlike-post').hidden = true;
        })
})
</script>