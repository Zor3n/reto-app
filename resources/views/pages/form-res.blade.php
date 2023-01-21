<x-main>
    <div>
        @include('components.navbar')
    </div>

    <div class="container mt-6">
        <form action="{{ url('reservation') }}" method="POST">

            <h2 class="title is-3 has-text-centered is-uppercase mb-6">{{ __('Reservar un cita veterinaria') }}</h2>
            <div class="px-6">
                <div>
                    <h5 class="title is-5">{{ __('Información del dueño:') }}</h5>
                    <div class="field is-horizontal">
                        <div class="field-body">
                            <div class="field">
                                <label class="label">{{ __('Nombre:') }}</label>
                                <p class="control is-expanded has-icons-left">
                                    <input class="input" type="text" placeholder="{{ __('Nombre') }}"
                                        name="name" id="name">
                                    <span class="icon is-small is-left">
                                        <i class="fas fa-user"></i>
                                    </span>
                                </p>
                            </div>
                            <div class="field">
                                <label class="label">{{ __('Apellidos:') }}</label>
                                <p class="control is-expanded has-icons-left has-icons-right">
                                    <input class="input" type="text" placeholder="{{ __('Apellidos') }}"
                                        name="last_name" id="last_name">
                                    <span class="icon is-small is-left">
                                        <i class="fas fa-user"></i>
                                    </span>
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="field is-horizontal">
                        <div class="field-body">
                            <div class="field ">
                                <label class="label">{{ __('Número de documento:') }}</label>
                                <p class="control is-expanded has-icons-left">
                                    <input class="input" type="text" placeholder="{{ __('DNI') }}"
                                        name="dni" id="dni">
                                    <span class="icon is-small is-left">
                                        <i class="fas fa-user"></i>
                                    </span>
                                </p>
                            </div>
                            <div class="field">
                                <label class="label">{{ __('Celular:') }}</label>
                                <div class="field has-addons">
                                    <p class="control">
                                        <a class="button is-static">
                                            +57
                                        </a>
                                    </p>
                                    <p class="control is-expanded">
                                        <input class="input" type="tel" placeholder="{{ __('Celular') }}"
                                            name="cel_number" id="cel_number">
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div>
                    <h5 class="title is-5 mt-6">{{ __('Información de la mascota:') }}</h5>
                    <div class="field is-horizontal">
                        <div class="field-body">
                            <div class="field">
                                <label class="label">{{ __('Nombre:') }}</label>
                                <p class="control is-expanded has-icons-left">
                                    <input class="input" type="text" placeholder="{{ __('Nombre') }}"
                                        name="pet_name" id="pet_name">
                                    <span class="icon is-small is-left">
                                        <i class="fas fa-user"></i>
                                    </span>
                                </p>
                            </div>
                            <div class="field"></div>
                        </div>
                    </div>
                </div>

                <div>
                    <h5 class="title is-5 mt-6">{{ __('Fecha y hora de la cita:') }}</h5>
                    <div class="field is-horizontal">
                        <div class="field-body">
                            <div class="field">
                                <label class="label">{{ __('Fecha y hora:') }}</label>
                                <p class="control is-expanded">
                                    <input class="input mr-6" type="datetime-local" name="res_date" id="res_Date">
                                </p>
                            </div>
                            <div class="field"></div>
                        </div>
                    </div>
                </div>

                <div class="field is-horizontal my-6">
                    <div class="field-body">
                        <div class="field">
                            <div class="control">
                                @csrf
                                <button class="button is-primary" type="submit">
                                    {{ __('Reservar') }}
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <x-slot:title>
        {{ __('Formulario de Reservas') }}
        </x-slot>
</x-main>
