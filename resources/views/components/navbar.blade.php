<section class="hero is-primary is-medium">
    <nav class="navbar">
        <div class="container">
            <div class="navbar-brand">
                <a class="navbar-item" href="{{ url('/')}}">
                    <img src="https://bulma.io/images/bulma-type-white.png" alt="Logo">
                </a>
                <span class="navbar-burger" data-target="navbarMenuHeroA">
                    <span></span>
                    <span></span>
                    <span></span>
                </span>
            </div>
            <div id="navbarMenuHeroA" class="navbar-menu">
                <div class="navbar-end">
                    <a class="navbar-item is-active" href="{{ url('/')}}">
                        {{ __('Inicio') }}
                    </a>
                    <a class="navbar-item" href="{{ url('/reservation')}}">
                        {{ __('Reservar') }}
                    </a>
                    <a class="navbar-item" href="{{ url('/reservation-list')}}">
                        {{ __('Reservas') }}
                    </a>
                    <a class="navbar-item" href="{{ url('/calendar')}}">
                        {{ __('Calendario') }}
                    </a>
                    <span class="navbar-item">
                        <a class="button is-primary is-inverted has-background-dark" href="{{ url('/')}}">
                            <span class="icon">
                                <i class="fab fa-github"></i>
                            </span>
                            <span>{{ __('Código en GitHub') }}</span>
                        </a>
                    </span>
                </div>
            </div>
        </div>
    </nav>
</section>
