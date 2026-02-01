<?php
/**
 * LearnMoreTech Theme Functions
 * 
 * @package LearnMoreTech
 * @version 1.0.0
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

/**
 * Theme Setup
 */
function learnmoretech_setup() {
    // Add theme support features
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('custom-logo', array(
        'height' => 60,
        'width' => 200,
        'flex-height' => true,
        'flex-width' => true,
    ));
    add_theme_support('html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
        'style',
        'script',
    ));
    
    // BuddyBoss Theme Support
    add_theme_support('buddypress');
    add_theme_support('buddyboss-theme');
    
    // LearnDash Theme Support
    add_theme_support('learndash');
    
    // Register Navigation Menus
    register_nav_menus(array(
        'primary' => __('Primary Menu', 'learnmoretech'),
        'footer' => __('Footer Menu', 'learnmoretech'),
        'mobile' => __('Mobile Menu', 'learnmoretech'),
    ));
    
    // Add editor styles
    add_editor_style();
}
add_action('after_setup_theme', 'learnmoretech_setup');

/**
 * Enqueue Scripts and Styles
 */
function learnmoretech_enqueue_assets() {
    $theme_version = wp_get_theme()->get('Version');
    
    // Only enqueue landing page assets on landing page template
    if (is_page_template('page-landing.php')) {
        
        // Dequeue conflicting BuddyBoss/LearnDash styles on landing page
        wp_dequeue_style('buddyboss-theme-css');
        wp_dequeue_style('bp-nouveau');
        wp_dequeue_style('bp-legacy-css');
        wp_dequeue_style('learndash-front');
        
        // Enqueue landing page CSS
        wp_enqueue_style(
            'learnmoretech-landing-styles',
            get_template_directory_uri() . '/landing-page/styles/main.css',
            array(),
            $theme_version
        );
        
        // Enqueue landing page JavaScript
        wp_enqueue_script(
            'learnmoretech-landing-scripts',
            get_template_directory_uri() . '/landing-page/scripts/main.js',
            array(),
            $theme_version,
            true
        );
        
    } else {
        // Default theme styles for other pages
        wp_enqueue_style(
            'learnmoretech-style',
            get_stylesheet_uri(),
            array(),
            $theme_version
        );
    }
    
    // Google Fonts - V0 Design (Poppins + Inter)
    wp_enqueue_style(
        'learnmoretech-fonts',
        'https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Poppins:wght@500;600;700;800&display=swap',
        array(),
        null
    );
}
add_action('wp_enqueue_scripts', 'learnmoretech_enqueue_assets', 999);

/**
 * Custom Body Classes
 */
function learnmoretech_body_classes($classes) {
    if (is_page_template('page-landing.php')) {
        $classes[] = 'landing-page-template';
        $classes[] = 'v0-design';
    }
    
    if (is_user_logged_in()) {
        $classes[] = 'user-logged-in';
    }
    
    return $classes;
}
add_filter('body_class', 'learnmoretech_body_classes');

/**
 * Handle Waitlist Form Submission
 */
function learnmoretech_handle_waitlist_form() {
    // Check if form was submitted
    if (!isset($_POST['waitlist_submit'])) {
        return;
    }
    
    // Verify nonce
    if (!isset($_POST['waitlist_nonce']) || !wp_verify_nonce($_POST['waitlist_nonce'], 'waitlist_form_action')) {
        wp_die('Security check failed. Please try again.');
    }
    
    // Sanitize and validate form data
    $name = isset($_POST['name']) ? sanitize_text_field($_POST['name']) : '';
    $email = isset($_POST['email']) ? sanitize_email($_POST['email']) : '';
    $age_range = isset($_POST['age_range']) ? sanitize_text_field($_POST['age_range']) : '';
    $challenge = isset($_POST['challenge']) ? sanitize_textarea_field($_POST['challenge']) : '';
    $source = isset($_POST['source']) ? sanitize_text_field($_POST['source']) : '';
    
    // Validate required fields
    if (empty($name) || empty($email)) {
        wp_redirect(add_query_arg('waitlist', 'error', home_url('/')));
        exit;
    }
    
    if (!is_email($email)) {
        wp_redirect(add_query_arg('waitlist', 'invalid_email', home_url('/')));
        exit;
    }
    
    // Save to database (create custom table or use options/post meta)
    global $wpdb;
    $table_name = $wpdb->prefix . 'learnmoretech_waitlist';
    
    $wpdb->insert(
        $table_name,
        array(
            'name' => $name,
            'email' => $email,
            'age_range' => $age_range,
            'challenge' => $challenge,
            'source' => $source,
            'signup_date' => current_time('mysql'),
            'ip_address' => $_SERVER['REMOTE_ADDR'],
        ),
        array('%s', '%s', '%s', '%s', '%s', '%s', '%s')
    );
    
    // Send notification email to admin
    $admin_email = get_option('admin_email');
    $subject = 'New Beta Waitlist Signup - ' . $name;
    $message = "New waitlist signup:\n\n";
    $message .= "Name: " . $name . "\n";
    $message .= "Email: " . $email . "\n";
    $message .= "Age Range: " . $age_range . "\n";
    $message .= "Challenge: " . $challenge . "\n";
    $message .= "Source: " . $source . "\n";
    $message .= "Date: " . current_time('F j, Y g:i a') . "\n";
    
    wp_mail($admin_email, $subject, $message);
    
    // TODO: Send to MailerLite API
    // learnmoretech_send_to_mailerlite($name, $email, $age_range, $challenge, $source);
    
    // Redirect with success message
    wp_redirect(add_query_arg('waitlist', 'success', home_url('/')));
    exit;
}
add_action('init', 'learnmoretech_handle_waitlist_form');

