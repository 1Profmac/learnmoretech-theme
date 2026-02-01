<?php
/**
 * Template Name: Landing Page
 * Description: V0-designed landing page with WordPress navigation, BuddyBoss and LearnDash integration
 * 
 * @package LearnMoreTech
 * @version 1.0.0
 */

// Remove admin bar on landing page for cleaner look
if (!current_user_can('administrator')) {
    show_admin_bar(false);
}
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="<?php echo get_bloginfo('description'); ?>">
    <title><?php wp_title('|', true, 'right'); bloginfo('name'); ?></title>
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Poppins:wght@600;700;800&display=swap" rel="stylesheet">
    
    <?php wp_head(); ?>
</head>
<body <?php body_class('landing-page'); ?>>

<!-- Site Header / Navigation -->
<header class="site-header">
    <div class="container">
        <!-- Site Branding -->
        <div class="site-branding">
            <?php if (has_custom_logo()) : ?>
                <?php the_custom_logo(); ?>
            <?php else : ?>
                <h1 class="site-title">
                    <a href="<?php echo home_url('/'); ?>">
                        <span class="highlight">50+</span> TechBridge
                    </a>
                </h1>
            <?php endif; ?>
        </div>
        
        <!-- Primary Navigation -->
        <nav class="main-navigation" role="navigation" aria-label="Primary Navigation">
            <ul>
                <li><a href="<?php echo home_url('/'); ?>">Home</a></li>
                <li><a href="<?php echo home_url('/about'); ?>">About</a></li>
                <li><a href="<?php echo home_url('/how-it-works'); ?>">How It Works</a></li>
                
                <?php if (is_user_logged_in()) : ?>
                    <!-- Logged In User Links -->
                    <?php if (function_exists('bp_is_active')) : ?>
                        <li><a href="<?php echo bp_get_activity_directory_permalink(); ?>">Community</a></li>
                        <li><a href="<?php echo bp_get_groups_directory_permalink(); ?>">Groups</a></li>
                    <?php endif; ?>
                    
                    <?php if (function_exists('learndash_user_get_enrolled_courses')) : ?>
                        <li><a href="<?php echo get_post_type_archive_link('sfwd-courses'); ?>">Courses</a></li>
                    <?php endif; ?>
                <?php endif; ?>
            </ul>
        </nav>
        
        <!-- Header Actions -->
        <div class="header-actions">
            <?php if (is_user_logged_in()) : ?>
                <?php 
                // Use BuddyPress profile URL if available, otherwise WordPress admin
                $dashboard_url = function_exists('bp_loggedin_user_domain') 
                    ? bp_loggedin_user_domain() 
                    : admin_url('profile.php');
                ?>
                <a href="<?php echo esc_url($dashboard_url); ?>" class="btn btn-outline">Dashboard</a>
                <a href="<?php echo wp_logout_url(home_url()); ?>" class="btn btn-outline">Logout</a>
            <?php else : ?>
                <a href="<?php echo wp_login_url(); ?>" class="btn btn-outline">Login</a>
                <a href="<?php echo wp_registration_url(); ?>" class="btn btn-primary">Join Beta</a>
            <?php endif; ?>
            
            <!-- Mobile Menu Toggle -->
            <button class="menu-toggle" aria-label="Toggle Menu" aria-expanded="false" id="mobile-menu-toggle">
                <span></span>
                <span></span>
                <span></span>
            </button>
        </div>
    </div>
</header>

<!-- Mobile Navigation -->
<nav class="mobile-navigation" id="mobile-menu" aria-label="Mobile Navigation">
    <ul>
        <li><a href="<?php echo home_url('/'); ?>">Home</a></li>
        <li><a href="<?php echo home_url('/about'); ?>">About</a></li>
        <li><a href="<?php echo home_url('/how-it-works'); ?>">How It Works</a></li>
        
        <?php if (is_user_logged_in()) : ?>
            <?php if (function_exists('bp_is_active')) : ?>
                <li><a href="<?php echo bp_get_activity_directory_permalink(); ?>">Community</a></li>
                <li><a href="<?php echo bp_get_groups_directory_permalink(); ?>">Groups</a></li>
            <?php endif; ?>
            
            <?php if (function_exists('learndash_user_get_enrolled_courses')) : ?>
                <li><a href="<?php echo get_post_type_archive_link('sfwd-courses'); ?>">Courses</a></li>
            <?php endif; ?>
            
            <?php 
            // Use BuddyPress profile URL if available, otherwise WordPress admin
            $dashboard_url = function_exists('bp_loggedin_user_domain') 
                ? bp_loggedin_user_domain() 
                : admin_url('profile.php');
            ?>
            <li><a href="<?php echo esc_url($dashboard_url); ?>">Dashboard</a></li>
            <li><a href="<?php echo wp_logout_url(home_url()); ?>">Logout</a></li>
        <?php else : ?>
            <li><a href="<?php echo wp_login_url(); ?>">Login</a></li>
            <li><a href="<?php echo wp_registration_url(); ?>">Join Beta</a></li>
        <?php endif; ?>
    </ul>
</nav>

