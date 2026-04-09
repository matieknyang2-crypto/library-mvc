<?php
// app/views/auth/register.php
?>
<div class="login-container">
    <div class="login-box">
        <div class="login-header">
            <div style="font-size: 3rem; margin-bottom: 0.5rem;">📚</div>
            <h1>Create Account</h1>
            <p>Join our library community</p>
        </div>

        <form method="POST" action="/library_mvc/public/index.php?url=auth/register" id="registerForm" aria-label="Registration form">
            <div class="mb-3">
                <label for="name" class="form-label">
                    <span style="font-size: 1.2rem;">👤</span> Full Name
                </label>
                <input 
                    type="text" 
                    class="form-control login-input" 
                    id="name" 
                    name="name" 
                    placeholder="John Doe"
                    required
                    aria-label="Full name">
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">
                    <span style="font-size: 1.2rem;">📧</span> Email Address
                </label>
                <input 
                    type="email" 
                    class="form-control login-input" 
                    id="email" 
                    name="email" 
                    placeholder="you@example.com"
                    required
                    aria-label="Email address">
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">
                    <span style="font-size: 1.2rem;">🔐</span> Password
                </label>
                <div class="password-wrapper">
                    <input 
                        type="password" 
                        class="form-control login-input" 
                        id="password" 
                        name="password" 
                        placeholder="At least 6 characters"
                        required
                        minlength="6"
                        aria-label="Password">
                    <button type="button" class="password-toggle" id="togglePassword" aria-label="Show password" aria-pressed="false" aria-controls="password">
                        👁️
                    </button>
                </div>
            </div>

            <div class="mb-3">
                <label for="password_confirm" class="form-label">
                    <span style="font-size: 1.2rem;">✓</span> Confirm Password
                </label>
                <div class="password-wrapper">
                    <input 
                        type="password" 
                        class="form-control login-input" 
                        id="password_confirm" 
                        name="password_confirm" 
                        placeholder="Confirm your password"
                        required
                        aria-label="Confirm password">
                    <button type="button" class="password-toggle" id="toggleConfirmPassword" aria-label="Show confirm password" aria-pressed="false" aria-controls="password_confirm">
                        👁️
                    </button>
                </div>
            </div>

            <div class="mb-3 form-check">
                <input 
                    type="checkbox" 
                    class="form-check-input" 
                    id="agree" 
                    name="agree"
                    required
                    aria-label="Agree to terms and conditions">
                <label class="form-check-label" for="agree">
                    I agree to the terms and conditions
                </label>
            </div>

            <button type="submit" class="btn btn-primary w-100 login-btn" aria-label="Create account">
                <span style="margin-right: 0.5rem;">✍️</span>Create Account
            </button>
        </form>

        <div class="login-divider">
            <span>or</span>
        </div>

        <div class="login-footer">
            <p class="text-center mb-2">Already have an account?</p>
            <a href="/library_mvc/public/index.php?url=auth/login" class="btn btn-outline-secondary w-100" aria-label="Go to login page">
                <span style="margin-right: 0.5rem;">🔓</span>Sign In
            </a>
        </div>

        <div class="login-links">
            <a href="/library_mvc/public/index.php?url=home/index" aria-label="Go to home page">Home</a>
            <span>•</span>
            <a href="/library_mvc/public/index.php?url=book/index" aria-label="Browse books catalog">Browse Books</a>
        </div>
    </div>
</div>

<style>
.login-container {
    min-height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 1.5rem;
}

.login-box {
    background: white;
    border-radius: 16px;
    box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
    padding: 2.5rem;
    width: 100%;
    max-width: 420px;
    animation: slideUp 0.4s ease-out;
}

