<?php
/**
 * Like Creation
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

if ( isset( $post_obj['post_id'] ) ) {
    $post_id = $post_obj['post_id'];
    $file    = 'posts.json';
    if ( !file_exists( $file ) ) {
        touch( $file );
    }
    $file_content = file_get_contents( $file );
    $post         = json_decode( $file_content, true );
    $index        = array_search( $post_id, array_column( $post, 'post_id' ) );
    ( $post_obj['action'] === 'like' ) ? ++$post[$index]['likes'] : --$post[$index]['likes'];
    $data_encode = json_encode( $post, JSON_PRETTY_PRINT );
    file_put_contents( $file, $data_encode );

    $response = array(
        'success' => true,
        'data'    => array(
            'success' => 'Like',
            'data'    => $post[$index]['likes'],
        ),
    );
    echo json_encode( $response, JSON_PRETTY_PRINT );
    exit();
}