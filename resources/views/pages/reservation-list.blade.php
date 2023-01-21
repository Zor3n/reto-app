<x-main>
    <div>
        @include('components.navbar')
    </div>



    
    <x-slot:title>
        {{ __('Lista de reservas') }}
        </x-slot>
</x-main>
