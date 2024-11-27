const loginForm = document.getElementById('loginForm'); // Reference to login form
const signupForm = document.getElementById('signupForm'); // Reference to signup form
const showSignupBtn = document.getElementById('showSignup'); // Button to show signup form
const showLoginBtn = document.getElementById('showLogin'); // Button to show login form

showSignupBtn.addEventListener('click', () => {
    loginForm.classList.add('hidden'); // Hide login form
    signupForm.classList.remove('hidden'); // Show signup form
});

showLoginBtn.addEventListener('click', () => {
    loginForm.classList.remove('hidden'); // Show login form
    signupForm.classList.add('hidden'); // Hide signup form
});

