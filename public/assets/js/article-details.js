/**
 * BusinessEx Article Detail Page - Main JavaScript
 * ================================================
 * Handles all interactive functionality for the article page
 */

(function() {
    'use strict';

    // ============================================
    // DOM Ready
    // ============================================
    document.addEventListener('DOMContentLoaded', function() {
        initScrollToComments();
        initShareButton();
        initCommentForm();
        initNewsletterForm();
        initSmoothScroll();
        initNavbarToggle();
    });

    // ============================================
    // Scroll to Comments Section
    // ============================================
    function initScrollToComments() {
        const commentBtns = document.querySelectorAll('[onclick="scrollToComments()"]');
        commentBtns.forEach(btn => {
            btn.addEventListener('click', function(e) {
                e.preventDefault();
                scrollToCommentsImpl();
            });
        });
    }

    // Expose to global scope for onclick handlers
    window.scrollToComments = function() {
        scrollToCommentsImpl();
    };

    function scrollToCommentsImpl() {
        const commentsSection = document.getElementById('comments');
        if (commentsSection) {
            commentsSection.scrollIntoView({ 
                behavior: 'smooth',
                block: 'start'
            });
            
            // Highlight the section briefly
            commentsSection.style.boxShadow = '0 0 0 4px rgba(26, 188, 156, 0.3)';
            setTimeout(() => {
                commentsSection.style.boxShadow = '';
            }, 2000);
        }
    }

    // ============================================
    // Share Button Functionality
    // ============================================
    function initShareButton() {
        const shareBtns = document.querySelectorAll('[onclick="shareArticle()"]');
        shareBtns.forEach(btn => {
            btn.addEventListener('click', handleShare);
        });
    }

    window.shareArticle = handleShare;

    function handleShare(e) {
        if (e) e.preventDefault();
        
        const shareData = {
            title: document.title,
            text: document.querySelector('.article-title')?.textContent || '',
            url: window.location.href
        };

        // Check if Web Share API is available
        if (navigator.share) {
            navigator.share(shareData)
                .then(() => showNotification('Thanks for sharing!', 'success'))
                .catch(err => {
                    if (err.name !== 'AbortError') {
                        fallbackShare(shareData.url);
                    }
                });
        } else {
            fallbackShare(shareData.url);
        }
    }

    function fallbackShare(url) {
        // Create temporary input to copy URL
        const tempInput = document.createElement('input');
        tempInput.value = url;
        document.body.appendChild(tempInput);
        tempInput.select();
        
        try {
            document.execCommand('copy');
            showNotification('Article link copied to clipboard!', 'success');
        } catch (err) {
            showNotification('Could not copy link', 'error');
        }
        
        document.body.removeChild(tempInput);
    }

    // ============================================
    // Comment Form Handling
    // ============================================
    function initCommentForm() {
        const form = document.getElementById('commentForm');
        if (!form) return;

        form.addEventListener('submit', function(e) {
            e.preventDefault();
            handleCommentSubmit(form);
        });

        // Real-time validation
        const inputs = form.querySelectorAll('input[required], textarea[required]');
        inputs.forEach(input => {
            input.addEventListener('blur', function() {
                validateField(this);
            });
            
            input.addEventListener('input', function() {
                if (this.classList.contains('error')) {
                    validateField(this);
                }
            });
        });
    }

    function handleCommentSubmit(form) {
        const name = form.comment_name?.value.trim();
        const email = form.comment_email?.value.trim();
        const comment = form.comment_detail?.value.trim();

        // Validate all fields
        let isValid = true;
        
        if (!name || name.length < 2) {
            showFieldError(form.comment_name, 'Please enter your name (min 2 characters)');
            isValid = false;
        }

        if (!email || !isValidEmail(email)) {
            showFieldError(form.comment_email, 'Please enter a valid email address');
            isValid = false;
        }

        if (!comment || comment.length < 10) {
            showFieldError(form.comment_detail, 'Please write a comment (min 10 characters)');
            isValid = false;
        }

        if (!isValid) {
            showNotification('Please fix the errors above', 'error');
            return;
        }

        // Simulate submission
        const submitBtn = form.querySelector('.btn-post-comment');
        const originalText = submitBtn.textContent;
        submitBtn.textContent = 'Posting...';
        submitBtn.disabled = true;

        setTimeout(() => {
            showNotification('Comment posted successfully! It will appear after moderation.', 'success');
            form.reset();
            submitBtn.innerHTML = '<i class="fas fa-paper-plane mr-2"></i>Post Comment';
            submitBtn.disabled = false;
            
            // Clear any existing error states
            form.querySelectorAll('.error').forEach(el => el.classList.remove('error'));
        }, 1500);
    }

    function validateField(field) {
        const value = field.value.trim();
        
        if (field.type === 'email') {
            if (!isValidEmail(value)) {
                showFieldError(field, 'Please enter a valid email address');
                return false;
            }
        } else if (field.tagName === 'TEXTAREA') {
            if (value.length < 10 && value.length > 0) {
                showFieldError(field, 'Comment must be at least 10 characters');
                return false;
            }
        } else {
            if (value.length < 2 && value.length > 0) {
                showFieldError(field, 'This field is required');
                return false;
            }
        }
        
        clearFieldError(field);
        return true;
    }

    function showFieldError(field, message) {
        field.classList.add('error');
        field.style.borderColor = '#e74c3c';
        
        // Remove existing error message
        const existingMsg = field.parentNode.querySelector('.field-error');
        if (existingMsg) existingMsg.remove();

        // Add error message
        const errorMsg = document.createElement('small');
        errorMsg.className = 'field-error';
        errorMsg.style.cssText = 'color: #e74c3c; font-size: 12px; margin-top: 5px; display: block;';
        errorMsg.textContent = message;
        field.parentNode.appendChild(errorMsg);
    }

    function clearFieldError(field) {
        field.classList.remove('error');
        field.style.borderColor = '';
        const errorMsg = field.parentNode.querySelector('.field-error');
        if (errorMsg) errorMsg.remove();
    }

    function isValidEmail(email) {
        const regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return regex.test(email);
    }

    // ============================================
    // Newsletter Form Handling
    // ============================================
    function initNewsletterForm() {
        const forms = document.querySelectorAll('.newsletter-form');
        forms.forEach(form => {
            form.addEventListener('submit', function(e) {
                e.preventDefault();
                handleNewsletterSubmit(form);
            });
        });
    }

    function handleNewsletterSubmit(form) {
        const inputs = form.querySelectorAll('input[required]');
        let isValid = true;

        inputs.forEach(input => {
            if (!input.value.trim()) {
                isValid = false;
                input.style.borderColor = '#e74c3c';
            } else {
                input.style.borderColor = '';
            }
        });

        const emailInput = form.querySelector('input[type="email"]');
        if (emailInput && !isValidEmail(emailInput.value)) {
            isValid = false;
            emailInput.style.borderColor = '#e74c3c';
        }

        if (!isValid) {
            showNotification('Please fill all required fields correctly', 'error');
            return;
        }

        // Simulate subscription
        const btn = form.querySelector('.btn-subscribe');
        const originalText = btn.textContent;
        btn.textContent = 'Subscribing...';
        btn.disabled = true;

        setTimeout(() => {
            showNotification('Successfully subscribed! Check your email for confirmation.', 'success');
            form.reset();
            btn.textContent = originalText;
            btn.disabled = false;
        }, 1200);
    }

    window.subscribeNewsletter = function(e, form) {
        if (e) e.preventDefault();
        if (!form) form = e.target;
        handleNewsletterSubmit(form);
    };

    // ============================================
    // Smooth Scroll for Anchor Links
    // ============================================
    function initSmoothScroll() {
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                const href = this.getAttribute('href');
                if (href === '#') return;
                
                const target = document.querySelector(href);
                if (target) {
                    e.preventDefault();
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });
    }

    // ============================================
    // Navbar Toggle (Mobile)
    // ============================================
    function initNavbarToggle() {
        const navbarToggler = document.querySelector('.navbar-toggler');
        const navbarCollapse = document.querySelector('.navbar-collapse');
        
        if (navbarToggler && navbarCollapse) {
            // Close navbar when clicking outside
            document.addEventListener('click', function(e) {
                if (!navbarToggler.contains(e.target) && !navbarCollapse.contains(e.target)) {
                    if (navbarCollapse.classList.contains('show')) {
                        navbarToggler.click();
                    }
                }
            });

            // Close navbar when clicking on nav links
            const navLinks = navbarCollapse.querySelectorAll('.nav-link:not(.dropdown-toggle)');
            navLinks.forEach(link => {
                link.addEventListener('click', () => {
                    if (navbarCollapse.classList.contains('show')) {
                        navbarToggler.click();
                    }
                });
            });
        }
    }

    // ============================================
    // Notification System
    // ============================================
    window.showNotification = function(message, type = 'info', duration = 3000) {
        // Remove existing notifications
        const existing = document.querySelector('.notification-toast');
        if (existing) {
            existing.remove();
        }

        // Determine icon based on type
        const icons = {
            success: 'fa-check-circle',
            error: 'fa-exclamation-circle',
            info: 'fa-info-circle',
            warning: 'fa-exclamation-triangle'
        };

        // Create notification element
        const notification = document.createElement('div');
        notification.className = `notification-toast ${type}`;
        notification.innerHTML = `
            <div class="toast-content">
                <i class="fas ${icons[type] || icons.info}"></i>
                <span>${message}</span>
            </div>
        `;

        document.body.appendChild(notification);

        // Auto remove after duration
        if (duration > 0) {
            setTimeout(() => {
                if (notification.parentNode) {
                    notification.style.animation = 'slideOutRight 0.3s ease-in forwards';
                    setTimeout(() => {
                        if (notification.parentNode) {
                            notification.remove();
                        }
                    }, 300);
                }
            }, duration);
        }

        return notification;
    };

})();
