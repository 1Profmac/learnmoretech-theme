# LearnMoreTech WordPress Theme

A custom WordPress theme for LearnMoreTech SaaS landing page with BuddyBoss and LearnDash integration.

## Features

- ✅ V0-designed landing page with modern, responsive layout
- ✅ WordPress navigation system with mobile menu
- ✅ BuddyBoss community integration
- ✅ LearnDash course management support
- ✅ Waitlist form with database storage
- ✅ Conditional navigation (logged in/out states)
- ✅ Smooth scrolling and animations
- ✅ SEO optimized
- ✅ Mobile-first responsive design

## Requirements

- WordPress 6.0 or higher
- PHP 7.4 or higher
- BuddyBoss Platform (optional, for community features)
- LearnDash LMS (optional, for course features)

## Installation

### Method 1: Upload ZIP (Recommended for you)

1. **Zip the theme folder:**
   ```bash
   cd /path/to/learnmoretech-theme
   zip -r learnmoretech-theme.zip . -x "*.git*" "*.DS_Store"
   ```

2. **Upload to WordPress:**
   - Go to WordPress Admin → Appearance → Themes
   - Click "Add New" → "Upload Theme"
   - Choose `learnmoretech-theme.zip`
   - Click "Install Now"
   - Click "Activate"

### Method 2: FTP/SSH Upload

1. **Upload via FTP/SSH:**
   ```bash
   scp -r learnmoretech-theme user@yourserver.com:/path/to/wordpress/wp-content/themes/
   ```

2. **Set permissions:**
   ```bash
   ssh user@yourserver.com
   cd /path/to/wordpress/wp-content/themes/
   chmod -R 755 learnmoretech-theme
   ```

3. **Activate via WordPress Admin:**
   - Go to Appearance → Themes
   - Find "LearnMoreTech"
   - Click "Activate"

### Method 3: Git Deploy

1. **SSH into server:**
   ```bash
   ssh user@yourserver.com
   cd /var/www/html/wp-content/themes/
   ```

2. **Clone repository:**
   ```bash
   git clone https://github.com/yourusername/learnmoretech-theme.git
   ```

3. **Activate via WP-CLI:**
   ```bash
   wp theme activate learnmoretech-theme
   ```

## Post-Installation Setup

### 1. Create Landing Page

**Via WordPress Admin:**
1. Go to Pages → Add New
2. Title: "Home"
3. Template: Select "Landing Page" from Page Attributes
4. Publish

**Via WP-CLI:**
```bash
wp post create --post_type=page --post_title='Home' --post_status=publish --page_template=page-landing.php
```

### 2. Set as Homepage

**Via WordPress Admin:**
1. Go to Settings → Reading
2. Set "Your homepage displays" to "A static page"
3. Choose "Home" for Homepage
4. Save Changes

**Via WP-CLI:**
```bash
wp option update show_on_front page
wp option update page_on_front $(wp post list --post_type=page --post_title='Home' --format=ids)
```

### 3. Create Navigation Menu

**Via WordPress Admin:**
1. Go to Appearance → Menus
2. Create new menu: "Primary Menu"
3. Add pages:
   - Home
   - About
   - How It Works
   - Contact
4. Add custom links:
   - Community (/members) - for BuddyBoss
   - Courses (/courses) - for LearnDash
   - Login (/login)
   - Join Beta (/register) - add CSS class `menu-cta`
5. Assign to "Primary Menu" location
6. Save Menu

**Via WP-CLI:**
```bash
# Create menu
wp menu create "Primary Menu"

# Add pages
wp menu item add-post primary-menu $(wp post list --post_type=page --post_title='Home' --format=ids) --title="Home"
wp menu item add-post primary-menu $(wp post list --post_type=page --post_title='About' --format=ids) --title="About"

# Add custom links
wp menu item add-custom primary-menu "Community" /members
wp menu item add-custom primary-menu "Courses" /courses
wp menu item add-custom primary-menu "Login" /login
wp menu item add-custom primary-menu "Join Beta" /register --classes=menu-cta

# Assign to location
wp menu location assign primary-menu primary
```

