<?php
	get_header();
?>

<?php
	echo '<div class="container main no-pagebuilder">';
    echo '<div class="mainInner">';
        
        while ( have_posts() ) :
            the_post();
            the_content();
        endwhile; // End of the loop.
    
    echo do_shortcode('[vc_pageheader title="AMAN KHANAKIA"]');
    echo '</div>';
    echo '</div>';


// $scb = new ScrollBack();
$scb = new \Knesk\App\Comp\Scrollback\Main();
echo $scb->render();
?>

<?php get_footer(); ?>