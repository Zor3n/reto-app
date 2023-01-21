<x-main>
    <div>
        @include('components.navbar')
    </div>

    <button class="js-modal-trigger" data-target="modal-js-example">
        Open JS example modal
    </button>

    <div id="modal-js-example" class="modal">
        <div class="modal-background"></div>

        <div class="modal-content">
            <div class="box">
                <p>Modal JS example</p>
                <!-- Your content -->
            </div>
        </div>

        <button class="modal-close is-large" aria-label="close"></button>
    </div>
    <x-slot:title>
        {{ __('Lista de reservas') }}
        </x-slot>
</x-main>
