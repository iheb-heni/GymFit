@extends('layouts.guest')

@section('content')
<div class="auth-container">
    <div class="auth-card">
        <div class="auth-header">
            <div class="logo-section">
                <img src="{{ asset('images/iconnn.png') }}" alt="GymNationTN" class="logo">
                <h1>Welcome Back</h1>
                <p>Sign in to your GymNationTN account</p>
            </div>
        </div>

        <form method="POST" action="{{ route('login') }}" class="auth-form" id="loginForm">
            @csrf
            
            <!-- Session Status -->
            @if (session('status'))
                <div class="alert alert-success">
                    <i class="material-icons">check_circle</i>
                    {{ session('status') }}
                </div>
            @endif

            <!-- Email Address -->
            <div class="form-group">
                <label for="email" class="form-label">
                    <i class="material-icons">email</i>
                    Email Address
                </label>
                <div class="input-wrapper">
                    <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username" class="form-input" placeholder="Enter your email" />
                    <span class="input-focus"></span>
                </div>
                @error('email')
                    <div class="error-message">
                        <i class="material-icons">error</i>
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <!-- Password -->
            <div class="form-group">
                <label for="password" class="form-label">
                    <i class="material-icons">lock</i>
                    Password
                </label>
                <div class="input-wrapper">
                    <input id="password" type="password" name="password" required autocomplete="current-password" class="form-input" placeholder="Enter your password" />
                    <button type="button" class="password-toggle" onclick="togglePassword()">
                        <i class="material-icons" id="passwordIcon">visibility</i>
                    </button>
                    <span class="input-focus"></span>
                </div>
                @error('password')
                    <div class="error-message">
                        <i class="material-icons">error</i>
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <!-- Remember Me & Forgot Password -->
            <div class="form-options">
                <label for="remember_me" class="checkbox-wrapper">
                    <input id="remember_me" type="checkbox" name="remember" />
                    <span class="checkmark"></span>
                    <span class="checkbox-label">Remember me</span>
                </label>

                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}" class="forgot-link">
                        Forgot password?
                    </a>
                @endif
            </div>

            <button type="submit" class="auth-button" id="loginButton">
                <span class="button-text">Sign In</span>
                <div class="button-loader" style="display: none;">
                    <div class="spinner"></div>
                </div>
            </button>

            <div class="auth-footer">
                <p>Don't have an account? 
                    <a href="{{ route('register') }}" class="auth-link">Create one here</a>
                </p>
            </div>
        </form>
    </div>
</div>

<style>
.auth-container {
    min-height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    padding: 20px;
}

.auth-card {
    background: white;
    border-radius: 20px;
    box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
    overflow: hidden;
    width: 100%;
    max-width: 450px;
    animation: slideUp 0.6s ease-out;
}

