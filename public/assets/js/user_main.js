// BusinessEx Dashboard - Main JavaScript

document.addEventListener('DOMContentLoaded', function() {
  // Initialize all components
  initSidebarToggle();
  initSubmenuToggle();
  initAccordionFilters();
  initPageNavigation();
  initFormValidation();
  initTagsInput();
  initFileUpload();
});

// Sidebar Toggle for Mobile
function initSidebarToggle() {
  const sidebarToggle = document.getElementById('sidebarToggle');
  const sidebar = document.getElementById('dashboardSidebar');
  
  if (sidebarToggle && sidebar) {
    sidebarToggle.addEventListener('click', function() {
      sidebar.classList.toggle('show');
    });
  }
}

// Submenu Toggle
function initSubmenuToggle() {
  const submenuToggles = document.querySelectorAll('.has-submenu > a');
  
  submenuToggles.forEach(function(toggle) {
    toggle.addEventListener('click', function(e) {
      e.preventDefault();
      const parent = this.parentElement;
      const submenu = parent.querySelector('.submenu');
      
      if (submenu) {
        submenu.classList.toggle('show');
        this.querySelector('i').classList.toggle('fa-chevron-down');
        this.querySelector('i').classList.toggle('fa-chevron-up');
      }
    });
  });
}

function initAccordionFilters() {
  document.querySelectorAll('.accordion_head').forEach(function(head) {
    head.addEventListener('click', function(e) {
      if (e.target.closest('input')) {
        return;
      }

      const content = head.nextElementSibling;
      if (!content) {
        return;
      }

      const isOpen = content.style.display !== 'none';
      content.style.display = isOpen ? 'none' : 'block';

      const icon = head.querySelector('.plusminus');
      if (icon) {
        icon.classList.toggle('minus', !isOpen);
        icon.classList.toggle('add', isOpen);
      }
    });
  });

  document.querySelectorAll('.accordion_headmain').forEach(function(head) {
    head.addEventListener('click', function(e) {
      if (e.target.closest('input')) {
        return;
      }

      const content = head.nextElementSibling;
      if (!content || !content.classList.contains('accordion_bodymain')) {
        return;
      }

      const isOpen = content.style.display !== 'none';
      content.style.display = isOpen ? 'none' : 'block';

      const icon = head.querySelector('.rightdown');
      if (icon) {
        icon.classList.toggle('downval', !isOpen);
        icon.classList.toggle('rightval', isOpen);
      }
    });
  });
}

// Page Navigation (SPA-like behavior)
function initPageNavigation() {
  const navLinks = document.querySelectorAll('[data-page]');
  
  navLinks.forEach(function(link) {
    link.addEventListener('click', function(e) {
      e.preventDefault();
      const page = this.getAttribute('data-page');
      
      // Update active states
      document.querySelectorAll('.sidebar-menu li a').forEach(function(l) {
        l.classList.remove('active');
      });
      this.classList.add('active');
      
      // Show/hide pages
      showPage(page);
      
      // Update URL hash
      window.location.hash = page;
    });
  });
  
  // Handle initial hash
  if (window.location.hash) {
    const page = window.location.hash.substring(1);
    showPage(page);
    
    // Set active link
    document.querySelectorAll('.sidebar-menu li a').forEach(function(l) {
      l.classList.remove('active');
      if (l.getAttribute('data-page') === page) {
        l.classList.add('active');
      }
    });
  }
}

function showPage(pageId) {
  // Hide all pages
  document.querySelectorAll('.dashboard-page').forEach(function(page) {
    page.style.display = 'none';
  });
  
  // Show selected page
  const targetPage = document.getElementById('page-' + pageId);
  if (targetPage) {
    targetPage.style.display = 'block';
  }
}

// Form Validation
function initFormValidation() {
  const forms = document.querySelectorAll('.needs-validation');
  
  forms.forEach(function(form) {
    form.addEventListener('submit', function(e) {
      if (!form.checkValidity()) {
        e.preventDefault();
        e.stopPropagation();
      }
      form.classList.add('was-validated');
      
      // Show success message if valid
      if (form.checkValidity()) {
        e.preventDefault();
        showNotification('Success! Your information has been saved.', 'success');
      }
    });
  });
}

