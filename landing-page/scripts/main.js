/**
 * 50+ TechBridge Landing Page Scripts
 * Mobile menu, smooth scrolling, and form enhancements
 */

(function() {
  'use strict';

  // Wait for DOM to be fully loaded
  document.addEventListener('DOMContentLoaded', function() {
    
    // Mobile Menu Toggle
    const menuToggle = document.getElementById('mobile-menu-toggle');
    const mobileMenu = document.getElementById('mobile-menu');
    
    if (menuToggle && mobileMenu) {
      menuToggle.addEventListener('click', function() {
        // Toggle active class on button
        this.classList.toggle('active');
        
        // Toggle active class on mobile menu
        mobileMenu.classList.toggle('active');
        
        // Update aria-expanded attribute
        const isExpanded = this.getAttribute('aria-expanded') === 'true';
        this.setAttribute('aria-expanded', !isExpanded);
        
        // Prevent body scroll when menu is open
        if (mobileMenu.classList.contains('active')) {
          document.body.style.overflow = 'hidden';
        } else {
          document.body.style.overflow = '';
        }
      });
      
      // Close mobile menu when clicking on a link
      const mobileMenuLinks = mobileMenu.querySelectorAll('a');
      mobileMenuLinks.forEach(function(link) {
        link.addEventListener('click', function() {
          mobileMenu.classList.remove('active');
          menuToggle.classList.remove('active');
          menuToggle.setAttribute('aria-expanded', 'false');
          document.body.style.overflow = '';
        });
      });
      
      // Close mobile menu when clicking outside
      document.addEventListener('click', function(event) {
        const isClickInsideMenu = mobileMenu.contains(event.target);
        const isClickOnToggle = menuToggle.contains(event.target);
        
        if (!isClickInsideMenu && !isClickOnToggle && mobileMenu.classList.contains('active')) {
          mobileMenu.classList.remove('active');
          menuToggle.classList.remove('active');
          menuToggle.setAttribute('aria-expanded', 'false');
          document.body.style.overflow = '';
        }
      });
    }
    
    // Smooth Scrolling for Anchor Links
    const anchorLinks = document.querySelectorAll('a[href^="#"]');
    
    anchorLinks.forEach(function(link) {
      link.addEventListener('click', function(e) {
        const href = this.getAttribute('href');
        
        // Skip if href is just "#"
        if (href === '#') {
          return;
        }
        
        const targetElement = document.querySelector(href);
        
        if (targetElement) {
          e.preventDefault();
          
          // Calculate offset for fixed header
          const headerOffset = 80;
          const elementPosition = targetElement.getBoundingClientRect().top;
          const offsetPosition = elementPosition + window.pageYOffset - headerOffset;
          
          window.scrollTo({
            top: offsetPosition,
            behavior: 'smooth'
          });
          
          // Update URL without jumping
          history.pushState(null, null, href);
        }
      });
    });
    
    // Header Scroll Effect
    let lastScroll = 0;
    const header = document.querySelector('.site-header');
    
    if (header) {
      window.addEventListener('scroll', function() {
        const currentScroll = window.pageYOffset;
        
        // Add shadow when scrolled
        if (currentScroll > 10) {
          header.style.boxShadow = '0 2px 12px rgba(0, 0, 0, 0.08)';
        } else {
          header.style.boxShadow = '0 2px 4px rgba(0, 0, 0, 0.05)';
        }
        
        lastScroll = currentScroll;
      });
    }
    
    // Form Validation Enhancement
    const waitlistForm = document.querySelector('.waitlist-form');
    
    if (waitlistForm) {
      waitlistForm.addEventListener('submit', function(e) {
        const emailInput = this.querySelector('#email');
        const nameInput = this.querySelector('#name');
        
        // Basic validation
        if (emailInput && !validateEmail(emailInput.value)) {
          e.preventDefault();
          alert('Please enter a valid email address.');
          emailInput.focus();
          return false;
        }
        
        if (nameInput && nameInput.value.trim().length < 2) {
          e.preventDefault();
          alert('Please enter your name.');
          nameInput.focus();
          return false;
        }
        
        // Show loading state
        const submitButton = this.querySelector('button[type="submit"]');
        if (submitButton) {
          submitButton.textContent = 'Submitting...';
          submitButton.disabled = true;
        }
      });
    }
    
    // Email validation helper
    function validateEmail(email) {
      const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
      return re.test(email);
    }
    
    // Animate elements on scroll (optional enhancement)
    const observerOptions = {
      threshold: 0.1,
      rootMargin: '0px 0px -100px 0px'
    };
    
    const observer = new IntersectionObserver(function(entries) {
      entries.forEach(function(entry) {
        if (entry.isIntersecting) {
          entry.target.style.opacity = '1';
          entry.target.style.transform = 'translateY(0)';
        }
      });
    }, observerOptions);
    
    // Observe cards for animation
    const cards = document.querySelectorAll('.card');
    cards.forEach(function(card) {
      card.style.opacity = '0';
      card.style.transform = 'translateY(20px)';
      card.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
      observer.observe(card);
    });
    
    // Auto-dismiss alerts after 5 seconds
    const alerts = document.querySelectorAll('.alert');
    alerts.forEach(function(alert) {
      setTimeout(function() {
        alert.style.transition = 'opacity 0.5s ease';
        alert.style.opacity = '0';
        setTimeout(function() {
          alert.remove();
        }, 500);
      }, 5000);
    });
    
    // Track CTA button clicks (can integrate with analytics)
    const ctaButtons = document.querySelectorAll('.btn-primary, .btn-secondary');
    ctaButtons.forEach(function(button) {
      button.addEventListener('click', function() {
        const buttonText = this.textContent.trim();
        
        // Log to console (replace with analytics tracking)
        console.log('CTA clicked:', buttonText);
        
        // If you have Google Analytics:
        // gtag('event', 'cta_click', {
        //   'button_text': buttonText,
        //   'page_location': window.location.href
        // });
      });
    });
    
  });
  
})();
