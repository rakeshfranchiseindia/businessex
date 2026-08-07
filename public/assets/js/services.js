/**
 * BusinessEx Service Pages - Main JavaScript
 * Handles form submissions, accordion, navigation, and other interactions
 */

document.addEventListener('DOMContentLoaded', function() {
  
  // Initialize all components
  initNavbar();
  initForms();
  initAccordion();
  initSmoothScroll();
  initAnimations();
  initNewsletterForm();
});

/**
 * Navbar functionality - Mobile toggle and scroll behavior
 */
function initNavbar() {
  const navbar = document.querySelector('.main-navbar');
  const navbarToggler = document.querySelector('.navbar-toggler');
  const navbarCollapse = document.querySelector('.navbar-collapse');
  
  // Close mobile menu when clicking outside
  document.addEventListener('click', function(e) {
    if (navbarCollapse && navbarCollapse.classList.contains('show')) {
      if (!navbarCollapse.contains(e.target) && !navbarToggler.contains(e.target)) {
        navbarCollapse.classList.remove('show');
      }
    }
  });
  
  // Navbar scroll effect
  if (navbar) {
    window.addEventListener('scroll', function() {
      if (window.scrollY > 50) {
        navbar.classList.add('shadow-lg');
      } else {
        navbar.classList.remove('shadow-lg');
      }
    });
  }
  
  // Active nav link highlighting
  const currentPage = window.location.pathname.split('/').pop() || 'business-valuation.html';
  const navLinks = document.querySelectorAll('.main-navbar .nav-link');
  
  navLinks.forEach(link => {
    const href = link.getAttribute('href');
    if (href === currentPage || (currentPage === '' && href === 'business-valuation.html')) {
      link.classList.add('active');
    }
  });
}

/**
 * Form handling - Hero forms and contact forms
 */
function initForms() {
  // Hero form submission
  const heroForm = document.querySelector('.hero-form-card form');
  if (heroForm) {
    heroForm.addEventListener('submit', function(e) {
      e.preventDefault();
      
      if (validateForm(this)) {
        submitForm(this, 'hero-form');
      }
    });
  }
  
  // Add input focus effects
  const formInputs = document.querySelectorAll('.form-control');
  formInputs.forEach(input => {
    input.addEventListener('focus', function() {
      this.parentElement.classList.add('focused');
    });
    
    input.addEventListener('blur', function() {
      if (!this.value) {
        this.parentElement.classList.remove('focused');
      }
    });
  });
}

/**
 * Validate form fields
 */
function validateForm(form) {
  let isValid = true;
  const requiredFields = form.querySelectorAll('[required]');
  
  requiredFields.forEach(field => {
    removeError(field);
    
    if (!field.value.trim()) {
      showError(field, 'This field is required');
      isValid = false;
    } else if (field.type === 'email' && !isValidEmail(field.value)) {
      showError(field, 'Please enter a valid email address');
      isValid = false;
    } else if (field.type === 'tel' && !isValidPhone(field.value)) {
      showError(field, 'Please enter a valid phone number');
      isValid = false;
    }
  });
  
  return isValid;
}

/**
 * Show error message for form field
 */
function showError(field, message) {
  field.classList.add('is-invalid');
  field.parentElement.classList.add('has-error');
  
  const errorDiv = document.createElement('div');
  errorDiv.className = 'invalid-feedback';
  errorDiv.textContent = message;
  field.parentElement.appendChild(errorDiv);
}

/**
 * Remove error message from form field
 */
function removeError(field) {
  field.classList.remove('is-invalid');
  field.parentElement.classList.remove('has-error');
  
  const existingError = field.parentElement.querySelector('.invalid-feedback');
  if (existingError) {
    existingError.remove();
  }
}

/**
 * Email validation helper
 */
function isValidEmail(email) {
  const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
  return re.test(email);
}

/**
 * Phone validation helper
 */
function isValidPhone(phone) {
  const re = /^[\d\s\-\+\(\)]{7,20}$/;
  return re.test(phone);
}

/**
 * Submit form with AJAX simulation
 */
function submitForm(form, formType) {
  const submitBtn = form.querySelector('[type="submit"]');
  const originalText = submitBtn.innerHTML;
  
  // Show loading state
  submitBtn.disabled = true;
  submitBtn.innerHTML = '<span class="spinner-border spinner-border-sm mr-2"></span>Submitting...';
  
  // Simulate API call
  setTimeout(function() {
    // Show success message
    showNotification('Thank you! Your submission has been received. We will contact you soon.', 'success');
    
    // Reset form
    form.reset();
    
    // Restore button
    submitBtn.disabled = false;
    submitBtn.innerHTML = originalText;
  }, 1500);
}

