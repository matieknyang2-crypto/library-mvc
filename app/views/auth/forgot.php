<?php
// app/views/auth/forgot.php
?>
<div class="login-container">
    <div class="login-box">
        <div class="login-header">
            <div style="font-size: 3rem; margin-bottom: 0.5rem;">🔑</div>
            <h1>Reset Password</h1>
            <p>Enter your email to receive reset instructions</p>
        </div>

        <form method="POST" action="/library_mvc/public/index.php?url=auth/forgot">
            <div class="mb-3">
                <label for="email" class="form-label">
                    <span style="font-size: 1.2rem;">📧</span> Email Address
                </label>
                <input 
                    type="email" 
                    class="form-control login-input" 
                    id="email" 
                    name="email" 
                    placeholder="your@example.com"
                    required
                    autocomplete="email">
            </div>

            <div class="alert alert-info" role="alert" style="margin-bottom: 1.5rem;">
                <strong>Demo Mode:</strong> This feature is not active in demonstration mode. 
                <a href="/library_mvc/public/index.php?url=auth/login" class="alert-link">Return to login</a> to access your account.
            </div>

            <button type="submit" class="btn btn-primary w-100 login-btn" disabled>
                <span style="margin-right: 0.5rem;">📧</span>Send Reset Link
            </button>
        </form>

        <div class="login-divider">
            <span>or</span>
        </div>

        <div class="login-footer">
            <p class="text-center mb-2">Remember your password?</p>
            <a href="/library_mvc/public/index.php?url=auth/login" class="btn btn-outline-secondary w-100">
                <span style="margin-right: 0.5rem;">🔓</span>Sign In
            </a>
        </div>

        <div class="login-links">
            <a href="/library_mvc/public/index.php?url=home/index">Home</a>
            <span>•</span>
            <a href="/library_mvc/public/index.php?url=auth/register">Create Account</a>
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

.login-btn {
    background: linear-gradient(90deg, var(--primary) 0%, var(--primary-dark) 100%);
    border: none;
    padding: 0.75rem;
    font-weight: 600;
    margin-top: 0.5rem;
    transition: all 0.3s ease;
}

.login-btn:hover:not(:disabled) {
    transform: translateY(-2px);
    box-shadow: 0 6px 12px rgba(99, 102, 241, 0.3);
}

.login-btn:disabled {
    opacity: 0.6;
    cursor: not-allowed;
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
