/**
 * Xendit Donation System - JavaScript Helper Functions
 * 
 * Utility functions untuk donation system yang menggunakan Xendit payment gateway
 * File ini bisa di-include di view untuk helper functions
 */

// ==========================================
// Donation Modal Functions
// ==========================================

/**
 * Open donation modal
 * @param {number} campaignId - Campaign ID
 * @param {number} treePrice - Price per tree
 */
function openDonationModal(campaignId, treePrice) {
    const modal = document.getElementById('donationModal');
    if (!modal) return;
    
    currentCampaignId = campaignId;
    currentTreePrice = treePrice;
    
    document.getElementById('campaignId').value = campaignId;
    document.getElementById('treePrice').value = treePrice;
    modal.classList.remove('hidden');
    modal.style.display = 'block';
    document.getElementById('treesCount').value = 1;
    updateAmount();
}

/**
 * Close donation modal
 */
function closeDonationModal() {
    const modal = document.getElementById('donationModal');
    if (!modal) return;
    
    modal.classList.add('hidden');
    modal.style.display = 'none';
    
    const form = document.getElementById('donationForm');
    if (form) form.reset();
}

/**
 * Increment trees count
 */
function incrementTrees() {
    const input = document.getElementById('treesCount');
    if (input) {
        input.value = parseInt(input.value || 1) + 1;
        updateAmount();
    }
}

/**
 * Decrement trees count (minimum 1)
 */
function decrementTrees() {
    const input = document.getElementById('treesCount');
    if (input && parseInt(input.value) > 1) {
        input.value = parseInt(input.value) - 1;
        updateAmount();
    }
}

/**
 * Update total donation amount
 */
function updateAmount() {
    const treesInput = document.getElementById('treesCount');
    const amountInput = document.getElementById('amount');
    const amountDisplay = document.getElementById('amountDisplay');
    
    if (!treesInput || !amountInput) return;
    
    const trees = parseInt(treesInput.value) || 1;
    const amount = trees * currentTreePrice;
    
    amountInput.value = amount;
    
    if (amountDisplay) {
        amountDisplay.textContent = new Intl.NumberFormat('id-ID').format(amount);
    }
}

// ==========================================
// API Requests
// ==========================================

/**
 * Create donation and get Xendit invoice
 * @param {FormData} formData - Form data from donation form
 * @returns {Promise} Response from server
 */
async function submitDonation(formData) {
    try {
        const response = await fetch('/donate', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('[name="_token"]').value,
                'Accept': 'application/json',
            },
            body: formData
        });
        
        const data = await response.json();
        
        if (!response.ok) {
            throw new Error(data.message || 'Failed to create donation');
        }
        
        return data;
    } catch (error) {
        console.error('Donation error:', error);
        throw error;
    }
}

/**
 * Check donation payment status
 * @param {number} donationId - Donation ID
 * @returns {Promise} Donation status
 */
async function checkDonationStatus(donationId) {
    try {
        const response = await fetch(`/donation/${donationId}/status`);
        const data = await response.json();
        return data;
    } catch (error) {
        console.error('Status check error:', error);
        throw error;
    }
}

/**
 * Get donation details
 * @param {number} donationId - Donation ID
 * @returns {Promise} Donation details
 */
async function getDonationDetails(donationId) {
    try {
        const response = await fetch(`/donation/${donationId}`);
        const data = await response.json();
        return data;
    } catch (error) {
        console.error('Get donation error:', error);
        throw error;
    }
}

// ==========================================
// UI Utilities
// ==========================================

/**
 * Format Indonesian currency
 * @param {number} amount - Amount to format
 * @returns {string} Formatted amount (e.g., "250.000")
 */
function formatIDRCurrency(amount) {
    return new Intl.NumberFormat('id-ID').format(amount);
}

/**
 * Show loading state
 * @param {HTMLElement} element - Element to show loading
 */
function showLoading(element) {
    if (!element) return;
    element.innerHTML = '<i class="fas fa-spinner animate-spin"></i> Loading...';
    element.disabled = true;
}

/**
 * Hide loading state
 * @param {HTMLElement} element - Element to hide loading
 * @param {string} text - Button text to restore
 */
function hideLoading(element, text = 'Submit') {
    if (!element) return;
    element.innerHTML = text;
    element.disabled = false;
}

/**
 * Show toast/notification
 * @param {string} message - Message to show
 * @param {string} type - Type: 'success', 'error', 'warning', 'info'
 */