@keyframes slideUp {
    from {
        opacity: 0;
        transform: translateY(30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.auth-header {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    padding: 40px 30px;
    text-align: center;
}

.logo {
    width: 60px;
    height: 60px;
    margin-bottom: 20px;
    border-radius: 50%;
    background: white;
    padding: 10px;
}

.auth-header h1 {
    margin: 0 0 10px 0;
    font-size: 28px;
    font-weight: 600;
}

.auth-header p {
    margin: 0;
    opacity: 0.9;
    font-size: 16px;
}

.auth-form {
    padding: 40px 30px;
}

.form-group {
    margin-bottom: 25px;
}

.form-label {
    display: flex;
    align-items: center;
    margin-bottom: 8px;
    font-weight: 500;
    color: #333;
    font-size: 14px;
}

.form-label i {
    margin-right: 8px;
    font-size: 18px;
    color: #667eea;
}

.input-wrapper {
    position: relative;
}

.form-input {
    width: 100%;
    padding: 15px 20px;
    border: 2px solid #e1e5e9;
    border-radius: 12px;
    font-size: 16px;
    transition: all 0.3s ease;
    background: #f8f9fa;
    box-sizing: border-box;
}

.form-input:focus {
    outline: none;
    border-color: #667eea;
    background: white;
    box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
}

.input-focus {
    position: absolute;
    bottom: 0;
    left: 0;
    width: 0;
    height: 2px;
    background: #667eea;
    transition: width 0.3s ease;
}

.form-input:focus + .input-focus {
    width: 100%;
}

.password-toggle {
    position: absolute;
    right: 15px;
    top: 50%;
    transform: translateY(-50%);
    background: none;
    border: none;
    color: #666;
    cursor: pointer;
    padding: 5px;
    border-radius: 4px;
    transition: color 0.3s ease;
}

.password-toggle:hover {
    color: #667eea;
}

.form-options {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 30px;
}

.checkbox-wrapper {
    display: flex;
    align-items: center;
    cursor: pointer;
    font-size: 14px;
}

.checkbox-wrapper input[type="checkbox"] {
    display: none;
}

.checkmark {
    width: 20px;
    height: 20px;
    border: 2px solid #e1e5e9;
    border-radius: 4px;
    margin-right: 10px;
    position: relative;
    transition: all 0.3s ease;
}

.checkbox-wrapper input[type="checkbox"]:checked + .checkmark {
    background: #667eea;
    border-color: #667eea;
}

.checkbox-wrapper input[type="checkbox"]:checked + .checkmark::after {
    content: '✓';
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    color: white;
    font-size: 12px;
    font-weight: bold;
}

.forgot-link {
    color: #667eea;
    text-decoration: none;
    font-size: 14px;
    font-weight: 500;
    transition: color 0.3s ease;
}

.forgot-link:hover {
    color: #764ba2;
    text-decoration: underline;
}

.auth-button {
    width: 100%;
    padding: 15px;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    border: none;
    border-radius: 12px;
    font-size: 16px;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
    position: relative;
    overflow: hidden;
}

.auth-button:hover {
    transform: translateY(-2px);
    box-shadow: 0 10px 20px rgba(102, 126, 234, 0.3);
}

.auth-button:active {
    transform: translateY(0);
}

.button-loader {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
}

.spinner {
    width: 20px;
    height: 20px;
    border: 2px solid rgba(255, 255, 255, 0.3);
    border-top: 2px solid white;
    border-radius: 50%;
    animation: spin 1s linear infinite;
}

@keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
}

.auth-footer {
    text-align: center;
    margin-top: 30px;
    padding-top: 20px;
    border-top: 1px solid #e1e5e9;
}

.auth-footer p {
    margin: 0;
    color: #666;
    font-size: 14px;
}

.auth-link {
    color: #667eea;
    text-decoration: none;
    font-weight: 600;
    transition: color 0.3s ease;
}

.auth-link:hover {
    color: #764ba2;
    text-decoration: underline;
}

.error-message {
    display: flex;
    align-items: center;
    margin-top: 8px;
    color: #e74c3c;
    font-size: 14px;
}

.error-message i {
    margin-right: 5px;
    font-size: 16px;
}

.alert {
    padding: 15px 20px;
    border-radius: 12px;
    margin-bottom: 20px;
    display: flex;
    align-items: center;
    font-size: 14px;
}

.alert-success {
    background: #d4edda;
    color: #155724;
    border: 1px solid #c3e6cb;
}

.alert-success i {
    margin-right: 10px;
    color: #28a745;
}

@media (max-width: 480px) {
    .auth-container {
        padding: 10px;
    }
    
    .auth-card {
        border-radius: 15px;
    }
    
    .auth-header {
        padding: 30px 20px;
    }
    
    .auth-form {
        padding: 30px 20px;
    }
}
</style>

<script>
function togglePassword() {
    const passwordInput = document.getElementById('password');
    const passwordIcon = document.getElementById('passwordIcon');
    
    if (passwordInput.type === 'password') {
        passwordInput.type = 'text';
        passwordIcon.textContent = 'visibility_off';
    } else {
        passwordInput.type = 'password';
        passwordIcon.textContent = 'visibility';
    }
}

document.getElementById('loginForm').addEventListener('submit', function() {
    const button = document.getElementById('loginButton');
    const buttonText = button.querySelector('.button-text');
    const buttonLoader = button.querySelector('.button-loader');
    
    button.disabled = true;
    buttonText.style.display = 'none';
    buttonLoader.style.display = 'block';
});

// Add input animations
document.querySelectorAll('.form-input').forEach(input => {
    input.addEventListener('focus', function() {
        this.parentElement.classList.add('focused');
    });
    
    input.addEventListener('blur', function() {
        if (!this.value) {
            this.parentElement.classList.remove('focused');
        }
    });
});
</script>
@endsection
