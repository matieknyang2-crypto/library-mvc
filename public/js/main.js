/**
 * Library Management System - Custom JavaScript
 * Handles UI enhancements, confirmations, and form validations.
 */

document.addEventListener('DOMContentLoaded', function() {
    const globalLoader = document.getElementById('globalLoader');

    function showLoader() {
        if (!globalLoader) {
            return;
        }
        globalLoader.classList.add('active');
        globalLoader.setAttribute('aria-hidden', 'false');
    }

    // Show loader for non-GET forms and for links/buttons marked with data-loading
    document.querySelectorAll('form').forEach(function(form) {
        form.addEventListener('submit', function() {
            const method = (form.getAttribute('method') || 'GET').toUpperCase();
            if (method !== 'GET') {
                showLoader();
            }
        });
    });

    document.querySelectorAll('a[data-loading], button[data-loading]').forEach(function(element) {
        element.addEventListener('click', function() {
            showLoader();
        });
    });
    
    // Auto-dismiss flash messages after 5 seconds
    const flashMessages = document.querySelectorAll('.alert');
    flashMessages.forEach(function(alert) {
        setTimeout(function() {
            alert.style.transition = 'opacity 0.5s';
            alert.style.opacity = '0';
            setTimeout(function() {
                alert.remove();
            }, 500);
        }, 5000);
    });

    // Confirm delete actions (already in onclick, but this is an extra layer)
    const deleteLinks = document.querySelectorAll('a.btn-danger[onclick]');
    deleteLinks.forEach(function(link) {
        link.addEventListener('click', function(e) {
            if (!confirm('Are you sure you want to delete this item? This action cannot be undone.')) {
                e.preventDefault();
            }
        });
    });

    // Validate available copies in book edit form (if present)
    const editBookForm = document.querySelector('form[action*="book/edit"]');
    if (editBookForm) {
        const totalCopiesInput = document.getElementById('total_copies');
        const availableCopiesInput = document.getElementById('available_copies');
        
        if (totalCopiesInput && availableCopiesInput) {
            function validateAvailableCopies() {
                const total = parseInt(totalCopiesInput.value) || 0;
                const available = parseInt(availableCopiesInput.value) || 0;
                if (available > total) {
                    availableCopiesInput.setCustomValidity('Available copies cannot exceed total copies.');
                } else {
                    availableCopiesInput.setCustomValidity('');
                }
            }
            
            totalCopiesInput.addEventListener('input', validateAvailableCopies);
            availableCopiesInput.addEventListener('input', validateAvailableCopies);
        }
    }

    // Auto-submit filter form when category dropdown changes (optional)
    const filterForm = document.querySelector('form[action*="book/index"]');
    if (filterForm) {
        const categorySelect = filterForm.querySelector('select[name="category_id"]');
        if (categorySelect) {
            categorySelect.addEventListener('change', function() {
                filterForm.submit();
            });
        }
    }

    // Highlight overdue rows in tables (if any)
    const overdueTables = document.querySelectorAll('table');
    overdueTables.forEach(function(table) {
        const rows = table.querySelectorAll('tbody tr');
        rows.forEach(function(row) {
            const statusCell = row.querySelector('td .badge.bg-danger');
            if (statusCell && statusCell.textContent.trim() === 'Overdue') {
                row.style.backgroundColor = '#fff3f3';
            }
        });
    });

    // Tooltip initialization (if using Bootstrap)
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });
});