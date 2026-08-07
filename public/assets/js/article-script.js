// BusinessEx Article Page - JavaScript

document.addEventListener('DOMContentLoaded', function() {
  initSortFilter();
  initShareButtons();
  initNewsletterForm();
  initLazyLoading();
});

// Sort/Filter Functionality
function initSortFilter() {
  const sortLinks = document.querySelectorAll('.sort-options a');
  
  sortLinks.forEach(function(link) {
    link.addEventListener('click', function(e) {
      e.preventDefault();
      
      // Remove active class from all links
      sortLinks.forEach(function(l) {
        l.classList.remove('active');
      });
      
      // Add active class to clicked link
      this.classList.add('active');
      
      // Get sort type
      const sortBy = this.getAttribute('data-sort');
      
      // Show notification
      showNotification(`Sorting articles by: ${this.textContent}`, 'info');
      
      // Here you would typically make an API call to fetch sorted data
      simulateSorting(sortBy);
    });
  });
}

function simulateSorting(sortType) {
  const cards = document.querySelectorAll('.article-card');
  
  // Add animation effect
  cards.forEach(function(card, index) {
    card.style.opacity = '0';
    card.style.transform = 'translateY(20px)';
    
    setTimeout(function() {
      card.style.transition = 'all 0.3s ease';
      card.style.opacity = '1';
      card.style.transform = 'translateY(0)';
    }, index * 50);
  });
}

// Share Button Functionality
function initShareButtons() {
  const shareButtons = document.querySelectorAll('.btn-share');
  
  shareButtons.forEach(function(btn) {
    btn.addEventListener('click', function(e) {
      e.stopPropagation();
      const articleTitle = this.closest('.article-card').querySelector('.article-title-link').textContent;
      openShareModal(articleTitle);
    });
  });
}

function openShareModal(title) {
  // Create modal if it doesn't exist
  let modal = document.getElementById('shareModal');
  
  if (!modal) {
    modal = document.createElement('div');
    modal.id = 'shareModal';
    modal.className = 'share-modal-overlay';
    modal.innerHTML = `
      <div class="share-modal">
        <div class="share-modal-header">
          <h5>Share Article</h5>
          <button class="share-modal-close" onclick="closeShareModal()">&times;</button>
        </div>
        <div class="share-modal-body">
          <p class="share-article-title"></p>
          <div class="share-options">
            <a href="#" class="share-option facebook" onclick="shareOnSocial('facebook')">
              <i class="fab fa-facebook-f"></i> Facebook
            </a>
            <a href="#" class="share-option twitter" onclick="shareOnSocial('twitter')">
              <i class="fab fa-twitter"></i> Twitter
            </a>
            <a href="#" class="share-option linkedin" onclick="shareOnSocial('linkedin')">
              <i class="fab fa-linkedin-in"></i> LinkedIn
            </a>
            <a href="#" class="share-option whatsapp" onclick="shareOnSocial('whatsapp')">
              <i class="fab fa-whatsapp"></i> WhatsApp
            </a>
            <a href="#" class="share-option email" onclick="shareOnSocial('email')">
              <i class="fas fa-envelope"></i> Email
            </a>
            <a href="#" class="share-option copy" onclick="copyLink()">
              <i class="fas fa-link"></i> Copy Link
            </a>
          </div>
        </div>
      </div>
    `;
    
    // Add modal styles
    const style = document.createElement('style');
    style.textContent = `
      .share-modal-overlay {
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(0,0,0,0.6);
        display: flex;
        align-items: center;
        justify-content: center;
        z-index: 10000;
        animation: fadeIn 0.2s ease;
      }
      .share-modal {
        background: #fff;
        border-radius: 12px;
        width: 90%;
        max-width: 450px;
        box-shadow: 0 10px 40px rgba(0,0,0,0.3);
        animation: slideUp 0.3s ease;
      }
      .share-modal-header {
        padding: 20px 25px;
        border-bottom: 1px solid #eee;
        display: flex;
        justify-content: space-between;
        align-items: center;
      }
      .share-modal-header h5 {
        margin: 0;
        font-size: 18px;
        font-weight: 600;
      }
      .share-modal-close {
        background: none;
        border: none;
        font-size: 24px;
        color: #999;
        cursor: pointer;
        line-height: 1;
      }
      .share-modal-close:hover {
        color: #333;
      }
      .share-modal-body {
        padding: 25px;
      }
      .share-article-title {
        font-weight: 500;
        margin-bottom: 20px;
        color: #333;
        font-size: 14px;
      }
      .share-options {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 12px;
      }
      .share-option {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        padding: 15px 10px;
        border-radius: 8px;
        text-decoration: none;
        font-size: 12px;
        transition: transform 0.2s;
      }
      .share-option:hover {
        transform: translateY(-3px);
      }
      .share-option i {
        font-size: 24px;
        margin-bottom: 8px;
      }
      .share-option.facebook { background: #1877f2; color: #fff; }
      .share-option.twitter { background: #1da1f2; color: #fff; }
      .share-option.linkedin { background: #0077b5; color: #fff; }
      .share-option.whatsapp { background: #25d366; color: #fff; }
      .share-option.email { background: #ea4335; color: #fff; }
      .share-option.copy { background: #f0f0f0; color: #333; }
      @keyframes fadeIn {
        from { opacity: 0; }
        to { opacity: 1; }
      }
      @keyframes slideUp {
        from { transform: translateY(30px); opacity: 0; }
        to { transform: translateY(0); opacity: 1; }
      }
    `;
    document.head.appendChild(style);
    document.body.appendChild(modal);
  }
  
  // Set article title and show modal
  modal.querySelector('.share-article-title').textContent = title;
  modal.style.display = 'flex';
}

