        function toggleTab(tab) {
            const signup = document.getElementById('signupBtn');
            const login  = document.getElementById('loginBtn');
            if (tab === 'signup') {
                signup.classList.replace('bg-transparent','bg-white');
                signup.classList.replace('text-white','text-black');
                login.classList.replace('bg-white','bg-transparent');
                login.classList.replace('text-black','text-white');
            } else {
                login.classList.replace('bg-transparent','bg-white');
                login.classList.replace('text-white','text-black');
                signup.classList.replace('bg-white','bg-transparent');
                signup.classList.replace('text-black','text-white');
            }
        }

        function togglePassword() {
            const input = document.getElementById('passwordInput');
            input.type = input.type === 'password' ? 'text' : 'password';
        }

        function handleLogin() {
            const usernameInput = document.getElementById('usernameInput');
            if (!usernameInput) return;
            
            const username = usernameInput.value.trim();
            if (!username) {
                alert('Please enter a username');
                return;
            }

            localStorage.setItem('isLoggedIn', 'true');
            localStorage.setItem('username', username);
            
            if (username.toLowerCase() === 'admin') {
                localStorage.setItem('isAdmin', 'true');
                location.href = 'admin-dashboard.html';
            } else {
                localStorage.setItem('isAdmin', 'false');
                location.href = 'dashboard.html';
            }
        }