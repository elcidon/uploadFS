@extends('app')

@section('content')
  <div class="row">
    <div class="col-md-12">
      
      {{-- SUCCESS MESSAGE --}}
      @if($message = Session::get('success'))
        <div class="alert alert-success" role="alert">
          {{ $message }}
        </div>
      @endif

      <div class="d-flex justify-content-end">
        <a href="{{ route('profile.create') }}" class="btn btn-success mb-2">Criar</a>
      </div>

    </div>
  </div>
  {{-- BEGIN ROW OF CARD --}}
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-body">
          
          {{-- BEGIN PROFILE's TABLE  --}}
          @if($profiles->count() > 0 )
            <table class="table table-bordered">
              <thead>
                <tr>
                  <th width="15%">Avatar</th>
                  <th>Primeiro Nome</th>
                  <th>Último Nome</th>
                  <th>Ações</th>
                </tr>
              </thead>
              <tbody>
                  @foreach ( $profiles as $profile )
                    <tr>
                      <td><img src="{{ URL::to('/') }}/images/{{$profile->image }}" class="img-thumbnail" width="120" alt=""></td>
                      <td>{{ $profile->first_name }}</td>
                      <td>{{ $profile->last_name }}</td>
                      {{-- ACTION BTN --}}
                      <td>
                        <a href="{{ route('profile.show', $profile->id) }}" class="btn btn-primary btn-sm">Ver</a>

                        <a href="{{ route('profile.edit', $profile->id) }}" class="btn btn-warning btn-sm">Editar</a>
                        
                        <form action="{{ route('profile.destroy', $profile->id) }}" method="post" class="d-inline">
                          @csrf
                          @method('DELETE')

                          <button class="btn btn-danger btn-sm">Excluir</button>
                        </form>
                      </td>
                      {{-- ACTION BTN --}}
                    </tr>
                  @endforeach
                </tbody>
              </table>
              {!! $profiles->links() !!}
          @else
            <h3>Nenhum Perfil para mostrar ainda, por que você não aproveita e cadastra um?</h3>
          @endif
          {{-- END PROFILE's TABLE  --}}

        </div>
      </div>
    </div>
  </div>
  {{-- END ROW OF CARD --}}

@endsection