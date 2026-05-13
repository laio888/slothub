import { setError, isEmpty, isValidEmail, isValidPhone,
    minLength, initPasswordToggles, initStrengthMeter } from './formUtils.js';

document.addEventListener('DOMContentLoaded', () => {
    initPasswordToggles();
    initStrengthMeter('reg-password', 'strength-fill', 'strength-label');

    document.getElementById('reg-nombre')  ?.addEventListener('blur', () =>
        setError('reg-nombre',   isEmpty('reg-nombre'),       'Ingresa tu nombre completo.'));
    document.getElementById('reg-email')   ?.addEventListener('blur', () =>
        setError('reg-email',    !isValidEmail('reg-email'),  'Ingresa un correo válido.'));
    document.getElementById('reg-telefono')?.addEventListener('blur', () =>
        setError('reg-telefono', !isValidPhone('reg-telefono'), 'Número inválido (7–12 dígitos).'));
    document.getElementById('reg-password')?.addEventListener('blur', () =>
        setError('reg-password', !minLength('reg-password', 8), 'Mínimo 8 caracteres.'));
    document.getElementById('reg-confirm') ?.addEventListener('blur', validateConfirm);

    document.getElementById('btnRegistro')?.addEventListener('click', submitRegistro);
});

function validateConfirm() {
    const pass    = document.getElementById('reg-password')?.value ?? '';
    const confirm = document.getElementById('reg-confirm')?.value  ?? '';
    setError('reg-confirm', pass !== confirm, 'Las contraseñas no coinciden.');
    return pass === confirm;
}

function submitRegistro() {
    const terminos = document.getElementById('reg-terminos')?.checked ?? false;

    const checks = [
        { id:'reg-nombre',   ok: !isEmpty('reg-nombre'),         msg:'Ingresa tu nombre.' },
        { id:'reg-email',    ok: isValidEmail('reg-email'),       msg:'Correo inválido.' },
        { id:'reg-telefono', ok: isValidPhone('reg-telefono'),    msg:'Teléfono inválido.' },
        { id:'reg-password', ok: minLength('reg-password', 8),    msg:'Mínimo 8 caracteres.' },
        { id:'reg-confirm',  ok: validateConfirm(),               msg:'Las contraseñas no coinciden.' },
        { id:'reg-terminos', ok: terminos,                        msg:'Debes aceptar los términos.' },
    ];

    let valid = true;
    checks.forEach(({ id, ok, msg }) => { setError(id, !ok, msg); if (!ok) valid = false; });

    if (valid) {
        // Registro exitoso → llevar al login
        window.location.href = '/login';
    }
}
