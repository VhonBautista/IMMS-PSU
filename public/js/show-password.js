document.addEventListener('DOMContentLoaded', function () {
    const passwordInput = document.getElementById('password');
    const confirmPasswordInput = document.getElementById('confirm-password');
    const showPasswordCheckbox = document.getElementById('show_password');

    showPasswordCheckbox.addEventListener('change', function () {
        const passwordType = showPasswordCheckbox.checked ? 'text' : 'password';
        passwordInput.type = passwordType;
        confirmPasswordInput.type = passwordType;
    });
});