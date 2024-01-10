<?php
/**
 * Comment Creation
 *
 * start
 */
$contentType = isset( $_SERVER["CONTENT_TYPE"] ) ? trim( $_SERVER["CONTENT_TYPE"] ) : '';
$response;

if ( $contentType === "application/json" ) {
    //Receive the RAW post data.
    $content = trim( file_get_contents( "php://input" ) );

    $decoded = json_decode( $content, true );

    //If json_decode failed, the JSON is invalid.
    if ( !is_array( $decoded ) ) {
        $response = array(
            'success' => false,
            'data'    => array(
                'error' => 'Could not comment',
            ),
        );
        echo json_encode( $response );
        exit();
    } else {
        // Send error back to user.
        $post_obj = $decoded;
    }
}
if ( isset( $post_obj['comment-content'] ) && isset( $post_obj['post-id'] ) && isset( $post_obj['comment-name'] ) ) {
    $comment_content = $post_obj['comment-content'];
    $post_id         = $post_obj['post-id'];
    $comment_name    = $post_obj['comment-name'];
    $file            = 'posts.json';
    if ( !file_exists( $file ) ) {
        touch( $file );
    }
    $file_content    = file_get_contents( $file );
    $post            = json_decode( $file_content, true );
    $index           = array_search( $post_id, array_column( $post, 'post_id' ) );
    $last_comment_id = end( $post[$index]['comments'] )['comment_id'];
    $new_comment     = array(
        'comment_id' => ++$last_comment_id,
        'comment'    => $comment_content,
        'name'       => $comment_name,
    );
    array_push( $post[$index]['comments'], $new_comment );

    $data_encode = json_encode( $post, JSON_PRETTY_PRINT );
    file_put_contents( $file, $data_encode );

    /**
     * Template
     */
    $comment = (object) $new_comment;

    ob_start();
    include "/home/droppingfries/public_html/WeRam" . '/templates/post/comment.inc';
    $data_template = ob_get_clean();
    $response      = array(
        'success' => true,
        'data'    => array(
            'success' => 'Comment added',
            'data'    => $data_template,
        ),
    );
    echo json_encode( $response, JSON_PRETTY_PRINT );
    exit();
}

//end