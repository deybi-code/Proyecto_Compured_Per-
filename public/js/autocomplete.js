// 🔍 Sistema de Búsqueda Predictiva con Debounce
(function() {
    'use strict';

    // Configuración
    const DEBOUNCE_DELAY = 300; // ms
    const MIN_CHARS = 2;
    let debounceTimer = null;
    let currentAbortController = null;

    // Elementos del DOM
    const searchInputs = document.querySelectorAll('.cp-search-input');
    const searchContainers = document.querySelectorAll('.cp-search-container');

    // Crear dropdown de sugerencias
    function createDropdown(container) {
        const dropdown = document.createElement('div');
        dropdown.className = 'cp-search-dropdown';
        dropdown.style.display = 'none';
        container.appendChild(dropdown);
        return dropdown;
    }

    // Inicializar cada input de búsqueda
    searchInputs.forEach((input, index) => {
        const container = searchInputs[index] || input.parentElement;
        const dropdown = createDropdown(container);

        // Event listener con debounce
        input.addEventListener('input', function(e) {
            const query = e.target.value.trim();
            
            // Cancelar petición anterior si existe
            if (currentAbortController) {
                currentAbortController.abort();
            }

            // Limpiar timer anterior
            clearTimeout(debounceTimer);

            // Ocultar dropdown si query es muy corto
            if (query.length < MIN_CHARS) {
                dropdown.style.display = 'none';
                dropdown.innerHTML = '';
                return;
            }

            // Debounce
            debounceTimer = setTimeout(() => {
                fetchSuggestions(query, dropdown);
            }, DEBOUNCE_DELAY);
        });

        // Cerrar dropdown al hacer click fuera
        document.addEventListener('click', function(e) {
            if (!container.contains(e.target)) {
                dropdown.style.display = 'none';
            }
        });

        // Navegación con teclado
        input.addEventListener('keydown', function(e) {
            const items = dropdown.querySelectorAll('.cp-search-item');
            const activeItem = dropdown.querySelector('.cp-search-item.active');

            if (e.key === 'ArrowDown') {
                e.preventDefault();
                if (activeItem) {
                    activeItem.classList.remove('active');
                    const next = activeItem.nextElementSibling;
                    if (next) next.classList.add('active');
                } else if (items.length > 0) {
                    items[0].classList.add('active');
                }
            } else if (e.key === 'ArrowUp') {
                e.preventDefault();
                if (activeItem) {
                    activeItem.classList.remove('active');
                    const prev = activeItem.previousElementSibling;
                    if (prev) prev.classList.add('active');
                }
            } else if (e.key === 'Enter') {
                if (activeItem) {
                    e.preventDefault();
                    activeItem.click();
                }
            } else if (e.key === 'Escape') {
                dropdown.style.display = 'none';
            }
        });
    });

    // Fetch sugerencias desde API
    async function fetchSuggestions(query, dropdown) {
        currentAbortController = new AbortController();

        try {
            const response = await fetch(`/api/buscar?q=${encodeURIComponent(query)}`, {
                signal: currentAbortController.signal
            });

            if (!response.ok) throw new Error('Error en la petición');

            const products = await response.json();
            renderSuggestions(products, dropdown);
        } catch (error) {
            if (error.name !== 'AbortError') {
                console.error('Error fetching suggestions:', error);
            }
        } finally {
            currentAbortController = null;
        }
    }

    // Renderizar sugerencias
    function renderSuggestions(products, dropdown) {
        if (products.length === 0) {
            dropdown.style.display = 'none';
            dropdown.innerHTML = '';
            return;
        }

        dropdown.innerHTML = products.map(product => `
            <a href="${product.url}" class="cp-search-item">
                <div class="cp-search-item-image">
                    ${product.imagen 
                        ? `<img src="${product.imagen}" alt="${product.nombre}" loading="lazy">` 
                        : '<div class="cp-search-item-placeholder">📦</div>'
                    }
                </div>
                <div class="cp-search-item-content">
                    <div class="cp-search-item-name">${product.nombre}</div>
                    <div class="cp-search-item-brand">${product.marca}</div>
                    <div class="cp-search-item-price">S/ ${parseFloat(product.precio).toFixed(2)}</div>
                </div>
            </a>
        `).join('');

        dropdown.style.display = 'block';

        // Agregar event listeners para navegación
        const items = dropdown.querySelectorAll('.cp-search-item');
        items.forEach(item => {
            item.addEventListener('mouseenter', function() {
                items.forEach(i => i.classList.remove('active'));
                this.classList.add('active');
            });
            item.addEventListener('mouseleave', function() {
                this.classList.remove('active');
            });
        });
    }
})();
