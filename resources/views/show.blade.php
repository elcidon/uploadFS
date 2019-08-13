@extends('app')

@section('content')
    <div class="jumbotron text-center">
      
      <div class="d-flex justify-content-between">
        <a href="{{ route('profile.edit', $profile->id) }}" class="btn btn-warning mb-2">Editar</a>
        
        <a href="{{ route('profile.index') }}" class="btn btn-dark mb-2">Voltar</a>
      </div>

      <div class="d-flex justify-content-center">
        <img src="{{ URL::to('/') }}/images/{{$profile->image}}" alt="" width="200">
      </div>
      <br>
      <strong>Nome: </strong> {{ $profile->first_name }} {{ $profile->last_name }}
      
    </div>
@endsection