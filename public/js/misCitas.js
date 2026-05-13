import { state, requireAuth, cancelarCita } from './session.js';

const fmt      = n => '$' + n.toLocaleString('es-CO');
const fmtFecha = f => new Date(f + 'T00:00').toLocaleDateString('es-CO',
    { weekday:'long', year:'numeric', month:'long', day:'numeric' });

document.addEventListener('DOMContentLoaded', () => {
    if (!requireAuth()) return;
    renderCitas();
});

function renderCitas() {
    const container = document.getElementById('citasContainer');
    if (!container) return;

    if (state.citas.length === 0) {
        container.innerHTML = `
      <div class="citas-empty">
        <div class="empty-icon">🗓️</div>
        <p>Aún no tienes citas agendadas.</p>
        <br/><br/>
        <a href="/agendar" class="btn-primary">Agendar mi primera cita</a>
      </div>`;
        return;
    }

    container.innerHTML = state.citas.map(c => `
    <div class="cita-card" id="cita-${c.id}">
      <div class="cita-info">
        <span class="cita-servicio">${c.servicio}</span>
        <div class="cita-meta">
          <span> ${fmtFecha(c.fecha)}</span>
          <span> ${c.hora}</span>
          <span> Total: ${fmt(c.precio)}</span>
          <span> Anticipo pagado: ${fmt(c.anticipo)}</span>
        </div>
      </div>
      <div class="cita-acciones">
        <span class="cita-badge badge-pagada">Anticipo pagado</span>
        <button class="btn-danger" data-id="${c.id}">Cancelar</button>
      </div>
    </div>
  `).join('');

    // Eventos de cancelar
    container.querySelectorAll('.btn-danger').forEach(btn => {
        btn.addEventListener('click', () => {
            const id = Number(btn.dataset.id);
            if (confirm('¿Segura que deseas cancelar esta cita?')) {
                cancelarCita(id);
                renderCitas();
            }
        });
    });
}
