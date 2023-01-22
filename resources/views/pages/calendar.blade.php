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
                // alert('Cita: ' + info.event.title + ' \nHora: ' + info.event.start);
                const myModal = new bootstrap.Modal(document.getElementById('calendarDataModal'), {
                    keyboard: true
                });
                console.log(info.event);
                document.getElementById('calendarModalTitle').innerHTML = info.event.title;
                document.getElementById('ownerName').value = info.event.extendedProps.owner_name;
                document.getElementById('petName').value = info.event.extendedProps.pet_name;
                document.getElementById('dateAppointment').value = info.event.extendedProps.date_app;
                document.getElementById('hourAppointment').value = info.event.extendedProps.hour;
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

</x-main>