function closeShareModal() {
  const modal = document.getElementById('shareModal');
  if (modal) {
    modal.style.display = 'none';
  }
}

function shareOnSocial(platform) {
  const url = window.location.href;
  const title = document.querySelector('.share-article-title')?.textContent || 'Article';
  
  const shareUrls = {
    facebook: `https://www.facebook.com/sharer/sharer.php?u=${encodeURIComponent(url)}`,
    twitter: `https://twitter.com/intent/tweet?url=${encodeURIComponent(url)}&text=${encodeURIComponent(title)}`,
    linkedin: `https://www.linkedin.com/shareArticle?mini=true&url=${encodeURIComponent(url)}&title=${encodeURIComponent(title)}`,
    whatsapp: `https://wa.me/?text=${encodeURIComponent(title + ' ' + url)}`,
    email: `mailto:?subject=${encodeURIComponent(title)}&body=${encodeURIComponent(url)}`
  };
  
  if (platform === 'copy') {
    copyLink();
  } else if (shareUrls[platform]) {
    window.open(shareUrls[platform], '_blank', 'width=600,height=400');
  }
  
  closeShareModal();
  showNotification(`Sharing on ${platform}...`, 'success');
}

function copyLink() {
  navigator.clipboard.writeText(window.location.href).then(function() {
    showNotification('Link copied to clipboard!', 'success');
    closeShareModal();
  }).catch(function() {
    showNotification('Failed to copy link', 'error');
  });
}

// Newsletter Form
function initNewsletterForm() {
  const form = document.querySelector('.newsletter-form');
  
  if (form) {
    form.addEventListener('submit', function(e) {
      e.preventDefault();
      
      const btn = this.querySelector('button[type="submit"]');
      const originalText = btn.textContent;
      
      btn.disabled = true;
      btn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Subscribing...';
      
      setTimeout(function() {
        btn.disabled = false;
        btn.innerHTML = originalText;
        showNotification('Successfully subscribed to newsletter!', 'success');
        form.reset();
      }, 1500);
    });
  }
}

