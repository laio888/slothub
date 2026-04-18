// Navbar scroll
const navbar = document.getElementById('navbar');
window.addEventListener('scroll', () => {
    navbar?.classList.toggle('scrolled', window.scrollY > 20);
});

// Hamburger menu
const hamburger = document.getElementById('hamburger');
const navLinks   = document.getElementById('navLinks');
hamburger?.addEventListener('click', () => {
    hamburger.classList.toggle('open');
    navLinks.classList.toggle('open');
});

// Cerrar menú al hacer clic en un enlace
document.querySelectorAll('.nav-links a').forEach(link => {
    link.addEventListener('click', () => {
        hamburger?.classList.remove('open');
        navLinks?.classList.remove('open');
    });
});

// Toggle mostrar/ocultar contraseña
document.querySelectorAll('.toggle-pass').forEach(btn => {
    btn.addEventListener('click', () => {
        const target = document.getElementById(btn.dataset.target);
        if (!target) return;
        target.type = target.type === 'password' ? 'text' : 'password';
    });
});

// Fuerza de contraseña
const passInput = document.getElementById('regPassword');
const fill      = document.getElementById('strengthFill');
const label     = document.getElementById('strengthLabel');
if (passInput) {
    passInput.addEventListener('input', () => {
        const v = passInput.value;
        let score = 0;
        if (v.length >= 8)           score++;
        if (/[A-Z]/.test(v))         score++;
        if (/[0-9]/.test(v))         score++;
        if (/[^A-Za-z0-9]/.test(v))  score++;
        const levels = [
            { w: '0%',   bg: 'transparent', txt: 'Ingresa una contraseña' },
            { w: '25%',  bg: '#FF6B6B',     txt: 'Muy débil' },
            { w: '50%',  bg: '#FFB347',     txt: 'Débil' },
            { w: '75%',  bg: '#5B6FFF',     txt: 'Buena' },
            { w: '100%', bg: '#00E5A0',     txt: 'Fuerte ✓' },
        ];
        if (fill)  { fill.style.width = levels[score].w; fill.style.background = levels[score].bg; }
        if (label)   label.textContent = levels[score].txt;
    });
}

// Contador de caracteres en textarea
const msgArea   = document.getElementById('ctMessage');
const charCount = document.getElementById('charCount');
if (msgArea) {
    msgArea.addEventListener('input', () => {
        charCount.textContent = `${msgArea.value.length} / 1000 caracteres`;
    });
}

// Selector tipo de cuenta (registro)
document.querySelectorAll('.type-btn').forEach(btn => {
    btn.addEventListener('click', () => {
        document.querySelectorAll('.type-btn').forEach(b => b.classList.remove('active'));
        btn.classList.add('active');
        const aliadoFields = document.getElementById('aliadoFields');
        if (aliadoFields) {
            aliadoFields.style.display = btn.dataset.type === 'aliado' ? 'block' : 'none';
        }
    });
});

// Validación genérica de formularios
function validateForm(formId, rules) {
    const form = document.getElementById(formId);
    if (!form) return;
    form.addEventListener('submit', e => {
        e.preventDefault();
        let valid = true;
        rules.forEach(({ field, errorId, validate, message }) => {
            const el  = document.getElementById(field);
            const err = document.getElementById(errorId);
            if (!el || !err) return;
            const ok = validate(el.value.trim(), el);
            err.textContent = ok ? '' : message;
            err.classList.toggle('show', !ok);
            el.classList.toggle('is-invalid', !ok);
            if (!ok) valid = false;
        });
        if (valid) {
            const btn = form.querySelector('.btn-submit');
            if (btn) btn.disabled = true;
            // Aquí en entregas futuras irá el submit real al backend
            console.log('Formulario válido:', formId);
        }
    });
}

// Login
validateForm('loginForm', [
    {
        field: 'email', errorId: 'emailError',
        validate: v => /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(v),
        message: 'Ingresa un correo válido'
    },
    {
        field: 'password', errorId: 'passwordError',
        validate: v => v.length >= 8,
        message: 'La contraseña debe tener al menos 8 caracteres'
    },
]);

// Registro
validateForm('registerForm', [
    { field: 'firstName',       errorId: 'firstNameError',       validate: v => v.length >= 2,                                    message: 'Ingresa tu nombre' },
    { field: 'lastName',        errorId: 'lastNameError',        validate: v => v.length >= 2,                                    message: 'Ingresa tu apellido' },
    { field: 'regEmail',        errorId: 'regEmailError',        validate: v => /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(v),            message: 'Correo inválido' },
    { field: 'phone',           errorId: 'phoneError',           validate: v => /^[\+]?[\d\s\-]{7,15}$/.test(v),                 message: 'Teléfono inválido' },
    { field: 'birthdate',       errorId: 'birthdateError',       validate: v => v !== '',                                        message: 'Selecciona tu fecha de nacimiento' },
    { field: 'city',            errorId: 'cityError',            validate: v => v !== '',                                        message: 'Selecciona tu ciudad' },
    { field: 'regPassword',     errorId: 'regPasswordError',     validate: v => v.length >= 8,                                    message: 'Mínimo 8 caracteres' },
    { field: 'confirmPassword', errorId: 'confirmPasswordError', validate: (v) => v === document.getElementById('regPassword')?.value, message: 'Las contraseñas no coinciden' },
]);

// Contacto
validateForm('contactForm', [
    { field: 'ctName',    errorId: 'ctNameError',    validate: v => v.length >= 2,                         message: 'Ingresa tu nombre' },
    { field: 'ctEmail',   errorId: 'ctEmailError',   validate: v => /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(v), message: 'Correo inválido' },
    { field: 'ctSubject', errorId: 'ctSubjectError', validate: v => v !== '',                              message: 'Selecciona un asunto' },
    { field: 'ctMessage', errorId: 'ctMessageError', validate: v => v.length >= 20,                        message: 'El mensaje debe tener al menos 20 caracteres' },
]);
