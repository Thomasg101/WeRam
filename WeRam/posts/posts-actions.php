<?php
/**
 * Post Creation
 *
 * start
 */

$post_obj = $_POST;
if ( isset( $post_obj['post-content'] ) && isset( $post_obj['user-id'] ) && isset( $post_obj['post-title'] ) ) {
    $title          = $post_obj['post-title'];
    $content        = $post_obj['post-content'];
    $user_id        = $post_obj['user-id'];
    $enable_comment = isset( $post_obj['enable-comment'] ) ? true : false;
    $file           = 'posts.json';
    if ( !file_exists( $file ) ) {
        touch( $file );
    }
    $file_content = file_get_contents( $file );
    $post         = json_decode( $file_content, true );
    //Getting last item
    $last_item_id = gettype( $post ) === 'array' ? end( $post )['post_id'] : 0;

    $image_name = post_file_uploaded();
    if ( $image_name === false ) {
        $error = array(
            'success' => false,
            'data'    => array(
                'success' => 'Image is not uploaded',
            ),
        );
        echo json_encode( $error, JSON_PRETTY_PRINT );
        exit();
    }

    $post[] = array(
        'post_id'         => ++$last_item_id,
        'user_id'         => $user_id,
        'title'           => $title,
        'content'         => $content,
        'comment_enabled' => $enable_comment,
        'comments'        => array(),
        'likes'           => 0,
        'post_images'     => array(
            array(
                'image_name' => $image_name,
                'image_url'  => 'http://142.31.53.220/~droppingfries/WeRam/posts/images/' . $image_name,
            ),
        ),
    );

    $data_encode = json_encode( $post, JSON_PRETTY_PRINT );
    file_put_contents( $file, $data_encode );
    $response = array(
        'success' => true,
        'data'    => array(
            'success' => 'Post id ' . $last_item_id . ' added',
        ),
    );
    echo json_encode( $response, JSON_PRETTY_PRINT );
    exit();
}

/**
 * File uploading
 *
 * @return string|false
 */

function post_file_uploaded()
{
    $extension = pathinfo( $_FILES['post-image']['name'], PATHINFO_EXTENSION );

    $new_name = $_FILES['post-image']['name'];

    $uploaded = move_uploaded_file( $_FILES['post-image']['tmp_name'], "/home/droppingfries/public_html/WeRam" . '/posts/images/' . $new_name );

    return ( $uploaded === true ) ? $new_name : false;

}

//end