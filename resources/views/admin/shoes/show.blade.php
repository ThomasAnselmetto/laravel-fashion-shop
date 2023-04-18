@extends('layouts.app')
@section('title', $shoe->model)

@section('actions')
    <a class="btn btn-primary mt-3" href="{{ route('shoes.index') }}">Torna alle scarpe</a>
    <a class="btn btn-primary mt-3 ms-3" href="{{ route('shoes.edit', $shoe) }}">Modifica prodotto</a>
@endsection

@section('content')

    @if (session('message'))
        <div class="alert alert-success my-3">
            {{ session('message') }}
        </div>
    @endif

    <section class="card mt-5">
        <div class="card-body">
            <div class="row">
                <div class="col-6">
                    <h3 class=" my-5">{{ $shoe->model }}</h3>
                    <h5 class=" my-5"><strong>Tipo scarpa: </strong>{{ $shoe->type }}</h5>
                    <h5 class=" my-5"><strong>Numero scarpa: </strong>{{ $shoe->number }}</h5>
                    <h5 class=" my-5"><strong>Colore: </strong>{{ $shoe->color }}</h5>
                    <h5 class=" my-5"><strong>Quantità disponibile: </strong>{{ $shoe->quantity }}</h5>
                    <h5 class="text-light bg-success p-3 my-5 fw-bold">
                        Prodotto disponibile in magazzino
                    </h5>
                </div>
                <div class="col-6">
                    <img src="{{ $shoe->image }}" class="img-fluid" alt="">
                </div>
            </div>
        </div>

    </section>
@endsection
