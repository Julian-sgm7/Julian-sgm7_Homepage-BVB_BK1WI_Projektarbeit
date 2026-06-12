/**
 * Modern Search Bar
 * Live search with AJAX
 */

class SearchBar {
    constructor() {
        this.searchInput = document.querySelector('.search-input');
        this.searchResults = document.querySelector('.search-results');
        this.searchWrapper = document.querySelector('.search-wrapper');
        this.clearBtn = document.querySelector('.search-clear');
        this.searchTimeout = null;
        this.minChars = 1; // Sofort mit 1 Zeichen anzeigen
        
        // Bestimme den korrekten Pfad zu search.php
        this.searchPath = this.getSearchPath();
        
        this.init();
    }

    getSearchPath() {
        // Wenn wir in layouts/ sind, muss nur 'search.php' aufgerufen werden
        const currentPath = window.location.pathname;
        if (currentPath.includes('/layouts/')) {
            return 'search.php';
        }
        return 'layouts/search.php';
    }

    init() {
        // Event Listener für Input
        this.searchInput?.addEventListener('input', (e) => this.handleInput(e));
        this.searchInput?.addEventListener('keydown', (e) => this.handleKeydown(e));
        this.searchInput?.addEventListener('focus', (e) => this.handleFocus(e));
        
        // Clear Button
        this.clearBtn?.addEventListener('click', () => this.clearSearch());
        
        // Click außerhalb schließt Ergebnisse
        document.addEventListener('click', (e) => {
            if (!this.searchWrapper?.contains(e.target)) {
                this.closeResults();
            }
        });
    }

    handleInput(e) {
        const query = e.target.value.trim();
        
        // Input-Klasse für Clear-Button aktualisieren
        if (query.length > 0) {
            this.searchInput?.classList.add('has-value');
        } else {
            this.searchInput?.classList.remove('has-value');
        }
        
        // Debounce Search
        clearTimeout(this.searchTimeout);
        
        if (query.length < this.minChars) {
            // Wenn leer, alle Ergebnisse zeigen
            if (query.length === 0) {
                this.performSearch('');
            } else {
                this.closeResults();
            }
            return;
        }
        
        this.searchTimeout = setTimeout(() => {
            this.performSearch(query);
        }, 200);
    }

    handleFocus(e) {
        const query = e.target.value.trim();
        if (query.length >= this.minChars) {
            this.performSearch(query);
        } else {
            this.performSearch('');
        }
    }

    handleKeydown(e) {
        if (e.key === 'Escape') {
            this.closeResults();
            this.searchInput?.blur();
        }
        
        if (e.key === 'Enter') {
            e.preventDefault();
            const firstResult = this.searchResults?.querySelector('.search-result-item');
            if (firstResult) {
                firstResult.click();
            }
        }
    }

    performSearch(query) {
        // Loading state
        this.searchResults.innerHTML = '<div class="search-loading">Suchen</div>';
        this.searchResults?.classList.add('show');

        fetch(`${this.searchPath}?q=${encodeURIComponent(query)}`)
            .then(response => response.json())
            .then(results => this.displayResults(results, query))
            .catch(error => {
                console.error('Search error:', error);
                this.searchResults.innerHTML = '<div class="search-no-results">Fehler bei der Suche</div>';
            });
    }

    displayResults(results, query) {
        if (results.length === 0) {
            if (query === '') {
                this.searchResults.innerHTML = '<div class="search-no-results">Gib einen Suchbegriff ein...</div>';
            } else {
                this.searchResults.innerHTML = `<div class="search-no-results">Keine Ergebnisse für "${query}"</div>`;
            }
            return;
        }

        const html = results.map(result => {
            const isExternal = result.link.startsWith('http');
            const target = isExternal ? ' target="_blank" rel="noopener"' : '';
            const externalClass = isExternal ? ' external' : '';
            
            return `
                <a href="${result.link}"${target} class="search-result-item${externalClass}">
                    <span class="result-icon">${result.icon}</span>
                    <div class="result-info">
                        <div class="result-name">${this.highlightMatch(result.name, query)}</div>
                        <div class="result-type">${this.getTypeLabel(result.type)}</div>
                    </div>
                </a>
            `;
        }).join('');

        this.searchResults.innerHTML = html;
        
        // Click handler für Ergebnisse
        this.searchResults?.querySelectorAll('.search-result-item').forEach(item => {
            item.addEventListener('click', () => this.onResultClick());
        });
    }

    highlightMatch(text, query) {
        if (!query) return text;
        const regex = new RegExp(`(${query})`, 'gi');
        return text.replace(regex, '<strong style="color: #ffd700;">$1</strong>');
    }

    getTypeLabel(type) {
        const labels = {
            'shop': 'Shop',
            'tickets': 'Tickets',
            'team': 'Mannschaft',
            'page': 'Seite'
        };
        return labels[type] || type;
    }

    clearSearch() {
        this.searchInput.value = '';
        this.searchInput?.classList.remove('has-value');
        this.closeResults();
        this.searchInput?.focus();
    }

    closeResults() {
        this.searchResults?.classList.remove('show');
    }

    onResultClick() {
        this.clearSearch();
    }
}

// Initialisiere SearchBar wenn DOM geladen ist
document.addEventListener('DOMContentLoaded', () => {
    new SearchBar();
});