/**
 * Create waitlist database table on theme activation
 */
function learnmoretech_create_waitlist_table() {
    global $wpdb;
    $table_name = $wpdb->prefix . 'learnmoretech_waitlist';
    $charset_collate = $wpdb->get_charset_collate();
    
    $sql = "CREATE TABLE IF NOT EXISTS $table_name (
        id mediumint(9) NOT NULL AUTO_INCREMENT,
        name varchar(255) NOT NULL,
        email varchar(255) NOT NULL,
        age_range varchar(50) DEFAULT '',
        challenge text DEFAULT '',
        source varchar(255) DEFAULT '',
        signup_date datetime DEFAULT CURRENT_TIMESTAMP,
        ip_address varchar(100) DEFAULT '',
        PRIMARY KEY  (id),
        UNIQUE KEY email (email)
    ) $charset_collate;";
    
    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
    dbDelta($sql);
}
add_action('after_switch_theme', 'learnmoretech_create_waitlist_table');

/**
 * Custom Navigation Walker (optional - for advanced menu styling)
 */
class LearnMoreTech_Walker_Nav_Menu extends Walker_Nav_Menu {
    function start_el(&$output, $item, $depth = 0, $args = null, $id = 0) {
        $classes = empty($item->classes) ? array() : (array) $item->classes;
        
        // Add CTA button class
        if (in_array('menu-item-cta', $classes) || in_array('cta-button', $classes)) {
            $classes[] = 'nav-cta-item';
        }
        
        $class_names = join(' ', apply_filters('nav_menu_css_class', array_filter($classes), $item, $args, $depth));
        $class_names = $class_names ? ' class="' . esc_attr($class_names) . '"' : '';
        
        $output .= '<li' . $class_names . '>';
        
        $atts = array();
        $atts['href'] = !empty($item->url) ? $item->url : '';
        $atts['title'] = !empty($item->attr_title) ? $item->attr_title : '';
        $atts['target'] = !empty($item->target) ? $item->target : '';
        $atts['rel'] = !empty($item->xfn) ? $item->xfn : '';
        
        $attributes = '';
        foreach ($atts as $attr => $value) {
            if (!empty($value)) {
                $attributes .= ' ' . $attr . '="' . esc_attr($value) . '"';
            }
        }
        
        $item_output = $args->before;
        $item_output .= '<a' . $attributes . '>';
        $item_output .= $args->link_before . apply_filters('the_title', $item->title, $item->ID) . $args->link_after;
        $item_output .= '</a>';
        $item_output .= $args->after;
        
        $output .= apply_filters('walker_nav_menu_start_el', $item_output, $item, $depth, $args);
    }
}

/**
 * Customize Login Page Logo
 */
function learnmoretech_login_logo() {
    if (has_custom_logo()) {
        $custom_logo_id = get_theme_mod('custom_logo');
        $logo = wp_get_attachment_image_src($custom_logo_id, 'full');
        ?>
        <style type="text/css">
            #login h1 a, .login h1 a {
                background-image: url(<?php echo esc_url($logo[0]); ?>);
                height: 80px;
                width: 320px;
                background-size: contain;
                background-repeat: no-repeat;
                padding-bottom: 30px;
            }
        </style>
        <?php
    }
}
add_action('login_enqueue_scripts', 'learnmoretech_login_logo');

/**
 * Customize Login Logo URL
 */
function learnmoretech_login_logo_url() {
    return home_url();
}
add_filter('login_headerurl', 'learnmoretech_login_logo_url');

/**
 * Customize Login Logo Title
 */
function learnmoretech_login_logo_url_title() {
    return get_bloginfo('name');
}
add_filter('login_headertext', 'learnmoretech_login_logo_url_title');

/**
 * Remove Admin Bar for Non-Admins on Landing Page
 */
function learnmoretech_remove_admin_bar() {
    if (is_page_template('page-landing.php') && !current_user_can('administrator')) {
        show_admin_bar(false);
    }
}
add_action('after_setup_theme', 'learnmoretech_remove_admin_bar');

/**
 * Add custom image sizes
 */
function learnmoretech_image_sizes() {
    add_image_size('hero-image', 1920, 1080, true);
    add_image_size('card-thumbnail', 600, 400, true);
}
add_action('after_setup_theme', 'learnmoretech_image_sizes');

/**
 * Security: Remove WordPress version from header
 */
remove_action('wp_head', 'wp_generator');

/**
 * Excerpt length
 */
function learnmoretech_excerpt_length($length) {
    return 30;
}
add_filter('excerpt_length', 'learnmoretech_excerpt_length', 999);

/**
 * Excerpt more
 */
function learnmoretech_excerpt_more($more) {
    return '...';
}
add_filter('excerpt_more', 'learnmoretech_excerpt_more');
