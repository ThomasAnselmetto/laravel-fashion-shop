@extends('layouts.app')

@section('title', $shoe->id ? 'modifica il prodotto' : 'Aggiungi una nuova scarpa')

@section('actions')
    <div>
        <a class="btn btn-success my-4" href="{{ route('shoes.index') }}">
            Torna alle scarpe
        </a>


        @if ($shoe->id)
            <a href="{{ route('shoes.show', $shoe) }}" class="ms-3 btn btn-primary my-4">
                Mostra scarpa
            </a>
        @endif
    </div>
@endsection

@section('content')

    @include('layouts.partials.errors')

    <section class="card">
        <div class="card-body">

            @if ($shoe->id)
                <form method="POST" action="{{ route('shoes.update', $shoe) }}" class="row g-4" enctype="multipart/form-data">
                    @method('PUT')
                @else
                    <form method="POST" action="{{ route('shoes.store') }}" class="row g-4" enctype="multipart/form-data">
            @endif
            @csrf

            <div class="col-4">
                <label for="model" class="form-label fw-bold">Modello</label>

                <input type="text" name="model" id="model" class="@error('model') is-invalid @enderror form-control" value="{{old('model', $shoe->model)}}"/>

                @error('model')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="col-4">
                <label for="type" class="form-label fw-bold">Tipo</label>

                <input type="text" name="type" id="type" class="@error('type') is-invalid @enderror form-control" value="{{old('type', $shoe->type)}}"/>

                @error('type')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="col-2">
                <label for="=number" class="form-label fw-bold">Numero</label>

                <input type="number" name="number" id="number" class="@error('number') is-invalid @enderror form-control" value="{{old('number', $shoe->number)}}"/>

                @error('number')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="col-2">
                <label for="quantity" class="form-label fw-bold">Quantita'</label>

                <input type="number" name="quantity" id="quantity" class="@error('quantity') is-invalid @enderror form-control" value="{{old('quantity', $shoe->quantity)}}"/>

                @error('quantity')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="col-4">
                <label for="color" class="form-label fw-bold">Colore</label>

                <input type="text" name="color" id="color" class="@error('color') is-invalid @enderror form-control" value="{{old('color', $shoe->color)}}"/>

                @error('color')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="col-8">
                <label for="image" class="form-label fw-bold">Immagine</label>
    
                <input type="file" name="image" id="image" class="@error('image') is-invalid @enderror form-control" value="{{old('image', $shoe->image)}}"/>
    
                @error('image')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
                <div class="preview">
                    <img src="{{$shoe->getImageUri()}}" class="w-25" alt="">
                </div>
            </div>
            <div class="col-6">
                <input class="btn btn-dark mt-3 fw-bold" type="submit"  value="Salva La Scarpa" />
            </div>
        </form>
    </div>
</section>
@endsection



            

