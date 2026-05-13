/**
 * session.js
 * Estado persistido en sessionStorage (dura mientras la pestaña esté abierta).
 */

// ── Cargar estado desde sessionStorage ──
function loadState() {
    try {
        return {
            user:  JSON.parse(sessionStorage.getItem('cosm_user'))  || null,
            citas: JSON.parse(sessionStorage.getItem('cosm_citas')) || [],
        };
    } catch {
        return { user: null, citas: [] };
    }
}

function saveUser(user) {
    sessionStorage.setItem('cosm_user', JSON.stringify(user));
}

function saveCitas(citas) {
    sessionStorage.setItem('cosm_citas', JSON.stringify(citas));
}

export const state = loadState();

// ── API pública ──

export function login(email, password) {
    if (!email || !password) return false;
    const nombre = email.split('@')[0];
    state.user = { email, nombre };
    saveUser(state.user);
    return true;
}

export function logout() {
    sessionStorage.removeItem('cosm_user');
    sessionStorage.removeItem('cosm_citas');
    state.user  = null;
    state.citas = [];
    window.location.href = '/';
}

export function agregarCita(cita) {
    state.citas.push({ ...cita, id: Date.now() });
    saveCitas(state.citas);
}

export function cancelarCita(id) {
    const idx = state.citas.findIndex(c => c.id === id);
    if (idx !== -1) {
        state.citas.splice(idx, 1);
        saveCitas(state.citas);
    }
}

export function isLogged() {
    return !!state.user;
}

export function requireAuth() {
    if (!isLogged()) {
        window.location.href = '/login';
        return false;
    }
    return true;
}
