/**
 * Live Search / Autocomplete for Compured Perú
 * Implements debounced search with real-time product suggestions
 */

class LiveSearch {
  constructor(inputSelector, dropdownSelector) {
    this.input = document.querySelector(inputSelector);
    this.dropdown = document.querySelector(dropdownSelector);
    this.debounceTimer = null;
    this.debounceDelay = 300; // milliseconds
    this.minQueryLength = 2;
    this.apiUrl = '/api/buscar';
    
    if (this.input && this.dropdown) {
      this.init();
    }
  }

  init() {
    // Input event with debounce
    this.input.addEventListener('input', (e) => {
      const query = e.target.value.trim();
      clearTimeout(this.debounceTimer);
      
      if (query.length < this.minQueryLength) {
        this.hideDropdown();
        return;
      }
      
      this.debounceTimer = setTimeout(() => {
        this.fetchSuggestions(query);
      }, this.debounceDelay);
    });

    // Hide dropdown when clicking outside
    document.addEventListener('click', (e) => {
      if (!this.input.contains(e.target) && !this.dropdown.contains(e.target)) {
        this.hideDropdown();
      }
    });

    // Hide dropdown on escape key, allow Enter to submit form
    this.input.addEventListener('keydown', (e) => {
      if (e.key === 'Escape') {
        this.hideDropdown();
      }
      // Enter key will naturally submit the form since input is wrapped in form
    });

    // Show dropdown on focus if there's a query
    this.input.addEventListener('focus', () => {
      const query = this.input.value.trim();
      if (query.length >= this.minQueryLength) {
        this.fetchSuggestions(query);
      }
    });
  }

  async fetchSuggestions(query) {
    try {
      const response = await fetch(`${this.apiUrl}?q=${encodeURIComponent(query)}`);
      const products = await response.json();
      
      if (products.length > 0) {
        this.renderDropdown(products);
      } else {
        this.hideDropdown();
      }
    } catch (error) {
      console.error('Error fetching search suggestions:', error);
      this.hideDropdown();
    }
  }

  renderDropdown(products) {
    this.dropdown.innerHTML = products.map(product => `
      <a href="${product.url}" class="cp-search-result-item">
        <div class="cp-search-result-image">
          ${product.imagen 
            ? `<img src="${product.imagen}" alt="${product.nombre}" loading="lazy">` 
            : `<div class="cp-search-result-placeholder">📦</div>`
          }
        </div>
        <div class="cp-search-result-info">
          <div class="cp-search-result-name">${this.highlightMatch(product.nombre, this.input.value)}</div>
          <div class="cp-search-result-brand">${product.marca || ''}</div>
          <div class="cp-search-result-price">S/ ${parseFloat(product.precio).toFixed(2)}</div>
        </div>
        <div class="cp-search-result-arrow">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M9 18l6-6-6-6"/>
          </svg>
        </div>
      </a>
    `).join('');
    
    this.showDropdown();
  }

  highlightMatch(text, query) {
    if (!query) return text;
    const regex = new RegExp(`(${query.replace(/[.*+?^${}()|[\]\\]/g, '\\$&')})`, 'gi');
    return text.replace(regex, '<mark>$1</mark>');
  }

  showDropdown() {
    this.dropdown.style.display = 'block';
    // Add animation class
    this.dropdown.classList.add('cp-search-dropdown-visible');
  }

  hideDropdown() {
    this.dropdown.style.display = 'none';
    this.dropdown.classList.remove('cp-search-dropdown-visible');
  }
}

// Initialize live search for desktop
document.addEventListener('DOMContentLoaded', () => {
  // Desktop search
  const desktopSearch = new LiveSearch(
    '#cp-desktop-search-input',
    '#cp-desktop-search-dropdown'
  );

  // Mobile drawer search
  const mobileSearch = new LiveSearch(
    '#cp-mobile-search-input',
    '#cp-mobile-search-dropdown'
  );
});
