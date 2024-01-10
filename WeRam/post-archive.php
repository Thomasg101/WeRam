<?php
session_start();

include 'header.inc';

if ( file_exists( "/home/droppingfries/public_html/WeRam" . '/posts/posts.json' ) ) {
    $posts = file_get_contents( "/home/droppingfries/public_html/WeRam" . '/posts/posts.json' );
}

$data = json_decode( $posts );

foreach ( $data as $post ) {
    $post_id         = $post->post_id;
    $post_title      = $post->title;
    $post_content    = $post->content;
    $comment_enabled = $post->comment_enabled;
    $comments        = property_exists( $post, 'comments' ) ? count( $post->comments ) : false;
    $likes           = property_exists( $post, 'likes' ) ? $post->likes : false;
    $images          = property_exists( $post, 'post_images' ) ? $post->post_images : false;
    include "/home/droppingfries/public_html/WeRam" . '/templates/post/postLoop.inc';
}

include 'footer.inc';