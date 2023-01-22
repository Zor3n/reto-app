<?php
$current_date_search = date('Y-m-d');
?>
<x-main>
    <div>
        @include('components.navbar')
    </div>

    <div class="container mt-6">
        <h2 class="title is-3 has-text-centered is-uppercase mb-6">{{ __('Reservas') }}</h2>
        <div class="table-container">
            <div class="is-flex is-justify-content-end mx-6 mb-5">
                <div class="field is-horizontal ">
                    <div class="field-body">
                        <form class="is-flex" role="search" action="{{ url('search') }}" method="GET">
                            <div class="field">
                                <p class="control is-expanded">
                                    <input class="input mr-6" type="date" value="{{ $current_date_search }}"
                                        name="searchDate" id="searchDate" required>
                                </p>
                            </div>
                            <div class="fieldf mx-5">
                                @csrf
                                <button class="button is-info" type="submit">{{ __('Buscar') }}</button>
                                <a class="button is-success" href="{{ url('/reservation-list') }}">
                                    {{ __('Reiniciar') }}
                                </a>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
            <table class="table is-striped is-hoverable is-fullwidth">
                <thead>
                    <tr>
                        <th><abbr title="Identification">{{ __('#ID') }}</abbr></th>
                        <th><abbr title="User national id">{{ __('DNI') }}</abbr></th>
                        <th>{{ __('Nombre') }}</th>
                        <th>{{ __('Apellidos') }}</th>
                        <th>{{ __('Celular') }}</th>
                        <th>{{ __('Mascota') }}</th>
                        <th>{{ __('Fecha') }}</th>
                        <th>{{ __('Estado') }}</th>
                        <th>{{ __('') }}</th>
                        <th>{{ __('') }}</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th><abbr title="Identification">{{ __('#ID') }}</abbr></th>
                        <th><abbr title="User national id">{{ __('DNI') }}</abbr></th>
                        <th>{{ __('Nombre') }}</th>
                        <th>{{ __('Apellidos') }}</th>
                        <th>{{ __('Celular') }}</th>
                        <th>{{ __('Mascota') }}</th>
                        <th>{{ __('Fecha') }}</th>
                        <th>{{ __('Estado') }}</th>
                        <th>{{ __('') }}</th>
                        <th>{{ __('') }}</th>
                    </tr>
                </tfoot>
                <tbody>
                    @foreach ($reservations as $reservation)
                        <?php
                        $update_selection = $reservation->id . ",'" . $reservation->user_dni . "','" . $reservation->name . "','" . $reservation->last_name . "','" . $reservation->tel_user . "','" . $reservation->pet_name . "','" . $reservation->res_date . "'," . $reservation->status . ",'" . url('reservation-list') . "'";
                        $delete_selection = $reservation->id . ",'" . $reservation->user_dni . "','" . $reservation->name . "','" . $reservation->last_name . "','" . $reservation->tel_user . "','" . $reservation->res_date . "','" . url('reservation-list') . "'";
                        ?>
                        <tr>
                            <th>{{ $reservation->id }}</th>
                            <td>{{ $reservation->user_dni }}</td>
                            <td>{{ $reservation->name }}</td>
                            <td>{{ $reservation->last_name }}</td>
                            <td>{{ $reservation->tel_user }}</td>
                            <td>{{ $reservation->pet_name }}</td>
                            <td>{{ $reservation->res_date }}</td>
                            @if ($reservation->status == 0)
                                <td class="is-uppercase">{{ __('En espera') }}</td>
                            @elseif ($reservation->status == 1)
                                <td class="is-uppercase">{{ __('completado') }}</td>
                            @else
                                <td class="is-uppercase">{{ __('cancelado') }}</td>
                            @endif
                            <td>
                                <a class="button is-warning js-modal-trigger" data-target="modal-update"
                                    onclick="updateReservation(<?php echo $update_selection; ?>);">{{ __('Editar') }}</a>
                            </td>
                            <td>
                                <a class="button is-danger js-modal-trigger" data-target="modal-delete"
                                    onclick="deleteReservation(<?php echo $delete_selection; ?>);">{{ __('Eliminar') }}</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            @if ($reservations instanceof \Illuminate\Pagination\AbstractPaginator)
                {{ $reservations->links() }}
            @endif
        </div>
    </div>


    <div id="modal-update" class="modal">
        <div class="modal-background"></div>
        <div class="modal-card">
            <header class="modal-card-head">
                <p class="modal-card-title">{{ __('Actualizar') }}</p>
                <button class="delete" aria-label="close" type="button"></button>
            </header>
            <section class="modal-card-body">
                <form id="updateForm" method="POST">
                    <div class="content px-6">
                        @method('PUT')
                        <div>
                            <h5 class="title is-5">{{ __('Información del dueño:') }}</h5>

                            <div class="field is-horizontal">
                                <div class="field-body">
                                    <div class="field ">
                                        <label class="label">{{ __('Número de documento:') }}</label>
                                        <p class="control is-expanded has-icons-left">
                                            <input class="input" type="text" placeholder="{{ __('DNI') }}"
                                                name="updateUserDNI" id="updateUserDNI" maxlength="10" required>
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
                                                    name="updateUserCelNumber" id="updateUserCelNumber" maxlength="30"
                                                    required>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="field is-horizontal">
                                <div class="field-body">
                                    <div class="field">
                                        <label class="label">{{ __('Nombre:') }}</label>
                                        <p class="control is-expanded has-icons-left">
                                            <input class="input" type="text" placeholder="{{ __('Nombre') }}"
                                                name="updateUserName" id="updateUserName" maxlength="30" required>
                                            <span class="icon is-small is-left">
                                                <i class="fas fa-user"></i>
                                            </span>
                                        </p>
                                    </div>
                                    <div class="field">
                                        <label class="label">{{ __('Apellidos:') }}</label>
                                        <p class="control is-expanded has-icons-left has-icons-right">
                                            <input class="input" type="text" placeholder="{{ __('Apellidos') }}"
                                                name="updateUserLastName" id="updateUserLastName" maxlength="30"
                                                required>
                                            <span class="icon is-small is-left">
                                                <i class="fas fa-user"></i>
                                            </span>
                                        </p>
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
                                                name="updateUserPetName" id="updateUserPetName" maxlength="30"
                                                required>
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
                                            <input class="input mr-6" type="datetime-local"
                                                name="updateReservationDate" id="updateReservationDate" required>
                                        </p>
                                    </div>
                                    <div class="field">
                                        <label class="label">{{ __('Cambiar estado:') }}</label>
                                        <div class="select">
                                            <select class="is-uppercase" name="updateReservationStatus"
                                                id="updateReservationStatus">
                                                <option value="0">{{ __('En espera') }}</option>
                                                <option value="2">{{ __('Cancelado') }}</option>
                                                <option value="1">{{ __('Completado') }}</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="is-flex is-justify-content-end my-6">
                            @csrf
                            <button class="button is-warning" type="submit">{{ __('Actualizar') }}</button>
                        </div>
                    </div>
                </form>
            </section>
        </div>
    </div>

    <div id="modal-delete" class="modal">
        <div class="modal-background"></div>
        <div class="modal-card">
            <header class="modal-card-head">
                <p class="modal-card-title">{{ __('¿Eliminar registro?') }}</p>
                <button class="delete" aria-label="close" type="button"></button>
            </header>
            <section class="modal-card-body">
                <form id="deleteForm" method="POST">
                    <div class="content px-6">
                        <div>
                            <h5 class="title is-5">{{ __('Información:') }}</h5>
                            <div class="field is-horizontal">
                                <div class="field-body">
                                    <div class="field ">
                                        <label class="label">{{ __('Número de documento:') }}</label>
                                        <p class="control is-expanded has-icons-left">
                                            <input class="input" type="text" placeholder="{{ __('DNI') }}"
                                                name="deleteUserDNI" id="deleteUserDNI" maxlength="10" readonly
                                                disabled required>
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
                                                <input class="input" type="tel"
                                                    placeholder="{{ __('Celular') }}" name="deleteUserCelNumber"
                                                    id="deleteUserCelNumber" maxlength="30" readonly disabled
                                                    required>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="field is-horizontal">
                                <div class="field-body">
                                    <div class="field">
                                        <label class="label">{{ __('Nombre:') }}</label>
                                        <p class="control is-expanded has-icons-left">
                                            <input class="input" type="text" placeholder="{{ __('Nombre') }}"
                                                name="deleteUserName" id="deleteUserName" maxlength="30" readonly
                                                disabled required>
                                            <span class="icon is-small is-left">
                                                <i class="fas fa-user"></i>
                                            </span>
                                        </p>
                                    </div>
                                    <div class="field">
                                        <label class="label">{{ __('Apellidos:') }}</label>
                                        <p class="control is-expanded has-icons-left has-icons-right">
                                            <input class="input" type="text" placeholder="{{ __('Apellidos') }}"
                                                name="deleteUserLastName" id="deleteUserLastName" maxlength="30"
                                                disabled readonly required>
                                            <span class="icon is-small is-left">
                                                <i class="fas fa-user"></i>
                                            </span>
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <div>
                                <div class="field is-horizontal">
                                    <div class="field-body">
                                        <div class="field">
                                            <label class="label">{{ __('Fecha y hora:') }}</label>
                                            <p class="control is-expanded">
                                                <input class="input mr-6" type="datetime-local"
                                                    name="deleteReservationDate" id="deleteReservationDate" readonly
                                                    disabled required>
                                            </p>
                                        </div>
                                        <div class="field">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="is-flex is-justify-content-end my-6">
                            @csrf
                            @method('DELETE')
                            <button class="button is-danger" type="submit">{{ __('Eliminar') }}</button>
                        </div>
                    </div>
                </form>
            </section>
        </div>
    </div>
    <x-slot:title>
        {{ __('Lista de reservas') }}
        </x-slot>
</x-main>