@keyframes slideUp {
    from {
        opacity: 0;
        transform: translateY(20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.login-header {
    text-align: center;
    margin-bottom: 2rem;
}

.login-header h1 {
    font-size: 1.75rem;
    font-weight: 700;
    color: #1f2937;
    margin-bottom: 0.25rem;
}

.login-header p {
    color: #6b7280;
    font-size: 0.95rem;
}

.login-input {
    border: 2px solid #e5e7eb;
    border-radius: 8px;
    padding: 0.75rem 1rem;
    font-size: 1rem;
    transition: all 0.3s ease;
}

.login-input:focus {
    border-color: var(--primary);
    box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.1);
    background-color: #f9fbfd;
}

.password-wrapper {
    position: relative;
    display: flex;
    align-items: center;
}

.password-wrapper input {
    width: 100%;
    padding-right: 2.5rem;
}

.password-toggle {
    position: absolute;
    right: 10px;
    background: none;
    border: none;
    cursor: pointer;
    font-size: 1.2rem;
    opacity: 0.6;
    transition: opacity 0.2s;
    padding: 0.5rem;
}

.password-toggle:hover {
    opacity: 1;
}

.login-btn {
    background: linear-gradient(90deg, var(--primary) 0%, var(--primary-dark) 100%);
    border: none;
    padding: 0.75rem;
    font-weight: 600;
    margin-top: 0.5rem;
    transition: all 0.3s ease;
}

.login-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 12px rgba(99, 102, 241, 0.3);
}

.login-divider {
    text-align: center;
    margin: 1.5rem 0;
    position: relative;
    color: #d1d5db;
    font-weight: 500;
}

.login-divider::before {
    content: '';
    position: absolute;
    top: 50%;
    left: 0;
    right: 0;
    height: 1px;
    background: #e5e7eb;
    z-index: 0;
}

.login-divider span {
    background: white;
    padding: 0 0.75rem;
    position: relative;
    z-index: 1;
}

.login-footer {
    margin: 1.5rem 0;
}

.btn-outline-secondary {
    color: #6b7280;
    border: 2px solid #d1d5db;
    background: white;
    font-weight: 600;
    transition: all 0.3s ease;
}

.btn-outline-secondary:hover {
    color: #1f2937;
    border-color: #6b7280;
    background: #f9fafb;
}

.login-links {
    text-align: center;
    font-size: 0.875rem;
    margin-top: 1.5rem;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 0.5rem;
}

.login-links a {
    color: var(--primary);
    text-decoration: none;
    font-weight: 500;
    transition: opacity 0.2s;
}

.login-links a:hover {
    opacity: 0.8;
    text-decoration: underline;
}

@media (max-width: 768px) {
    .login-box {
        padding: 1.5rem;
    }

    .login-container {
        padding: 1rem;
    }
}
</style>

<script>
document.getElementById('togglePassword').addEventListener('click', function() {
    const passwordInput = document.getElementById('password');
    const isPassword = passwordInput.type === 'password';
    passwordInput.type = isPassword ? 'text' : 'password';
    this.textContent = isPassword ? '🙈' : '👁️';
    this.setAttribute('aria-pressed', isPassword ? 'true' : 'false');
    this.setAttribute('aria-label', isPassword ? 'Hide password' : 'Show password');
});

document.getElementById('toggleConfirmPassword').addEventListener('click', function() {
    const passwordInput = document.getElementById('password_confirm');
    const isPassword = passwordInput.type === 'password';
    passwordInput.type = isPassword ? 'text' : 'password';
    this.textContent = isPassword ? '🙈' : '👁️';
    this.setAttribute('aria-pressed', isPassword ? 'true' : 'false');
    this.setAttribute('aria-label', isPassword ? 'Hide confirm password' : 'Show confirm password');
});

// Validate password match on submit
document.getElementById('registerForm').addEventListener('submit', function(e) {
    const password = document.getElementById('password').value;
    const passwordConfirm = document.getElementById('password_confirm').value;
    
    if (password !== passwordConfirm) {
        e.preventDefault();
        alert('Passwords do not match!');
        return false;
    }
});
</script>