// Tags Input Functionality
function initTagsInput() {
  const tagsContainers = document.querySelectorAll('.tags-container');
  
  tagsContainers.forEach(function(container) {
    const input = container.querySelector('.tags-input');
    const hiddenInput = container.querySelector('input[type="hidden"]');
    
    if (input) {
      input.addEventListener('keydown', function(e) {
        if (e.key === 'Enter' || e.key === ',') {
          e.preventDefault();
          const value = this.value.trim();
          
          if (value && !container.querySelector(`[data-tag="${value}"]`)) {
            addTag(container, value, hiddenInput);
            this.value = '';
          }
        }
        
        if (e.key === 'Backspace' && !this.value) {
          const lastTag = container.querySelector('.tag-item:last-child');
          if (lastTag) {
            removeTag(lastTag, container, hiddenInput);
          }
        }
      });
    }
  });
}

function addTag(container, value, hiddenInput) {
  const tag = document.createElement('span');
  tag.className = 'tag-item';
  tag.setAttribute('data-tag', value);
  tag.innerHTML = `
    ${value}
    <span class="remove-tag">&times;</span>
  `;
  
  tag.querySelector('.remove-tag').addEventListener('click', function() {
    removeTag(tag, container, hiddenInput);
  });
  
  container.insertBefore(tag, container.querySelector('.tags-input'));
  updateHiddenTags(container, hiddenInput);
}

function removeTag(tagElement, container, hiddenInput) {
  tagElement.remove();
  updateHiddenTags(container, hiddenInput);
}

function updateHiddenTags(container, hiddenInput) {
  if (hiddenInput) {
    const tags = Array.from(container.querySelectorAll('.tag-item')).map(t => t.getAttribute('data-tag'));
    hiddenInput.value = tags.join(',');
  }
}

// File Upload Handler
function initFileUpload() {
  const fileUploads = document.querySelectorAll('.file-upload-area');
  
  fileUploads.forEach(function(uploadArea) {
    const input = uploadArea.querySelector('input[type="file"]');
    const fileNameDisplay = uploadArea.querySelector('.file-name');
    
    uploadArea.addEventListener('click', function() {
      if (input) input.click();
    });
    
    if (input) {
      input.addEventListener('change', function() {
        if (this.files.length > 0) {
          if (fileNameDisplay) {
            fileNameDisplay.textContent = this.files[0].name;
            fileNameDisplay.style.display = 'block';
          }
          uploadArea.querySelector('i').className = 'fas fa-file-image';
          uploadArea.querySelector('p').textContent = this.files[0].name;
        }
      });
    }
    
    // Drag and drop
    uploadArea.addEventListener('dragover', function(e) {
      e.preventDefault();
      this.style.borderColor = 'var(--primary-color)';
      this.style.background = 'rgba(26, 188, 156, 0.05)';
    });
    
    uploadArea.addEventListener('dragleave', function(e) {
      e.preventDefault();
      this.style.borderColor = 'var(--border-color)';
      this.style.background = 'transparent';
    });
    
    uploadArea.addEventListener('drop', function(e) {
      e.preventDefault();
      this.style.borderColor = 'var(--border-color)';
      this.style.background = 'transparent';
      
      if (e.dataTransfer.files.length > 0 && input) {
        input.files = e.dataTransfer.files;
        if (fileNameDisplay) {
          fileNameDisplay.textContent = e.dataTransfer.files[0].name;
          fileNameDisplay.style.display = 'block';
        }
      }
    });
  });
}