### 4. Add Images

Replace placeholder images with actual photos:

```bash
# Upload to:
/wp-content/themes/learnmoretech-theme/landing-page/images/

Required images:
- hero-image.jpg (1200x800px) - Active 50+ adults learning
- founder.jpg (800x800px) - Founder photo
- logo.png (optional) - Your logo
```

### 5. Set Up Logo (Optional)

1. Go to Appearance → Customize
2. Click "Site Identity"
3. Click "Select Logo"
4. Upload your logo image
5. Publish

## Customization

### Change Colors

Edit `/landing-page/styles/main.css`:

```css
:root {
  --color-primary: #F97316;        /* Main brand color */
  --color-secondary: #14B8A6;      /* Secondary color */
  --color-foreground: #1F2937;     /* Text color */
}
```

### Modify Waitlist Form

Edit `page-landing.php` line ~250 to customize form fields.

### Add/Remove Sections

Edit `page-landing.php` to add or remove sections:
- Hero Section (line ~100)
- Problem Section (line ~180)
- Solution Section (line ~220)
- Founder Story (line ~260)
- Waitlist Form (line ~290)

## BuddyBoss Integration

The theme automatically detects BuddyBoss and adds:
- Community link in navigation
- Activity feed link
- Groups directory link
- User profile menu

### BuddyBoss-specific URLs:
- `/activity/` - Activity Stream
- `/members/` - Members Directory
- `/groups/` - Groups Directory
- `/members/username/` - User Profile

## LearnDash Integration

The theme automatically detects LearnDash and adds:
- Courses link in navigation
- User dashboard link

### LearnDash-specific URLs:
- `/courses/` - Course Archive
- `/lessons/` - Lessons
- `/topic/` - Topics

## Waitlist Management

### View Waitlist Entries

**Database Table:** `wp_learnmoretech_waitlist`

**Via phpMyAdmin:**
```sql
SELECT * FROM wp_learnmoretech_waitlist ORDER BY signup_date DESC;
```

**Via WP-CLI:**
```bash
wp db query "SELECT name, email, age_range, signup_date FROM wp_learnmoretech_waitlist ORDER BY signup_date DESC LIMIT 20"
```

### Export Waitlist to CSV

```bash
wp db export --tables=wp_learnmoretech_waitlist --format=csv > waitlist-export.csv
```

## Troubleshooting

### Navigation Links Not Working

Make sure links use `home_url()`:
```php
<!-- Correct -->
<a href="<?php echo home_url('/about'); ?>">About</a>

<!-- Wrong -->
<a href="/about">About</a>
```

### Styles Not Loading

1. Clear WordPress cache
2. Hard refresh browser (Cmd+Shift+R or Ctrl+Shift+R)
3. Check file permissions: `chmod -R 755 learnmoretech-theme`

### Mobile Menu Not Working

Check that JavaScript is loading:
1. View page source
2. Look for `main.js` in footer
3. Check browser console for errors

### Form Not Submitting

1. Check nonce validation in `functions.php`
2. Verify database table exists
3. Check server error logs
4. Test with debugging enabled

## Support

For issues or questions:
- Email: support@learnmoretechnologies.com
- Documentation: https://learnmoretechnologies.com/docs
- GitHub: https://github.com/yourusername/learnmoretech-theme

## License

GNU General Public License v2 or later

## Credits

- Design: V0 by Vercel
- Development: LearnMoreTech Team
- Fonts: Inter & Poppins (Google Fonts)
- Icons: Custom SVG icons

## Changelog

### Version 1.0.0 (2026-01-29)
- Initial release
- V0 landing page integration
- BuddyBoss support
- LearnDash support
- Waitlist form functionality
- Mobile responsive navigation