<!-- Main Content -->
<main id="main-content">
    
    <!-- Hero Section -->
    <section class="hero-section" id="hero">
        <div class="container">
            <div class="hero-content">
                <div>
                    <span class="hero-badge">
                        Beta Now Open
                    </span>
                    
                    <h1 class="hero-title">
                        You're Not <span class="highlight">Over the Hill</span>. You're Just Getting Started.
                    </h1>
                    
                    <p class="hero-subtitle">
                        Master technology skills that matter. Build independence. Earn income. Teach others.
                    </p>
                    
                    <p class="hero-description">
                        Join 50+ adults who are using technology to reclaim their independence, stay relevant, and create new income streams—without the patronizing "tech for seniors" nonsense.
                    </p>
                    
                    <div class="hero-cta">
                        <a href="#waitlist" class="btn btn-primary btn-lg">Join the Beta Waitlist</a>
                        <a href="#how-it-works" class="btn btn-outline btn-lg">How It Works</a>
                    </div>
                    
                    <div class="hero-trust-indicators">
                        <span>
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                            No Credit Card Required
                        </span>
                        <span>
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                            Free Foundation Course
                        </span>
                        <span>
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                            247+ on Waitlist
                        </span>
                    </div>
                </div>
                
                <div class="hero-image-container">
                    <img src="<?php echo get_template_directory_uri(); ?>/landing-page/images/hero-image.jpg" alt="50+ Adults Learning Technology" class="hero-image">
                    
                    <div class="hero-stats-overlay">
                        <div class="hero-stats">
                            <div>
                                <div class="stat-value">50+</div>
                                <div class="stat-label">Age Range</div>
                            </div>
                            <div>
                                <div class="stat-value">100%</div>
                                <div class="stat-label">Peer Learning</div>
                            </div>
                            <div>
                                <div class="stat-value">$850B</div>
                                <div class="stat-label">Cost of Ageism</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <!-- Problem Section -->
    <section class="section section-muted" id="problem">
        <div class="container">
            <div class="section-header">
                <h2 class="section-title">The Real Problem Isn't Technology. It's <span class="highlight">Exclusion</span>.</h2>
                <p class="section-subtitle">
                    You've lived 50+ years. Built careers, raised families, contributed to communities. But somewhere along the way, society decided you were "over the hill."
                </p>
            </div>
            
            <div class="three-col-grid">
                <div class="card">
                    <div class="card-content">
                        <h3>Dependence on Others</h3>
                        <p>Without digital skills, you're dependent on others for banking, healthcare, communication—undermining your dignity and autonomy.</p>
                    </div>
                </div>
                
                <div class="card">
                    <div class="card-content">
                        <h3>Lost Income Opportunities</h3>
                        <p>Age discrimination shuts you out of traditional employment. But freelancing, consulting, and online work require technology skills.</p>
                    </div>
                </div>
                
                <div class="card">
                    <div class="card-content">
                        <h3>Feeling Irrelevant</h3>
                        <p>Your experience and wisdom matter. But without digital fluency, you're cut off from conversations, culture, and contribution.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <!-- Solution Section -->
    <section class="section" id="how-it-works">
        <div class="container">
            <div class="section-header">
                <h2 class="section-title">What If You Could <span class="highlight">Fight Back</span>?</h2>
                <p class="section-subtitle">
                    50+ TechBridge isn't another boring tech class. It's a community of people like you who are learning to use technology for independence—not just checking email, but building online businesses, creating income streams, and teaching others what you know.
                </p>
            </div>
            
            <div class="three-col-grid">
                <div class="card">
                    <div class="card-content">
                        <h3>1. Start Free</h3>
                        <p>Access our Foundation Digital Skills course—short video lessons on the technology tools that matter for independent living.</p>
                    </div>
                </div>
                
                <div class="card">
                    <div class="card-content">
                        <h3>2. Join the Community</h3>
                        <p>Attend live 1-hour sessions in your area (or online) where you'll learn alongside peers and get hands-on help.</p>
                    </div>
                </div>
                
                <div class="card">
                    <div class="card-content">
                        <h3>3. Pay It Forward</h3>
                        <p>Once you've mastered the skills, you can teach others—and earn income doing it.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <!-- Founder Story Section -->
    <section class="section section-muted" id="founder-story">
        <div class="container">
            <div class="two-col-grid">
                <div>
                    <h2>Why I Built This</h2>
                    <p>I'm the founder of 50+ TechBridge. I taught my 93-year-old uncle to use YouTube and my 92-year-old veteran father to use technology to maintain his independence after a heart attack. Then I lost my job because I had to take care of him.</p>
                    
                    <p>That's when I realized: the real crisis isn't healthcare. It's the hidden cost of dependence. 50+ TechBridge exists because I refuse to accept that "over the hill" is real.</p>
                    
                    <p><strong>You have decades of experience, wisdom, and contribution left. Let's make sure the world knows it.</strong></p>
                </div>
                
                <div>
                    <img src="<?php echo get_template_directory_uri(); ?>/landing-page/images/founder.jpg" alt="Founder" class="rounded-xl shadow-xl">
                </div>
            </div>
        </div>
    </section>
    
    <!-- Waitlist Form Section -->
    <section class="section section-primary" id="waitlist">
        <div class="container">
            <div class="section-header">
                <h2 class="section-title">Be Part of Something Bigger</h2>
                <p class="section-subtitle">
                    We're launching our beta program soon. Spots are limited because we're testing our model with a small group first. Join the waitlist to be among the first to access free courses, live sessions, and the opportunity to shape what 50+ TechBridge becomes.
                </p>
            </div>
            
            <div class="form-container">
                <?php
                // Show success/error messages
                if (isset($_GET['waitlist'])) {
                    if ($_GET['waitlist'] == 'success') {
                        echo '<div class="alert alert-success">Success! You\'re on the waitlist. Check your email for next steps.</div>';
                    } elseif ($_GET['waitlist'] == 'error') {
                        echo '<div class="alert alert-error">Something went wrong. Please try again.</div>';
                    } elseif ($_GET['waitlist'] == 'invalid_email') {
                        echo '<div class="alert alert-error">Please enter a valid email address.</div>';
                    }
                }
                ?>
                
                <form method="post" action="" class="waitlist-form">
                    <?php wp_nonce_field('waitlist_form_action', 'waitlist_nonce'); ?>
                    
                    <div class="form-row">
                        <div class="form-group">
                            <label for="name">First Name *</label>
                            <input type="text" id="name" name="name" required class="form-input">
                        </div>
                        
                        <div class="form-group">
                            <label for="email">Email Address *</label>
                            <input type="email" id="email" name="email" required class="form-input">
                        </div>
                    </div>
                    
                    <div class="form-row">
                        <div class="form-group">
                            <label for="age_range">Age Range</label>
                            <select id="age_range" name="age_range" class="form-input">
                                <option value="">Select...</option>
                                <option value="50-59">50-59</option>
                                <option value="60-69">60-69</option>
                                <option value="70-79">70-79</option>
                                <option value="80+">80+</option>
                            </select>
                        </div>
                        
                        <div class="form-group">
                            <label for="source">How did you hear about us?</label>
                            <select id="source" name="source" class="form-input">
                                <option value="">Select...</option>
                                <option value="facebook">Facebook</option>
                                <option value="linkedin">LinkedIn</option>
                                <option value="friend">Friend/Family</option>
                                <option value="search">Google Search</option>
                                <option value="other">Other</option>
                            </select>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="challenge">What's your biggest technology challenge? (Optional)</label>
                        <textarea id="challenge" name="challenge" rows="3" class="form-input"></textarea>
                    </div>
                    
                    <button type="submit" name="waitlist_submit" class="btn btn-secondary btn-lg">Reserve My Spot</button>
                </form>
            </div>
        </div>
    </section>
    