/**
 * Accordion functionality for FAQ section
 */
function initAccordion() {
  const accordionButtons = document.querySelectorAll('.accordion-custom .btn-faq');
  
  accordionButtons.forEach(button => {
    button.addEventListener('click', function() {
      const card = this.closest('.card');
      const collapsingCard = card.querySelector('.collapse');
      const isOpen = collapsingCard.classList.contains('show');
      
      // Close all other open items in the same accordion
      const parentAccordion = this.closest('.accordion-custom');
      if (parentAccordion) {
        const allCards = parentAccordion.querySelectorAll('.card .collapse.show');
        allCards.forEach(collapse => {
          if (collapse !== collapsingCard) {
            collapse.classList.remove('show');
            collapse.previousElementSibling.querySelector('.btn-faq').classList.add('collapsed');
          }
        });
      }
      
      // Toggle current item
      if (!isOpen) {
        collapsingCard.classList.add('show');
        this.classList.remove('collapsed');
      } else {
        collapsingCard.classList.remove('show');
        this.classList.add('collapsed');
      }
    });
  });
}

/**
 * Smooth scroll for anchor links
 */
function initSmoothScroll() {
  const anchorLinks = document.querySelectorAll('a[href^="#"]');
  
  anchorLinks.forEach(link => {
    link.addEventListener('click', function(e) {
      const targetId = this.getAttribute('href');
      if (targetId === '#') return;
      
      e.preventDefault();
      
      const targetElement = document.querySelector(targetId);
      if (targetElement) {
        const offsetTop = targetElement.offsetTop - 80; // Account for fixed navbar
        
        window.scrollTo({
          top: offsetTop,
          behavior: 'smooth'
        });
      }
    });
  });
}

/**
 * Scroll animations using Intersection Observer
 */
function initAnimations() {
  const animatedElements = document.querySelectorAll('.feature-card, .icon-card, .info-box, .dd-type-list li, .strategy-list li');
  
  if ('IntersectionObserver' in window) {
    const observer = new IntersectionObserver((entries) => {
      entries.forEach(entry => {
        if (entry.isIntersecting) {
          entry.target.classList.add('animate-fadeInUp');
          observer.unobserve(entry.target);
        }
      });
    }, {
      threshold: 0.1,
      rootMargin: '0px 0px -50px 0px'
    });
    
    animatedElements.forEach(el => {
      el.style.opacity = '0';
      observer.observe(el);
    });
  } else {
    // Fallback: show all elements
    animatedElements.forEach(el => {
      el.style.opacity = '1';
    });
  }
}

/**
 * Newsletter form handling
 */
function initNewsletterForm() {
  const newsletterForm = document.querySelector('.newsletter-form');
  
  if (newsletterForm) {
    newsletterForm.addEventListener('submit', function(e) {
      e.preventDefault();
      
      const emailInput = this.querySelector('input[type="email"]');
      const nameInput = this.querySelector('input[type="text"]');
      
      if (emailInput && emailInput.value && isValidEmail(emailInput.value)) {
        showNotification('Successfully subscribed to our newsletter!', 'success');
        this.reset();
      } else if (emailInput) {
        showNotification('Please enter a valid email address.', 'error');
        emailInput.focus();
      }
    });
  }
}

/**
 * Show notification toast
 */
