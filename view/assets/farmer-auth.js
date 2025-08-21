// Check if user is logged in by verifying all required session items exist
const role = sessionStorage.getItem('role');
const isLoggedIn = sessionStorage.getItem('is_logged_in');

if (!isLoggedIn) {
    window.location.href = '../../index.html?warning=You must be logged in to access this page.';
}

if (role && role !== 'farmer') {
    // If the user is not a farmer, redirect to the admin dashboard
    window.location.href = '../../view/admin/dashboard.html';
}