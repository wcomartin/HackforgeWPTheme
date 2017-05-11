<?php get_header('home'); ?>

<?php if ( is_home() && ! is_front_page() ) : ?>
<header class="page-header">
<h1 class="page-title"><?php single_post_title(); ?></h1>
</header>
<?php endif;
if ( have_posts() ) :

    /* Start the Loop */
    while ( have_posts() ) : the_post();
        echo '<article class="post" id="post-' . get_the_ID() . '">';
        edit_post_link('edit', '<p class="pull-right">', '</p>'); ?>

        <h2><a href="<?php the_permalink(); ?>"><?php the_title() ?></a></h2>

        <?php if (is_singular('post') || is_home()):
            the_date('F j, Y', '<p class="lead pull-right">', '</p>');
            $output = '<p class="lead">by <a href="' . get_the_author_link() . '">' . get_the_author() . '</a> in ';
            $categories = get_the_category();
            $separator = ', ';
            $category_string = '';
            if ( ! empty( $categories ) ) {
                foreach( $categories as $category ) {
                    $category_string .= '<a href="' . esc_url( get_category_link( $category->term_id ) ) . '">'
                        . esc_html( $category->name ) . '</a>' . $separator;
                }
                $output .= trim( $category_string, $separator );
            }
            $output .= '</p>';
            echo $output;
        endif;
        the_content();

        echo '</article><hr class="separator" />';
    endwhile;

    the_posts_pagination( array(
        'prev_text' => '<span class="fa fa-arrow-left"></span>' . '<span class="screen-reader-text">Previous page</span>',
        'next_text' => '<span class="screen-reader-text">Next page</span>' . '<span class="fa fa-arrow-right"></span>',
        'before_page_number' => '<span class="meta-nav screen-reader-text">Page </span>',
    ) );
else :
    get_template_part( 'template-parts/post/content', 'none' );
endif; ?>



<?php get_footer('home'); ?>