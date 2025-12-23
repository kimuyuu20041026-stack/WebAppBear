<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>ログイン - Bear Web Application</title>
    
    <style>
        /* Reset and Base Styles */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', 'Roboto', 'Oxygen', 'Ubuntu', 'Cantarell', 'Fira Sans', 'Droid Sans', 'Helvetica Neue', sans-serif;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
        }

        /* Container */
        .login-container {
            min-height: 100vh;
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 1rem;
            background: linear-gradient(to bottom right, #f0fdf4, #d1fae5);
        }

        /* Card */
        .login-card {
            width: 100%;
            max-width: 28rem;
            padding: 2rem;
            background: white;
            border-radius: 0.75rem;
            border: 1px solid #e5e7eb;
            box-shadow: 0 20px 25px -5px rgb(0 0 0 / 0.1), 0 8px 10px -6px rgb(0 0 0 / 0.1);
        }

        /* Header */
        .login-header {
            margin-bottom: 1.5rem;
            text-align: center;
        }

        .app-name {
            font-size: 1.125rem;
            font-weight: 600;
            color: #374151;
            margin-bottom: 0.5rem;
        }

        .login-title {
            font-size: 1.875rem;
            font-weight: bold;
            letter-spacing: -0.025em;
            margin-bottom: 0.5rem;
        }

        .login-description {
            color: #6b7280;
            font-size: 0.875rem;
        }

        /* Form */
        .login-form {
            margin-bottom: 1.5rem;
        }

        .form-group {
            margin-bottom: 1rem;
        }

        .form-label {
            display: block;
            font-size: 0.875rem;
            font-weight: 500;
            margin-bottom: 0.5rem;
        }

        .input-wrapper {
            position: relative;
        }

        .input-icon {
            position: absolute;
            left: 0.75rem;
            top: 50%;
            transform: translateY(-50%);
            width: 1.25rem;
            height: 1.25rem;
            color: #6b7280;
        }

        .form-input {
            display: flex;
            height: 2.25rem;
            width: 100%;
            border-radius: 0.375rem;
            border: 1px solid #d1d5db;
            background-color: white;
            padding: 0.25rem 0.75rem;
            padding-left: 2.5rem;
            font-size: 0.875rem;
            transition: all 0.2s;
            outline: none;
        }

        .form-input.has-icon-right {
            padding-right: 2.5rem;
        }

        .form-input:focus {
            border-color: #3b82f6;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.5);
        }

        .form-input::placeholder {
            color: #9ca3af;
        }

        .toggle-password {
            position: absolute;
            right: 0.75rem;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            cursor: pointer;
            color: #6b7280;
            transition: color 0.2s;
            padding: 0;
        }

        .toggle-password:hover {
            color: #374151;
        }

        .toggle-password svg {
            width: 1.25rem;
            height: 1.25rem;
        }

        .error-message {
            font-size: 0.875rem;
            color: #dc2626;
            margin-top: 0.25rem;
        }

        /* Checkbox and Link Row */
        .form-options {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 1rem;
        }

        .checkbox-label {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            cursor: pointer;
            font-size: 0.875rem;
        }

        .checkbox-input {
            border-radius: 0.25rem;
            border-color: #d1d5db;
            color: #3b82f6;
        }

        .checkbox-input:focus {
            outline: 2px solid #3b82f6;
        }

        .forgot-password {
            font-size: 0.875rem;
            color: #3b82f6;
            text-decoration: none;
        }

        .forgot-password:hover {
            text-decoration: underline;
        }

        /* Submit Button */
        .submit-button {
            width: 100%;
            height: 2.25rem;
            padding: 0.5rem 1rem;
            background-color: #3b82f6;
            color: white;
            border-radius: 0.375rem;
            border: none;
            cursor: pointer;
            font-weight: 500;
            transition: background-color 0.2s;
        }

        .submit-button:hover:not(:disabled) {
            background-color: #2563eb;
        }

        .submit-button:focus {
            outline: none;
            box-shadow: 0 0 0 2px white, 0 0 0 4px #3b82f6;
        }

        .submit-button:disabled {
            opacity: 0.5;
            cursor: not-allowed;
        }

        /* Footer */
        .login-footer {
            text-align: center;
            font-size: 0.875rem;
            color: #6b7280;
        }

        .signup-link {
            color: #3b82f6;
            text-decoration: none;
        }

        .signup-link:hover {
            text-decoration: underline;
        }

        /* Utility */
        .hidden {
            display: none;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="login-card">
            <div class="login-header">
                <p class="app-name">（例）Bear Web Application</p>
                <h1 class="login-title">ログイン</h1>
                <p class="login-description">
                    アカウントにアクセスするには、以下にログイン情報を入力してください
                </p>
            </div>

            <form id="loginForm" class="login-form" method="POST" action="{{ route('login') }}">
                @csrf
                
                <!-- メールアドレス -->
                <div class="form-group">
                    <label for="email" class="form-label">メールアドレス</label>
                    <div class="input-wrapper">
                        <svg class="input-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                        <input
                            id="email"
                            type="email"
                            name="email"
                            class="form-input"
                            placeholder="example@email.com"
                            value="{{ old('email') }}"
                            required
                        />
                    </div>
                    <p id="emailError" class="error-message hidden"></p>
                    @error('email')
                        <p class="error-message">{{ $message }}</p>
                    @enderror
                </div>

                <!-- パスワード -->
                <div class="form-group">
                    <label for="password" class="form-label">パスワード</label>
                    <div class="input-wrapper">
                        <svg class="input-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                        </svg>
                        <input
                            id="password"
                            type="password"
                            name="password"
                            class="form-input has-icon-right"
                            placeholder="••••••••"
                            required
                        />
                        <button type="button" id="togglePassword" class="toggle-password" aria-label="パスワードを表示">
                            <!-- Eye Icon (表示) -->
                            <svg id="eyeIcon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                            </svg>
                            <!-- Eye Off Icon (非表示) -->
                            <svg id="eyeOffIcon" class="hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" />
                            </svg>
                        </button>
                    </div>
                    <p id="passwordError" class="error-message hidden"></p>
                    @error('password')
                        <p class="error-message">{{ $message }}</p>
                    @enderror
                </div>

                <!-- オプション -->
                <div class="form-options">
                    <label class="checkbox-label">
                        <input type="checkbox" name="remember" class="checkbox-input">
                        <span>ログイン状態を保持</span>
                    </label>
                    <a href="#" id="forgotPassword" class="forgot-password">
                        パスワードを忘れた場合
                    </a>
                </div>

                <!-- 送信ボタン -->
                <button type="submit" id="submitButton" class="submit-button">
                    ログイン
                </button>
            </form>

            <!-- フッター -->
            <p class="login-footer">
                アカウントをお持ちでないですか？
                <a href="#" id="signupLink" class="signup-link">新規登録</a>
            </p>
        </div>
    </div>

    <script>
        // ログインフォームの JavaScript
        document.addEventListener('DOMContentLoaded', function() {
            // 要素の取得
            const loginForm = document.getElementById('loginForm');
            const emailInput = document.getElementById('email');
            const passwordInput = document.getElementById('password');
            const togglePasswordBtn = document.getElementById('togglePassword');
            const eyeIcon = document.getElementById('eyeIcon');
            const eyeOffIcon = document.getElementById('eyeOffIcon');
            const emailError = document.getElementById('emailError');
            const passwordError = document.getElementById('passwordError');
            const submitButton = document.getElementById('submitButton');

            // パスワード表示/非表示の切り替え
            let showPassword = false;
            
            togglePasswordBtn.addEventListener('click', function() {
                showPassword = !showPassword;
                passwordInput.type = showPassword ? 'text' : 'password';
                
                if (showPassword) {
                    eyeIcon.classList.add('hidden');
                    eyeOffIcon.classList.remove('hidden');
                } else {
                    eyeIcon.classList.remove('hidden');
                    eyeOffIcon.classList.add('hidden');
                }
            });

            // メールアドレスのバリデーション
            function validateEmail(email) {
                const re = /^[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,}$/i;
                return re.test(email);
            }

            // エラーメッセージの表示
            function showError(element, message) {
                element.textContent = message;
                element.classList.remove('hidden');
            }

            // エラーメッセージの非表示
            function hideError(element) {
                element.textContent = '';
                element.classList.add('hidden');
            }

            // フォームのバリデーション
            function validateForm() {
                let isValid = true;

                // メールアドレスのバリデーション
                const email = emailInput.value.trim();
                if (!email) {
                    showError(emailError, 'メールアドレスは必須です');
                    isValid = false;
                } else if (!validateEmail(email)) {
                    showError(emailError, '有効なメールアドレスを入力してください');
                    isValid = false;
                } else {
                    hideError(emailError);
                }

                // パスワードのバリデーション
                const password = passwordInput.value;
                if (!password) {
                    showError(passwordError, 'パスワードは必須です');
                    isValid = false;
                } else if (password.length < 6) {
                    showError(passwordError, 'パスワードは6文字以上で入力してください');
                    isValid = false;
                } else {
                    hideError(passwordError);
                }

                return isValid;
            }

            // フォームの送信処理
            loginForm.addEventListener('submit', function(e) {
                // クライアントサイドのバリデーションのみ実行
                // サーバーサイドのバリデーションはLaravelが処理
                if (!validateForm()) {
                    e.preventDefault();
                    return;
                }

                // ローディング状態にする
                submitButton.disabled = true;
                submitButton.textContent = 'ログイン中...';
                
                // フォームは通常通りサーバーに送信されます
            });

            // リアルタイムバリデーション（オプション）
            emailInput.addEventListener('blur', function() {
                const email = emailInput.value.trim();
                if (email && !validateEmail(email)) {
                    showError(emailError, '有効なメールアドレスを入力してください');
                } else if (email) {
                    hideError(emailError);
                }
            });

            passwordInput.addEventListener('blur', function() {
                const password = passwordInput.value;
                if (password && password.length < 6) {
                    showError(passwordError, 'パスワードは6文字以上で入力してください');
                } else if (password) {
                    hideError(passwordError);
                }
            });

            // 「パスワードを忘れた場合」リンク
            const forgotPasswordLink = document.getElementById('forgotPassword');
            if (forgotPasswordLink) {
                forgotPasswordLink.addEventListener('click', function(e) {
                    e.preventDefault();
                    alert('パスワードリセット機能は開発中です');
                });
            }

            // 「新規登録」リンク
            const signupLink = document.getElementById('signupLink');
            if (signupLink) {
                signupLink.addEventListener('click', function(e) {
                    e.preventDefault();
                    alert('新規登録機能は開発中です');
                });
            }
        });
    </script>
</body>
</html>
