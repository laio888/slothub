import { setError, isEmpty, isValidEmail,
    isValidPhone, isValidFutureDate } from './formUtils.js';
import { state, agregarCita, requireAuth } from './session.js';

const PRECIOS = {
    'Reducción': 700000, 'Post operatorios': 550000, 'Tonificación': 800000,
    'Volumen de Glúteos': 1200000, 'Cauterización de lunares': 50000,
    'Masajes de relajación': 110000, 'Limpieza facial': 100000,
    'Plasma capilar': 130000, 'Plasma 4ª generación': 170000,
    'Hidratación de labios': 140000, 'Relleno de surcos': 200000,
    'Botox natural lifting facial': 330000, 'Cejas': 22000,
    'Cejas con henna': 28000, 'Bigote': 7000, 'Axilas': 18000,
    'Bikini': 55000, 'Media pierna': 36000, 'Pierna completa': 75000,
    'Detox': 100000, 'Nutrición': 150000, 'Obesidad': 110000,
    'Metabolismo': 100000, 'Colágeno': 120000,
};

const fmt = n => '$' + n.toLocaleString('es-CO');

document.addEventListener('DOMContentLoaded', () => {
    if (!requireAuth()) return;

    // Rellenar datos del usuario logueado
    if (state.user) {
        const n = document.getElementById('nombre');
        const e = document.getElementById('correo');
        if (n) n.value = state.user.nombre;
        if (e) e.value = state.user.email;
    }

    document.getElementById('servicio')?.addEventListener('change', actualizarResumen);
    document.getElementById('fecha')   ?.addEventListener('change', actualizarResumen);
    document.getElementById('hora')    ?.addEventListener('change', actualizarResumen);
    document.getElementById('btnAgendar')?.addEventListener('click', submitAgendar);
});

function actualizarResumen() {
    const servicio = document.getElementById('servicio')?.value;
    const fecha    = document.getElementById('fecha')?.value;
    const hora     = document.getElementById('hora')?.value;
    const precio   = PRECIOS[servicio] || 0;
    const anticipo = Math.round(precio * 0.5);

    document.getElementById('res-servicio').textContent  = servicio || '—';
    document.getElementById('res-fecha').textContent     = fecha    || '—';
    document.getElementById('res-hora').textContent      = hora     || '—';
    document.getElementById('res-total').textContent     = precio   ? fmt(precio)   : '—';
    document.getElementById('res-anticipo').textContent  = anticipo ? fmt(anticipo) : '—';
    document.getElementById('pago-monto-val').textContent = anticipo ? fmt(anticipo) : '$0';
}

function submitAgendar() {
    const checks = [
        { id:'nombre',   ok: !isEmpty('nombre'),                              msg:'Ingresa tu nombre.' },
        { id:'correo',   ok: !isEmpty('correo'),                              msg:'Ingresa tu correo.' },
        { id:'telefono', ok: isValidPhone('telefono'),                        msg:'Teléfono inválido (7–12 dígitos).' },
        { id:'servicio', ok: document.getElementById('servicio')?.value !== '', msg:'Selecciona un servicio.' },
        { id:'fecha',    ok: isValidFutureDate('fecha'),                      msg:'Elige una fecha desde hoy.' },
        { id:'hora',     ok: !isEmpty('hora'),                                msg:'Selecciona una hora.' },
    ];

    let valid = true;
    checks.forEach(({ id, ok, msg }) => { setError(id, !ok, msg); if (!ok) valid = false; });
    if (!valid) return;

    // Validar pago simulado
    const num  = document.getElementById('numTarjeta')?.value.replace(/\s/g,'');
    const exp  = document.getElementById('expiry')?.value;
    const cvv  = document.getElementById('cvv')?.value.trim();

    if (!num  || num.length < 16)  { alert('Ingresa un número de tarjeta válido (16 dígitos).'); return; }
    if (!exp)                       { alert('Ingresa la fecha de vencimiento.'); return; }
    if (!cvv  || cvv.length < 3)   { alert('Ingresa un CVV válido (3–4 dígitos).'); return; }

    const servicio = document.getElementById('servicio').value;
    const precio   = PRECIOS[servicio] || 0;
    const anticipo = Math.round(precio * 0.5);

    agregarCita({
        servicio,
        fecha:   document.getElementById('fecha').value,
        hora:    document.getElementById('hora').value,
        nombre:  document.getElementById('nombre').value,
        precio,
        anticipo,
    });

    window.location.href = '/mis-citas';
}