function showNotification(message, type = 'info') {
    const className = {
        success: 'bg-green-100 text-green-700',
        error: 'bg-red-100 text-red-700',
        warning: 'bg-yellow-100 text-yellow-700',
        info: 'bg-blue-100 text-blue-700'
    }[type] || 'bg-gray-100 text-gray-700';
    
    const notification = document.createElement('div');
    notification.className = `fixed top-4 right-4 p-4 rounded-lg ${className} z-50`;
    notification.textContent = message;
    
    document.body.appendChild(notification);
    
    // Auto remove after 5 seconds
    setTimeout(() => {
        notification.remove();
    }, 5000);
}

// ==========================================
// Modal Event Handlers
// ==========================================

/**
 * Setup donation form event listeners
 */
function setupDonationFormListener() {
    const form = document.getElementById('donationForm');
    if (!form) return;
    
    form.addEventListener('submit', async (e) => {
        e.preventDefault();
        
        const submitBtn = form.querySelector('button[type="submit"]');
        const loadingSpinner = document.getElementById('loadingSpinner');
        
        try {
            // Show loading state
            if (submitBtn) submitBtn.style.display = 'none';
            if (loadingSpinner) loadingSpinner.classList.remove('hidden');
            
            // Prepare form data
            const formData = new FormData(form);
            
            // Submit donation
            const response = await submitDonation(formData);
            
            if (response.status === 'success') {
                // Store donation ID
                sessionStorage.setItem('donationId', response.donation_id);
                
                // Show success notification
                showNotification('Redirecting to payment...', 'success');
                
                // Redirect to Xendit
                setTimeout(() => {
                    window.location.href = response.invoice_url;
                }, 1000);
            } else {
                throw new Error(response.message || 'Unknown error');
            }
        } catch (error) {
            console.error('Form submission error:', error);
            showNotification(error.message || 'Terjadi kesalahan', 'error');
            
            // Restore button state
            if (submitBtn) submitBtn.style.display = 'block';
            if (loadingSpinner) loadingSpinner.classList.add('hidden');
        }
    });
}

/**
 * Setup modal close on outside click
 */
function setupModalCloseListener() {
    const modal = document.getElementById('donationModal');
    if (!modal) return;
    
    modal.addEventListener('click', (e) => {
        if (e.target === modal) {
            closeDonationModal();
        }
    });
}

// ==========================================
// Page Load Initialization
// ==========================================

/**
 * Initialize donation system
 */
function initDonationSystem() {
    console.log('Initializing donation system...');
    
    setupDonationFormListener();
    setupModalCloseListener();
    
    // Check if coming from Xendit payment
    const donationId = sessionStorage.getItem('donationId');
    if (donationId) {
        console.log('Checking payment status for donation:', donationId);
        checkDonationStatus(donationId)
            .then(data => {
                if (data.data.payment_status === 'paid') {
                    showNotification('Pembayaran berhasil!', 'success');
                    sessionStorage.removeItem('donationId');
                    // Optionally reload or redirect
                }
            })
            .catch(error => {
                console.error('Payment check error:', error);
            });
    }
}

// Initialize on DOM ready
if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', initDonationSystem);
} else {
    initDonationSystem();
}

// ==========================================
// Polling for payment completion
// ==========================================

/**
 * Poll donation status until paid
 * @param {number} donationId - Donation ID
 * @param {number} interval - Poll interval in ms (default 5000)
 * @param {number} maxAttempts - Max polling attempts (default 60 = 5 min)
 */
async function pollDonationStatus(donationId, interval = 5000, maxAttempts = 60) {
    let attempts = 0;
    
    const checkPayment = async () => {
        try {
            const data = await checkDonationStatus(donationId);
            
            if (data.data.payment_status === 'paid') {
                console.log('Payment confirmed!');
                return true;
            }
            
            if (data.data.payment_status === 'expired' || 
                data.data.payment_status === 'failed') {
                console.log('Payment failed or expired');
                return false;
            }
            
            // Continue polling
            attempts++;
            if (attempts < maxAttempts) {
                setTimeout(checkPayment, interval);
            } else {
                console.log('Max polling attempts reached');
            }
        } catch (error) {
            console.error('Polling error:', error);
        }
    };
    
    checkPayment();
}

// ==========================================
// Export untuk digunakan di module
// ==========================================

if (typeof module !== 'undefined' && module.exports) {
    module.exports = {
        openDonationModal,
        closeDonationModal,
        incrementTrees,
        decrementTrees,
        updateAmount,
        submitDonation,
        checkDonationStatus,
        getDonationDetails,
        formatIDRCurrency,
        showLoading,
        hideLoading,
        showNotification,
        setupDonationFormListener,
        setupModalCloseListener,
        initDonationSystem,
        pollDonationStatus
    };
}
