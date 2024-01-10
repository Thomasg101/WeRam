<form method="post" action="<?php // echo $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data" id="create-post-form">
    <label for="post-title">Title</label>
    <input type="text" name="post-title" id="post-title">
    <br>
    <label for="post-content">Content</label>
    <textarea name="post-content" rows="7" cols="64" placeholder=".........Write Someting........" required></textarea>
    <br>
    <input type="file" name="post-image" />
    <div class="text-center" id="uploaded_image"></div>
    <br>
    <label for="enable-comment">
        <input type="checkbox" name="enable-comment" id="enable-comment">
        &nbsp;Enable Comments
    </label>
    <br>
    <input type="hidden" name="user-id" value="<?php echo isset( $_SESSION["UID"] ) ? $_SESSION["UID"] : 2; ?>">
    <input type="submit" value="Submit" id="submit-btn">
    <br>
    <hr>
</form>

<script type="text/javascript">
var submitBtn = document.getElementById('submit-btn');
var form = document.getElementById('create-post-form');
const post_image = document.getElementsByName('post-image')[0];

submitBtn.addEventListener('click', function(event) {
    event.preventDefault();
    var postImage = upload_image(post_image.files[0]);
    postImage.toJSON = function() {
        return {
            'lastModified': postImage.lastModified,
            'lastModifiedDate': postImage.lastModifiedDate,
            'name': postImage.name,
            'size': postImage.size,
            'type': postImage.type
        };
    }
    var formData = new FormData(form);
    console.log(formData);
    var data = {};
    formData.append('post-image', postImage);
    formData.forEach(function(value, key) {
        data[key] = value;
    })
    console.log(JSON.stringify(data));
    fetch('/posts/posts-actions.php', {
            method: 'POST',
            mode: "same-origin",
            credentials: "same-origin",
            body: formData
        })
        .then(res => res.json())
        .then(data => console.log(data))
})


const upload_image = (file) => {

    if (!['image/jpeg', 'image/png'].includes(file.type)) {
        document.getElementById('uploaded_image').innerHTML =
            '<div class="alert alert-danger">Only .jpg and .png image are allowed</div>';

        document.getElementsByName('post-image')[0].value = '';

        return false;
    }

    if (file.size > 2 * 1024 * 1024) {
        document.getElementById('uploaded_image').innerHTML =
            '<div class="alert alert-danger">File must be less than 2 MB</div>';

        document.getElementsByName('post-image')[0].value = '';

        return false;
    }

    return file;
}
</script>