// Lazy Loading Images
function initLazyLoading() {
  const images = document.querySelectorAll('img[data-src]');
  
  if ('IntersectionObserver' in window) {
    const imageObserver = new IntersectionObserver(function(entries) {
      entries.forEach(function(entry) {
        if (entry.isIntersecting) {
          const img = entry.target;
          img.src = img.dataset.src;
          img.removeAttribute('data-src');
          imageObserver.unobserve(img);
        }
      });
    });
    
    images.forEach(function(img) {
      imageObserver.observe(img);
    });
  } else {
    // Fallback for older browsers
    images.forEach(function(img) {
      img.src = img.dataset.src;
    });
  }
}

// Pagination
function goToPage(pageNum) {
  showNotification(`Loading page ${pageNum}...`, 'info');
  
  // Scroll to top of articles
  document.querySelector('.main-content').scrollIntoView({ behavior: 'smooth' });
  
  // Simulate page load
  const cards = document.querySelectorAll('.article-card');
  cards.forEach(function(card, index) {
    card.style.opacity = '0.3';
    
    setTimeout(function() {
      card.style.transition = 'opacity 0.3s ease';
      card.style.opacity = '1';
    }, index * 50);
  });
  
  // Update active pagination button
  document.querySelectorAll('.pagination-btn').forEach(function(btn) {
    btn.classList.remove('active');
    if (btn.textContent == pageNum) {
      btn.classList.add('active');
    }
  });
}

// Notification System
function showNotification(message, type = 'info') {
  // Remove existing notifications
  const existing = document.querySelector('.article-notification');
  if (existing) existing.remove();
  
  const notification = document.createElement('div');
  notification.className = `article-notification article-notification-${type}`;
  notification.innerHTML = `
    <div class="notification-inner">
      <i class="fas fa-${type === 'success' ? 'check-circle' : type === 'error' ? 'exclamation-circle' : 'info-circle'}"></i>
      <span>${message}</span>
    </div>
  `;
  
  notification.style.cssText = `
    position: fixed;
    top: 80px;
    right: 20px;
    background: #fff;
    border-radius: 8px;
    box-shadow: 0 5px 25px rgba(0,0,0,0.15);
    z-index: 9999;
    animation: notifSlideIn 0.3s ease;
    max-width: 350px;
    overflow: hidden;
  `;
  
  const style = document.createElement('style');
  style.textContent = `
    @keyframes notifSlideIn {
      from { transform: translateX(100%); opacity: 0; }
      to { transform: translateX(0); opacity: 1; }
    }
    .notification-inner {
      display: flex;
      align-items: center;
      padding: 15px 20px;
      gap: 12px;
    }
    .notification-inner i {
      font-size: 18px;
      color: ${type === 'success' ? '#1abc9c' : type === 'error' ? '#e74c3c' : '#3498db'};
    }
    .article-notification-success { border-left: 4px solid #1abc9c; }
    .article-notification-error { border-left: 4px solid #e74c3c; }
    .article-notification-info { border-left: 4px solid #3498db; }
  `;
  
  if (!document.querySelector('#notif-styles')) {
    style.id = 'notif-styles';
    document.head.appendChild(style);
  }
  
  document.body.appendChild(notification);
  
  // Auto remove after 4 seconds
  setTimeout(function() {
    notification.style.animation = 'notifSlideIn 0.3s ease reverse';
    setTimeout(() => notification.remove(), 300);
  }, 4000);
}

// Search Functionality (for future use)
function searchArticles(query) {
  if (!query || query.length < 2) return;
  
  showNotification(`Searching for: "${query}"`, 'info');
  
  // Implement search logic here
}

// Close modal on outside click
document.addEventListener('click', function(e) {
  const modal = document.getElementById('shareModal');
  if (modal && e.target === modal) {
    closeShareModal();
  }
});

// Keyboard shortcuts
document.addEventListener('keydown', function(e) {
  if (e.key === 'Escape') {
    closeShareModal();
  }
});
