# QUICK START GUIDE

## 🚀 Deploy Your Theme in 10 Minutes

### Step 1: Zip the Theme (2 minutes)

```bash
cd learnmoretech-theme
zip -r ../learnmoretech-theme.zip . -x "*.git*" "*.DS_Store" "node_modules/*"
```

The zip file will be in the parent directory.

### Step 2: Upload to WordPress (3 minutes)

1. Log in to WordPress Admin
2. Go to **Appearance → Themes**
3. Click **Add New** → **Upload Theme**
4. Choose `learnmoretech-theme.zip`
5. Click **Install Now**
6. Click **Activate**

✅ Theme is now active!

### Step 3: Create Landing Page (2 minutes)

1. Go to **Pages → Add New**
2. Title: **Home**
3. **Page Attributes** → Template: **Landing Page**
4. Click **Publish**

### Step 4: Set as Homepage (1 minute)

1. Go to **Settings → Reading**
2. Select **A static page**
3. Homepage: **Home**
4. Click **Save Changes**

### Step 5: Create Menu (2 minutes)

1. Go to **Appearance → Menus**
2. Create menu: **Primary Menu**
3. Add items:
   - Home page
   - About page (create if needed)
   - Custom Link: "Join Beta" → `/register`
4. Assign to **Primary Menu** location
5. Click **Save Menu**

## ✅ Done! Visit Your Site

Your landing page is now live at: `https://yourdomain.com`

---

## 📸 Add Images (Optional)

Upload these images via **FTP/SSH or cPanel File Manager**:

**Location:** `/wp-content/themes/learnmoretech-theme/landing-page/images/`

**Required:**
- `hero-image.jpg` (1200x800px) - Hero section
- `founder.jpg` (800x800px) - Founder photo
- `logo.png` - Your logo (optional)

**Don't have images yet?**
- Use placeholder images from unsplash.com
- Search: "older adults technology" or "50+ adults learning"

---

## 🎨 Add Your Logo (Optional)

1. Go to **Appearance → Customize**
2. Click **Site Identity**
3. Click **Select Logo**
4. Upload logo image
5. Click **Publish**

---

## 📝 Customize Content

Edit the landing page content:

**Via WordPress Editor:**
1. Pages → Home → Edit (not recommended, uses template)

**Via Theme Files** (recommended):
1. Edit `/page-landing.php`
2. Find sections starting with `<!-- Hero Section -->`
3. Modify text, headlines, buttons
4. Save and refresh browser

---

## 🔗 Test Navigation

**Check these URLs work:**
- Home: `/`
- About: `/about` (create page if 404)
- Register: `/register`
- Login: `/login`

**If using BuddyBoss:**
- Community: `/members`
- Groups: `/groups`
- Activity: `/activity`

**If using LearnDash:**
- Courses: `/courses`

---

## 📧 Test Waitlist Form

1. Scroll to bottom of homepage
2. Fill out "Join Waitlist" form
3. Click "Reserve My Spot"
4. Should see success message
5. Check email (you'll receive notification)

**View submissions:**
```sql
SELECT * FROM wp_learnmoretech_waitlist;
```

---

## 🐛 Troubleshooting

### Mobile menu not working?
- Clear browser cache
- Check browser console for JavaScript errors
- Make sure `/landing-page/scripts/main.js` exists

### Navigation links broken?
- Go to Settings → Permalinks
- Click "Save Changes" (flushes rewrite rules)

### Styles not loading?
- Hard refresh: `Cmd+Shift+R` (Mac) or `Ctrl+Shift+R` (Windows)
- Clear WordPress cache (if using cache plugin)
- Check file permissions: `chmod -R 755 learnmoretech-theme`

### Form not submitting?
- Check server error logs
- Verify email settings (WordPress → Settings → General)
- Test with WP Mail SMTP plugin

---

## 🎯 Next Steps

1. **Add real images** (hero, founder)
2. **Create About page** and other pages
3. **Set up MailerLite** integration for automated emails
4. **Install analytics** (Google Analytics, Facebook Pixel)
5. **Set up SSL** certificate (if not already)
6. **Test mobile** experience on real devices
7. **Launch!** 🚀

---

## 📞 Need Help?

- Check `README.md` for detailed documentation
- Review `functions.php` for customization options
- Edit `page-landing.php` to modify content
- Modify `landing-page/styles/main.css` for styling changes

---

**You're ready to launch! 🎉**
