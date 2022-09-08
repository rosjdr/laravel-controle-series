<x-layout title="Séries - Nova Série">
    <form action="{{ route('series.store') }}" method="post">
        @csrf
        <div class="row mb-3">
            <div class="col-8">
                <label for="nome" class="form-label">Nome </label>
                <input type="text" id="nome" name="name" class="form-control" value="{{ old('name') }}">
            </div>
            <div class="col-2">
                <label for="season" class="form-label">Temporadas </label>
                <input type="text" id="season" name="season" class="form-control" value="{{ old('season') }}">
            </div>
            <div class="col-2">
                <label for="episode" class="form-label">Episódios </label>
                <input type="text" id="episode" name="episode" class="form-control" value="{{ old('episode') }}">
            </div>
        </div>
    
        <button type="submit" class="btn btn-primary">Adicionar</button>
    </form>

</x-layout>