<x-main>
    <x-slot:title>
        Bienvenida - Reto 2.0
    </x-slot>

    <section class="hero is-success is-fullheight">
        <!-- Hero head: will stick at the top -->
        <div class="hero-head">
            <header class="navbar">
                <div class="container">
                    <div class="navbar-brand">
                        <a class="navbar-item" href="{{ url('/')}}">
                            <img src="https://bulma.io/images/bulma-type-white.png" alt="Logo">
                        </a>
                        <span class="navbar-burger" data-target="navbarMenuHeroC">
                            <span></span>
                            <span></span>
                            <span></span>
                        </span>
                    </div>
                    <div id="navbarMenuHeroC" class="navbar-menu">
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
                            <a class="navbar-item" href="{{ url('/')}}">
                                {{ __('Calendario') }}
                            </a>
                            <span class="navbar-item">
                                <a class="button is-success is-inverted" href="{{ url('/')}}">
                                    <span class="icon">
                                        <i class="fab fa-github"></i>
                                    </span>
                                    <span>{{ __('Código en GitHub') }}</span>
                                </a>
                            </span>
                        </div>
                    </div>
                </div>
            </header>
        </div>

        <!-- Hero content: will be in the middle -->
        <div class="hero-body">
            <div class="container has-text-centered">
                <p class="title">
                    {{__('¡Bienvenido!')}}
                </p>
                <p class="subtitle">
                    {{__('subtitulo')}}
                </p>
                <div class="buttons is-justify-content-center mt-6">
                    <a class="button px-6 mx-5 is-link" href="{{ url('/reservation')}}">{{__('Reservar')}}</a>
                    <a class="button px-6 mx-5 is-info" href="{{ url('/reservation-list')}}">{{__('Todas las Reservas')}}</a>
                    <a class="button px-6 mx-5 is-link" href="{{ url('/reservation')}}">{{__('Calendario')}}</a>
                </div>
            </div>
        </div>
    </section>
</x-main>
