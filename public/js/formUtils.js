/**
 * Funciones reutilizables para todos los formularios
 */

/**
 * Muestra u oculta el mensaje de error de un campo
 * @param {string} id    - id del input
 * @param {boolean} show - true = mostrar error
 * @param {string} [msg] - mensaje opcional para sobreescribir el del DOM
 */
export function setError(id, show, msg = null) {
    const err   = document.getElementById('err-' + id);
    const input = document.getElementById(id);

    if (input) {
        input.classList.toggle('invalid', show);
        input.setAttribute('aria-invalid', show ? 'true' : 'false');
    }

    if (err) {
        if (msg) err.textContent = msg;
        err.classList.toggle('show', show);
    }
}

/**
 * Limpia todos los errores del formulario
 * @param {string[]} ids - lista de ids a limpiar
 */
export function clearErrors(ids) {
    ids.forEach(id => setError(id, false));
}

/** Devuelve true si el campo está vacío */
export function isEmpty(id) {
    const el = document.getElementById(id);
    return !el || el.value.trim() === '';
}

/** Valida formato de email */
export function isValidEmail(id) {
    const el = document.getElementById(id);
    return el && /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(el.value.trim());
}

/** Valida teléfono: solo números, 7–12 dígitos */
export function isValidPhone(id) {
    const el = document.getElementById(id);
    return el && /^[0-9]{7,12}$/.test(el.value.trim());
}

/** Valida que la fecha no sea en el pasado */
export function isValidFutureDate(id) {
    const el = document.getElementById(id);
    if (!el || !el.value) return false;
    const today = new Date();
    today.setHours(0, 0, 0, 0);
    return new Date(el.value) >= today;
}

/** Valida longitud mínima */
export function minLength(id, min) {
    const el = document.getElementById(id);
    return el && el.value.trim().length >= min;
}

/** Muestra/oculta el banner de éxito y lo cierra solo después de ms */
export function showSuccess(bannerId, ms = 4000) {
    const banner = document.getElementById(bannerId);
    if (!banner) return;
    banner.classList.add('show');
    setTimeout(() => banner.classList.remove('show'), ms);
}

/** Limpia los valores de una lista de ids */
export function resetFields(ids) {
    ids.forEach(id => {
        const el = document.getElementById(id);
        if (el) el.value = '';
    });
}

/**
 * Activa el toggle de mostrar/ocultar contraseña
 * Busca todos los botones .toggle-pass en el documento
 */
export function initPasswordToggles() {
    document.querySelectorAll('.toggle-pass').forEach(btn => {
        btn.addEventListener('click', () => {
            const targetId = btn.dataset.target;
            const input    = document.getElementById(targetId);
            if (!input) return;
            const isText   = input.type === 'text';
            input.type     = isText ? 'password' : 'text';
            btn.textContent = isText ? '👁' : '🙈';
        });
    });
}

/**
 * Retroalimentación visual de fortaleza de contraseña
 * Llama esto en el input 'input' de la contraseña principal
 * @param {string} inputId      - id del input de contraseña
 * @param {string} fillId       - id del div de relleno de la barra
 * @param {string} labelId      - id del span de texto
 */
export function initStrengthMeter(inputId, fillId, labelId) {
    const input = document.getElementById(inputId);
    const fill  = document.getElementById(fillId);
    const label = document.getElementById(labelId);
    if (!input || !fill || !label) return;

    const levels = [
        { min: 0,  label: '',         color: 'transparent', width: '0%'   },
        { min: 1,  label: 'Muy débil',color: '#e74c3c',     width: '20%'  },
        { min: 6,  label: 'Débil',    color: '#e67e22',     width: '40%'  },
        { min: 8,  label: 'Regular',  color: '#f1c40f',     width: '60%'  },
        { min: 10, label: 'Fuerte',   color: '#2ecc71',     width: '80%'  },
        { min: 12, label: 'Muy fuerte',color:'#27ae60',     width: '100%' },
    ];

    input.addEventListener('input', () => {
        const val = input.value;
        let score = val.length;
        if (/[A-Z]/.test(val)) score += 2;
        if (/[0-9]/.test(val)) score += 2;
        if (/[^A-Za-z0-9]/.test(val)) score += 3;

        const level = [...levels].reverse().find(l => score >= l.min) || levels[0];
        fill.style.width           = level.width;
        fill.style.backgroundColor = level.color;
        label.textContent          = level.label;
        label.style.color          = level.color;
    });
}