</main>

<!-- Site Footer -->
<footer class="site-footer">
    <div class="container">
        <div class="footer-grid">
            <div class="footer-brand">
                <h3 class="site-title"><span class="highlight">50+</span> TechBridge</h3>
                <p>Fighting ageism through technology education. Empowering 50+ adults to reclaim independence, earn income, and teach others.</p>
            </div>
            
            <div class="footer-nav">
                <h4>Program</h4>
                <ul>
                    <li><a href="<?php echo home_url('/how-it-works'); ?>">How It Works</a></li>
                    <li><a href="<?php echo home_url('/curriculum'); ?>">Curriculum</a></li>
                    <li><a href="<?php echo home_url('/community'); ?>">Community</a></li>
                    <li><a href="<?php echo home_url('/testimonials'); ?>">Success Stories</a></li>
                </ul>
            </div>
            
            <div class="footer-nav">
                <h4>Company</h4>
                <ul>
                    <li><a href="<?php echo home_url('/about'); ?>">About Us</a></li>
                    <li><a href="<?php echo home_url('/blog'); ?>">Blog</a></li>
                    <li><a href="<?php echo home_url('/contact'); ?>">Contact</a></li>
                    <li><a href="<?php echo home_url('/careers'); ?>">Careers</a></li>
                </ul>
            </div>
            
            <div class="footer-nav">
                <h4>Legal</h4>
                <ul>
                    <li><a href="<?php echo home_url('/privacy-policy'); ?>">Privacy Policy</a></li>
                    <li><a href="<?php echo home_url('/terms'); ?>">Terms of Service</a></li>
                    <li><a href="<?php echo home_url('/accessibility'); ?>">Accessibility</a></li>
                </ul>
            </div>
        </div>
        
        <div class="footer-bottom">
            <p>&copy; <?php echo date('Y'); ?> <?php bloginfo('name'); ?>. All rights reserved.</p>
            
            <div class="footer-social">
                <a href="https://facebook.com" aria-label="Facebook">
                    <svg fill="currentColor" viewBox="0 0 24 24" width="20" height="20"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                </a>
                <a href="https://linkedin.com" aria-label="LinkedIn">
                    <svg fill="currentColor" viewBox="0 0 24 24" width="20" height="20"><path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/></svg>
                </a>
            </div>
        </div>
    </div>
</footer>

<?php wp_footer(); ?>
</body>
</html>