function showNotification(message, type = 'info') {
  // Remove existing notifications
  const existingNotification = document.querySelector('.notification-toast');
  if (existingNotification) {
    existingNotification.remove();
  }
  
  // Create notification element
  const notification = document.createElement('div');
  notification.className = `notification-toast notification-${type}`;
  notification.innerHTML = `
    <div class="notification-content">
      <i class="fas ${type === 'success' ? 'fa-check-circle' : type === 'error' ? 'fa-exclamation-circle' : 'fa-info-circle'}"></i>
      <span>${message}</span>
      <button class="notification-close">&times;</button>
    </div>
  `;
  
  // Add styles
  notification.style.cssText = `
    position: fixed;
    top: 100px;
    right: 20px;
    background-color: ${type === 'success' ? '#28a745' : type === 'error' ? '#dc3545' : '#17a2b8'};
    color: white;
    padding: 15px 25px;
    border-radius: 8px;
    box-shadow: 0 5px 20px rgba(0,0,0,0.2);
    z-index: 9999;
    transform: translateX(120%);
    transition: transform 0.3s ease;
    max-width: 400px;
  `;
  
  document.body.appendChild(notification);
  
  // Animate in
  setTimeout(() => {
    notification.style.transform = 'translateX(0)';
  }, 10);
  
  // Close button handler
  const closeBtn = notification.querySelector('.notification-close');
  closeBtn.style.cssText = `
    background: none;
    border: none;
    color: white;
    font-size: 24px;
    cursor: pointer;
    margin-left: 15px;
    padding: 0;
    line-height: 1;
  `;
  
  closeBtn.addEventListener('click', () => {
    notification.style.transform = 'translateX(120%)';
    setTimeout(() => notification.remove(), 300);
  });
  
  // Auto-remove after 5 seconds
  setTimeout(() => {
    if (notification.parentNode) {
      notification.style.transform = 'translateX(120%)';
      setTimeout(() => notification.remove(), 300);
    }
  }, 5000);
}

/**
 * Footer tabs functionality
 */
function initFooterTabs() {
  const tabLinks = document.querySelectorAll('.nav-tabs-footer .nav-link');
  const tabPanes = document.querySelectorAll('.tab-pane-footer');
  
  tabLinks.forEach(link => {
    link.addEventListener('click', function(e) {
      e.preventDefault();
      
      const targetTab = this.getAttribute('data-tab');
      
      // Remove active from all links
      tabLinks.forEach(l => l.classList.remove('active'));
      
      // Add active to clicked link
      this.classList.add('active');
      
      // Hide all panes
      tabPanes.forEach(pane => pane.style.display = 'none');
      
      // Show target pane
      const targetPane = document.getElementById(targetTab);
      if (targetPane) {
        targetPane.style.display = 'block';
      }
    });
  });
}

// Initialize footer tabs when DOM is ready
document.addEventListener('DOMContentLoaded', initFooterTabs);

/**
 * Lazy loading images
 */
function lazyLoadImages() {
  const images = document.querySelectorAll('img[data-src]');
  
  if ('IntersectionObserver' in window) {
    const imageObserver = new IntersectionObserver((entries) => {
      entries.forEach(entry => {
        if (entry.isIntersecting) {
          const img = entry.target;
          img.src = img.dataset.src;
          img.removeAttribute('data-src');
          imageObserver.unobserve(img);
        }
      });
    });
    
    images.forEach(img => imageObserver.observe(img));
  } else {
    // Fallback: load all images
    images.forEach(img => {
      img.src = img.dataset.src;
      img.removeAttribute('data-src');
    });
  }
}

// Initialize lazy loading
document.addEventListener('DOMContentLoaded', lazyLoadImages);

/**
 * Counter animation for statistics (if any)
 */
function animateCounters() {
  const counters = document.querySelectorAll('[data-count]');
  
  counters.forEach(counter => {
    const target = parseInt(counter.dataset.count);
    const duration = 2000;
    const step = target / (duration / 16);
    let current = 0;
    
    const updateCounter = () => {
      current += step;
      if (current < target) {
        counter.textContent = Math.floor(current).toLocaleString();
        requestAnimationFrame(updateCounter);
      } else {
        counter.textContent = target.toLocaleString();
      }
    };
    
    // Start animation when element is visible
    if ('IntersectionObserver' in window) {
      const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
          if (entry.isIntersecting) {
            updateCounter();
            observer.unobserve(entry.target);
          }
        });
      });
      
      observer.observe(counter);
    }
  });
}

document.addEventListener('DOMContentLoaded', animateCounters);

/**
 * Payment mode dropdown handling
 */
document.addEventListener('change', function(e) {
  if (e.target.id === 'paymentMode' || e.target.name === 'paymentMode') {
    const selectedValue = e.target.value;
    console.log('Payment mode selected:', selectedValue);
    // Additional logic can be added here
  }
});

/**
 * Utility: Debounce function for performance optimization
 */
function debounce(func, wait) {
  let timeout;
  return function executedFunction(...args) {
    const later = () => {
      clearTimeout(timeout);
      func(...args);
    };
    clearTimeout(timeout);
    timeout = setTimeout(later, wait);
  };
}

// Handle window resize events with debounce
window.addEventListener('resize', debounce(function() {
  // Adjust any layout elements if needed
}, 250));

console.log('BusinessEx Service Pages - JavaScript Loaded Successfully');
