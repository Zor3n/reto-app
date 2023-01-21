<x-main>
    <div>
        @include('components.navbar')
    </div>


    <div class="container mt-6">
        <div class="table-container">
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
                        $delete_selection = $reservation->id . ",'" . $reservation->user_dni . "','" . $reservation->name . "','" . $reservation->res_date . "','" . url('reservation-list') . "'";
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
                                <td>{{ __('EN ESPERA') }}</td>
                            @elseif ($reservation->status == 1)
                                <td>{{ __('COMPLETADO') }}</td>
                            @else
                                <td>{{ __('CANCELADO') }}</td>
                            @endif
                            <td>
                                <a class="button is-warning js-modal-trigger" data-target="modal-update"
                                    onclick="updateAppointment(<?php echo $update_selection; ?>);">{{ __('Editar') }}</a>
                            </td>
                            <td>
                                <a class="button is-danger js-modal-trigger" data-target="modal-delete"
                                    onclick="deleteAppointment(<?php echo $delete_selection; ?>);">{{ __('Eliminar') }}</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>


    <div id="modal-update" class="modal">
        <div class="modal-background"></div>
        <div class="modal-card">
            <header class="modal-card-head">
                <p class="modal-card-title">Actualizar</p>
                <button class="delete" aria-label="close"></button>
            </header>
            <section class="modal-card-body">
                <!-- Content ... -->
            </section>
            <footer class="modal-card-foot">
                <button class="button is-success">Save changes</button>
                <button class="button">Cancel</button>
            </footer>
        </div>
    </div>
    <div id="modal-delete" class="modal">
        <div class="modal-background"></div>
        <div class="modal-card">
            <header class="modal-card-head">
                <p class="modal-card-title">Borrar</p>
                <button class="delete" aria-label="close"></button>
            </header>
            <section class="modal-card-body">
                <!-- Content ... -->
            </section>
            <footer class="modal-card-foot">
                <button class="button is-success">Save changes</button>
                <button class="button">Cancel</button>
            </footer>
        </div>
    </div>
    <x-slot:title>
        {{ __('Lista de reservas') }}
        </x-slot>
</x-main>