// Notification System
function showNotification(message, type = 'info') {
  // Remove existing notifications
  const existing = document.querySelector('.notification-toast');
  if (existing) existing.remove();
  
  const notification = document.createElement('div');
  notification.className = `notification-toast notification-${type}`;
  notification.innerHTML = `
    <div class="notification-content">
      <i class="fas fa-${type === 'success' ? 'check-circle' : type === 'error' ? 'exclamation-circle' : 'info-circle'}"></i>
      <span>${message}</span>
      <button class="notification-close">&times;</button>
    </div>
  `;
  
  // Add styles dynamically
  notification.style.cssText = `
    position: fixed;
    top: 20px;
    right: 20px;
    background: #fff;
    border-radius: 8px;
    box-shadow: 0 5px 25px rgba(0,0,0,0.15);
    z-index: 9999;
    animation: slideIn 0.3s ease;
    max-width: 400px;
  `;
  
  const style = document.createElement('style');
  style.textContent = `
    @keyframes slideIn {
      from { transform: translateX(100%); opacity: 0; }
      to { transform: translateX(0); opacity: 1; }
    }
    .notification-content {
      display: flex;
      align-items: center;
      padding: 15px 20px;
      gap: 12px;
    }
    .notification-content i {
      font-size: 20px;
      color: ${type === 'success' ? '#1abc9c' : type === 'error' ? '#e74c3c' : '#3498db'};
    }
    .notification-close {
      background: none;
      border: none;
      font-size: 18px;
      cursor: pointer;
      color: #999;
      margin-left: auto;
    }
  `;
  
  document.head.appendChild(style);
  document.body.appendChild(notification);
  
  // Close button handler
  notification.querySelector('.notification-close').addEventListener('click', function() {
    notification.remove();
  });
  
  // Auto-remove after 5 seconds
  setTimeout(() => {
    if (notification.parentNode) {
      notification.style.animation = 'slideIn 0.3s ease reverse';
      setTimeout(() => notification.remove(), 300);
    }
  }, 5000);
}

// Tab Switching for Forms
function switchTab(tabId) {
  // Update tab buttons
  document.querySelectorAll('.custom-tabs .nav-link').forEach(tab => {
    tab.classList.remove('active');
  });
  document.querySelector(`[data-tab="${tabId}"]`).classList.add('active');
  
  // Update tab content
  document.querySelectorAll('.tab-content').forEach(content => {
    content.style.display = 'none';
  });
  document.getElementById(tabId).style.display = 'block';
}

// Profile Type Change Handler
function changeProfileType(select) {
  const value = select.value;
  console.log('Profile type changed to:', value);
  showNotification(`Profile type changed to ${value}`, 'info');
}

// Load More Functionality
let loadMoreCount = 0;
function loadMoreListings() {
  loadMoreCount++;
  showNotification(`Loading more listings... (${loadMoreCount * 5} shown)`, 'info');
  
  // Simulate loading delay
  const btn = document.querySelector('.btn-load-more');
  if (btn) {
    btn.disabled = true;
    btn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Loading...';
    
    setTimeout(() => {
      btn.disabled = false;
      btn.innerHTML = 'LOAD MORE';
    }, 1000);
  }
}

// Search Contacts
function searchContacts(query) {
  const items = document.querySelectorAll('.chat-user-item');
  
  items.forEach(item => {
    const text = item.textContent.toLowerCase();
    if (text.includes(query.toLowerCase())) {
      item.style.display = 'flex';
    } else {
      item.style.display = 'none';
    }
  });
}

// Submenu Toggle for Separate Pages
function toggleSubmenu(element) {
  const parent = element.parentElement;
  const submenu = parent.querySelector('.submenu');
  const icon = element.querySelector('i');
  
  if (submenu) {
    // Close other open submenus
    document.querySelectorAll('.submenu.show').forEach(function(s) {
      if (s !== submenu) {
        s.classList.remove('show');
        s.previousElementSibling.querySelector('i').classList.remove('fa-chevron-up');
        s.previousElementSibling.querySelector('i').classList.add('fa-chevron-down');
      }
    });
    
    submenu.classList.toggle('show');
    if (icon) {
      icon.classList.toggle('fa-chevron-down');
      icon.classList.toggle('fa-chevron-up');
    }
  }
  
  return false;
}

// Utility Functions
function formatCurrency(amount) {
  return new Intl.NumberFormat('en-IN', {
    style: 'currency',
    currency: 'INR',
    maximumFractionDigits: 0
  }).format(amount);
}

function formatDate(dateString) {
  return new Date(dateString).toLocaleDateString('en-IN', {
    day: '2-digit',
    month: 'short',
    year: 'numeric'
  });
}
