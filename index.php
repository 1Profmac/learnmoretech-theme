<?php
/**
 * The main template file
 * Fallback template for posts and pages not using custom templates
 *
 * @package LearnMoreTech
 * @version 1.0.0
 */

get_header();
?>

<main id="main-content" class="site-main">
    <div class="container">
        <?php
        if (have_posts()) :
            while (have_posts()) : the_post();
                ?>
                <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                    <header class="entry-header">
                        <h1 class="entry-title"><?php the_title(); ?></h1>
                    </header>
                    
                    <div class="entry-content">
                        <?php the_content(); ?>
                    </div>
                </article>
                <?php
            endwhile;
        else :
            ?>
            <div class="no-content">
                <h2>Nothing Found</h2>
                <p>Sorry, no content was found at this location.</p>
                <a href="<?php echo home_url('/'); ?>" class="btn btn-primary">Return Home</a>
            </div>
            <?php
        endif;
        ?>
    </div>
</main>

<?php
get_footer();
