<?php
session_start();

include 'header.inc';

$post_id = $_GET['post_id'] ?: false;

if ( file_exists( "/home/droppingfries/public_html/WeRam" . '/posts/posts.json' ) ) {
    $posts = file_get_contents( "/home/droppingfries/public_html/WeRam" . '/posts/posts.json' );
}

if ( $post_id ) {
    $data            = json_decode( $posts );
    $index           = array_search( $post_id, array_column( $data, 'post_id' ) );
    $post            = $data[$index];
    $post_title      = $post->title;
    $post_content    = $post->content;
    $comment_enabled = $post->comment_enabled;
    $comments        = property_exists( $post, 'comments' ) ? $post->comments : false;
    $likes           = property_exists( $post, 'likes' ) ? $post->likes : false;
    $images          = property_exists( $post, 'post_images' ) ? $post->post_images : false;

    include "/home/droppingfries/public_html/WeRam" . '/templates/post/postSingle.inc';
}

if ( $comment_enabled === true ) {
    include "/home/droppingfries/public_html/WeRam" . '/templates/post/postComment.inc';
}

include "/home/droppingfries/public_html/WeRam" . '/templates/post/postLike.inc';

include 'footer.inc';