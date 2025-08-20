 // Show alert if session storage has a id, role, or is_logged_in
        if (!sessionStorage.getItem('id') || !sessionStorage.getItem('role') || !sessionStorage.getItem('is_logged_in')) {
            window.location.href = '../../controllers/logout.php';
        }

        const role = sessionStorage.getItem('role');
        if (role && role !== 'admin') {
            // If the user is not an admin, redirect to the farmer dashboard
            window.location.href = '../../view/farmer/dashboard.html';
        }