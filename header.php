<?php
/**
 * The header for non-landing pages
 * Used by BuddyBoss and LearnDash pages
 *
 * @package LearnMoreTech
 * @version 1.0.0
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<div id="page" class="site">
    <header class="site-header">
        <div class="container">
            <div class="header-container">
                <!-- Site Branding -->
                <div class="site-branding">
                    <?php if (has_custom_logo()) : ?>
                        <?php the_custom_logo(); ?>
                    <?php else : ?>
                        <h1 class="site-title">
                            <a href="<?php echo home_url('/'); ?>">
                                <?php bloginfo('name'); ?>
                            </a>
                        </h1>
                    <?php endif; ?>
                </div>
                
                <!-- Primary Navigation -->
                <nav class="site-navigation" role="navigation">
                    <?php
                    if (has_nav_menu('primary')) {
                        wp_nav_menu(array(
                            'theme_location' => 'primary',
                            'container' => false,
                            'menu_class' => 'nav-menu',
                            'walker' => new LearnMoreTech_Walker_Nav_Menu(),
                        ));
                    } else {
                        ?>
                        <ul class="nav-menu">
                            <li><a href="<?php echo home_url('/'); ?>">Home</a></li>
                            <li><a href="<?php echo home_url('/about'); ?>">About</a></li>
                            <?php if (is_user_logged_in()) : ?>
                                <li><a href="<?php echo home_url('/courses'); ?>">Courses</a></li>
                                <li><a href="<?php echo home_url('/members'); ?>">Community</a></li>
                            <?php endif; ?>
                        </ul>
                        <?php
                    }
                    ?>
                </nav>
            </div>
        </div>
    </header>
