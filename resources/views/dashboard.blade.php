<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Benvenuto nella mia dummy app!
        </h2>
        <div class="mt-2">
            <p>Puoi effettuare richieste alle API di twitter! Buon divertimento!</p>
        </div>
    </x-slot>

    <div class="container mt-8">
        <div class="row">
            <div class="col-4">
                <button type="button" class="btn btn-primary"><a href="{{route('search_by_ids')}}" style="color: unset">Vai
                        alla ricerca per User ID</a></button>
            </div>
            <div class="col-4">
                <button type="button" class="btn btn-success"><a href="" style="color: unset">Tweetta qualcosa!</a>
                </button>
            </div>
            <div class="col-4">
                <button type="button" class="btn btn-warning"><a href="" style="color: unset">Cerca una keyword nei
                        tweet odierni!</a></button>
            </div>
        </div>
    </div>
</x-app-layout>

