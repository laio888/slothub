function showErr(id, show) {
    const err   = document.getElementById('err-' + id);
    const input = document.getElementById(id);
    if (err)   err.classList.toggle('show', show);
    if (input) input.classList.toggle('invalid', show);
}

function isEmpty(id) {
    const el = document.getElementById(id);
    return !el || el.value.trim() === '';
}

function isValidEmail(id) {
    const el = document.getElementById(id);
    return el && /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(el.value.trim());
}

function isValidPhone(id) {
    const el = document.getElementById(id);
    return el && /^[0-9]{7,12}$/.test(el.value.trim());
}

function isValidDate(id) {
    const el = document.getElementById(id);
    if (!el || !el.value) return false;
    const today = new Date(); today.setHours(0, 0, 0, 0);
    return new Date(el.value) >= today;
}

function submitAgendar() {
    const checks = [
        { id: 'nombre',   fn: () => !isEmpty('nombre') },
        { id: 'correo',   fn: () => isValidEmail('correo') },
        { id: 'telefono', fn: () => isValidPhone('telefono') },
        { id: 'servicio', fn: () => document.getElementById('servicio').value !== '' },
        { id: 'fecha',    fn: () => isValidDate('fecha') },
        { id: 'hora',     fn: () => !isEmpty('hora') },
    ];

    let ok = true;
    checks.forEach(c => {
        const valid = c.fn();
        showErr(c.id, !valid);
        if (!valid) ok = false;
    });

    if (ok) {
        const banner = document.getElementById('agendarSuccess');
        banner.classList.add('show');
        ['nombre','correo','telefono','hora'].forEach(id => document.getElementById(id).value = '');
        document.getElementById('servicio').value = '';
        document.getElementById('fecha').value    = '';
        setTimeout(() => banner.classList.remove('show'), 4000);
    }
}
