<div class="loop-post">
    <div class="image-container">
        <?php
if ( gettype( $images ) === 'array' ) {
    ?>
        <img src="<?php echo $images[0]->image_url; ?>" alt="" srcset="">
        <?php
/**
     * For Future Purposes
     */
// $i = get_featured_image($images);
    // $src = $images[$i];
    //<img src="{{ $src}}" alt="" srcset="">
}
?>
    </div>
    <div class="post-title">
        <a
            href="<?php echo 'http://142.31.53.220/~droppingfries/WeRam/post-single.php?post_id=' . $post_id ?>">
            <h2><?php echo $post_title; ?></h2>
        </a>
    </div>
    <div class="post-content">
        <p class="content"><?php echo substr( $post_content, 3 ) . '...'; ?></p>
    </div>
    <div class="likes"><?php echo $likes; ?>&nbsp;Likes</div>
    <div class="comments"><?php echo $comments; ?>&nbsp;Comments</div>
</div>

<?php
/**
 * For future purposes
 */
// function get_featured_image( array $images )
// {
//     $index = array_search( true, array_column( $images, 'featured' ) );
//     return $index;
// }

?>