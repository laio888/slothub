<footer class="footer">
    <div class="container footer-inner">
        <div class="footer-brand">
            <a href="{{ route('home') }}" class="logo">Slot<strong>Hub</strong></a>
            <p>La plataforma de agendamiento multiservicio más confiable de Colombia.</p>
        </div>
        <div class="footer-links">
            <div class="footer-col">
                <h5>Plataforma</h5>
                <a href="{{ route('servicios') }}">Servicios</a>
                <a href="{{ route('como-funciona') }}">¿Cómo funciona?</a>
                <a href="{{ route('aliados') }}">Para aliados</a>
                <a href="{{ route('register') }}">Registrarse</a>
            </div>
            <div class="footer-col">
                <h5>Empresa</h5>
                <a href="#">Nosotros</a>
                <a href="#">Blog</a>
                <a href="{{ route('contacto') }}">Contacto</a>
            </div>
            <div class="footer-col">
                <h5>Legal</h5>
                <a href="#">Términos de uso</a>
                <a href="#">Privacidad</a>
            </div>
        </div>
    </div>
    <div class="footer-bottom">
        <p>© {{ date('Y') }} SlotHub. Todos los derechos reservados.</p>
    </div>
</footer>
