<x-layout title="Editar Séria - '{{ $serie->nome }}'">
    <x-series.form :action="route('series.update', $serie->id)" :nome="$serie->nome"></x-series.form>
</x-layout>