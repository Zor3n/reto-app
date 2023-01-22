<?php
$minimum_datetime = date('Y-m-d H:i', strtotime('+1 day'));
?>
<script>
    var calendar_data = {!! json_encode($data) !!};

    document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');
        var calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            headerToolbar: {
                start: 'title',
                center: '',
                end: 'dayGridMonth,timeGridWeek,timeGridDay today prev,next'
            },
            eventSources: [{
                events: calendar_data,
                color: '#206f4d'
            }],
            eventClick: function(info) {
                console.log(info)
                // alert('Cita: ' + info.event.title + ' \nHora: ' + info.event.start);
                const myModal = new bootstrap.Modal(document.getElementById('modal-update'), {
                    keyboard: true
                });

                document.getElementById('calendarModalTitle').innerHTML = info.event.title;

                document.getElementById('updateUserDNI').value = info.event.extendedProps.owner_dni;
                document.getElementById('updateUserName').value = info.event.extendedProps
                    .owner_name;
                document.getElementById('updateUserLastName').value = info.event.extendedProps
                    .owner_last_name;
                document.getElementById('updateUserCelNumber').value = info.event.extendedProps
                    .owner_tel;
                document.getElementById('updateUserPetName').value = info.event.extendedProps
                    .pet_name;
                document.getElementById('updateReservationDate').value = info.event.extendedProps
                    .date_app;
                    
                document.getElementById('updateReservationStatus').value = info.event.extendedProps
                    .status;

                let url = info.event.extendedProps.url_form;
                let id = info.event.extendedProps.res_id;
                document.getElementById('updateForm').action = url + '/' + id;
                myModal.show();
            }
        });
        calendar.render();
    });
</script>

<x-main>
    <div>
        @include('components.navbar')
    </div>
    <div class="container pt-5 pb-5">
        <div id='calendar'></div>
    </div>

    <div id="modal-update" class="modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-background"></div>
        <div class="modal-dialog modal-card">
            <header class="modal-card-head">
                <p class="modal-card-title" id="calendarModalTitle"></p>
                <button class="delete" data-bs-dismiss="modal" aria-label="close" type="button"></button>
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
                                                <i class="fas fa-solid fa-id-card"></i>
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
                                                name="updateUserPetName" id="updateUserPetName" maxlength="30" required>
                                            <span class="icon is-small is-left">
                                                <i class="fas fa-solid fa-paw"></i>
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
                                            <input class="input mr-6" type="datetime-local" name="updateReservationDate"
                                                min="{{ $minimum_datetime }}" id="updateReservationDate" required>
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
                            <button class="button is-info mx-2" data-bs-dismiss="modal"
                                type="button">{{ __('Cerrar') }}</button>
                            @csrf
                            <button class="button is-warning" type="submit">{{ __('Actualizar') }}</button>
                        </div>
                    </div>
                </form>
            </section>
        </div>
    </div>

</x-main>
