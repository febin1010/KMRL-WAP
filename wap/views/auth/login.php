<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Access Permit Portal | Admin Sign In</title>
    <script src="https://unpkg.com/lucide@latest"></script>
    <link rel="stylesheet" href="../../styles/style.css">
</head>
<body>
    <header>
        <div class="header-content">
            <div class="logo-section">
                <a href="/" class="logo">
                    <img src="../../assets/images/KMRL-logo.png" alt="Company Logo">
                </a>
                <div class="portal-title">
                    <h1>WORK ACCESS PERMIT PORTAL</h1>
                    <h2>SECURE AUTHENTICATION SYSTEM</h2>
                </div>
            </div>
        </div>
    </header>

    <main>
        <div class="login-container">
            <div class="login-header">
                <h2>Welcome Back</h2>
                <p>Please sign in to access your portal</p>
            </div>
            <form id="loginForm" action="../../routes/router.php?action=login" method="post">
                <div class="form-group">
                    <label for="email">USER-ID</label>
                    <div class="input-container">
                        <input 
                            id="email" 
                            name="email" 
                            placeholder="Enter your User-ID"
                            required
                            autocomplete="email"
                        >
                    </div>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <div class="input-container">
                        <input 
                            type="password" 
                            id="password" 
                            name="password" 
                            placeholder="Enter your password"
                            required
                            autocomplete="off"
                            value=""
                        >
                        <button 
                            type="button" 
                            class="password-toggle" 
                            aria-label="Toggle password visibility"
                            onclick="togglePassword()"
                        >
                            <i id="passwordToggleIcon" data-lucide="eye"></i>   
                        </button>
                    </div>
                    <div class="error-message">Invalid password format</div>
                </div>                
                <button type="submit" class="submit-btn" id="submitButton">
                    Sign In
                </button>
                <div class="success-message">Successfully logged in!</div>
            </form>
        </div>
    </main>

    <footer>
        <div class="footer-content">
            <div class="footer-links">
                <a href="https://kochimetro.org/privacy-policy/">Privacy Policy</a>
                <a href="https://kochimetro.org/contact-us/">Contact Support</a>
            </div>
            <div class="copyright">
                &copy; 2025 Work Access Permit Portal IT Department. All rights reserved.
            </div>
        </div>
    </footer>

    <script>
// Initialize Lucide icons
lucide.createIcons();

// Password visibility toggle
function togglePassword() {
    const passwordInput = document.getElementById('password');
    const icon = document.getElementById('passwordToggleIcon');

    if (passwordInput.type === 'password') {
        passwordInput.type = 'text';
        icon.setAttribute('data-lucide', 'eye-off');
    } else {
        passwordInput.type = 'password';
        icon.setAttribute('data-lucide', 'eye');
    }

    // Reinitialize icons to reflect changes
    lucide.createIcons();
}

// Handle form submission
async function handleLogin(event) {
    event.preventDefault();
    const button = document.getElementById('submitButton');
    const passwordField = document.getElementById('password');
    const successMessage = document.querySelector('.success-message');
    const errorMessage = document.querySelector('.error-message');

    // Reset messages
    successMessage.style.display = 'none';
    errorMessage.style.display = 'none';

    // Check password format after form submission
    if (passwordField.value.length < 5) {
        errorMessage.style.display = 'block';
        return;
    }

    button.classList.add('loading');

    // Collect form data
    const formData = new FormData(event.target);

    try {
            const response = await fetch('../../routes/router.php?action=login', {
            method: 'POST',
            body: formData
        });

        const result = await response.json(); 

        if (result.success) {
            successMessage.style.display = 'block';

            // Clear password field
            passwordField.value = '';

            // Hide success message after a delay and redirect
            setTimeout(() => {
                successMessage.style.display = 'none';
                window.location.href = result.redirect;
            }, 1000);
        } else {
            alert(result.message || 'Invalid credentials. Please try again.');
        }
    } catch (error) {
        alert('An error occurred. Please try again.');
        console.error('Login error:', error);
    }

    button.classList.remove('loading');
}

document.getElementById('loginForm').addEventListener('submit', handleLogin);
    </script>
</body>
</html>
