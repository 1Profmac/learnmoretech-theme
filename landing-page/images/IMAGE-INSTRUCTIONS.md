# Image Placeholder Instructions

## Required Images for Landing Page

Upload these images to: `/wp-content/themes/learnmoretech-theme/landing-page/images/`

### 1. hero-image.jpg
- **Size:** 1200 x 800 pixels
- **Subject:** Active 50+ adults learning technology, working on laptops, in community setting
- **Style:** Modern, professional, bright lighting
- **Sources:**
  - Unsplash: search "older adults technology"
  - Pexels: search "seniors learning computer"
  - Your own photos

### 2. founder.jpg  
- **Size:** 800 x 800 pixels (square)
- **Subject:** Founder headshot or candid photo
- **Style:** Professional but approachable
- **Tips:** Good lighting, plain background, looking at camera

### 3. logo.png (optional)
- **Size:** 200 x 60 pixels (or proportional)
- **Format:** PNG with transparency
- **Usage:** Will appear in header navigation
- **Fallback:** Text-based logo "50+ TechBridge" shows if no image

## Temporary Placeholders

Until you have real images, use these free stock photo sites:

**Unsplash** (https://unsplash.com)
- Search: "older adults", "seniors technology", "mature professionals"
- License: Free to use

**Pexels** (https://pexels.com)  
- Search: "elderly learning", "senior computer", "mature student"
- License: Free to use

**Download Example:**
```bash
# Example using curl
cd landing-page/images/
curl -L "https://images.unsplash.com/photo-example" -o hero-image.jpg
```

## Using Real Photos

**Best Practices:**
1. Use actual photos of 50+ adults (not models)
2. Show active engagement, not passive sitting
3. Diverse representation (age, race, gender)
4. Modern clothing and settings
5. Natural expressions (concentration, joy, pride)

**Avoid:**
- Stock photos of "confused senior with computer"
- Stereotypical "helping grandma" poses
- Dated technology or clothing
- Overly posed or fake-looking images

## Optimizing Images

Before uploading, optimize filesize:

```bash
# On Mac (requires ImageMagick)
brew install imagemagick
convert hero-image.jpg -quality 85 -resize 1200x800 hero-image.jpg

# Or use online tools:
# - TinyPNG.com
# - Squoosh.app
# - ImageOptim (Mac app)
```

## Current Status

Place an `X` when completed:

- [ ] hero-image.jpg uploaded
- [ ] founder.jpg uploaded  
- [ ] logo.png uploaded (optional)
- [ ] Images optimized for web
- [ ] Landing page displays correctly

## Troubleshooting

**Image not showing:**
1. Check file name matches exactly (case-sensitive)
2. Verify path: `/landing-page/images/hero-image.jpg`
3. Check file permissions: `chmod 644 *.jpg`
4. Clear browser cache and refresh

**Image too large/slow loading:**
1. Resize to recommended dimensions
2. Compress with tools mentioned above
3. Aim for < 200KB per image
