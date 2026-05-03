import { setError, isEmpty, isValidEmail } from './formUtils.js';
import { login } from './session.js';

document.addEventListener('DOMContentLoaded', () => {

    // Toggle ver contraseña
    document.querySelector('.toggle-pass')?.addEventListener('click', function () {
        const input = document.getElementById('loginPass');
        const isText = input.type === 'text';
        input.type = isText ? 'password' : 'text';
        this.textContent = isText ? '👁' : '🙈';
    });

    // Blur en tiempo real
    document.getElementById('loginEmail')?.addEventListener('blur', () =>
        setError('loginEmail', !isValidEmail('loginEmail'), 'Ingresa un correo válido.'));

    document.getElementById('loginPass')?.addEventListener('blur', () =>
        setError('loginPass', isEmpty('loginPass'), 'La contraseña no puede estar vacía.'));

    // Submit
    document.getElementById('btnLogin')?.addEventListener('click', () => {
        const email    = document.getElementById('loginEmail')?.value.trim();
        const password = document.getElementById('loginPass')?.value.trim();

        const emailOk = isValidEmail('loginEmail');
        const passOk  = !isEmpty('loginPass');

        setError('loginEmail', !emailOk, 'Ingresa un correo válido.');
        setError('loginPass',  !passOk,  'La contraseña no puede estar vacía.');

        if (emailOk && passOk) {
            login(email, password);
            window.location.href = '/dashboard';
        }
    });
});
