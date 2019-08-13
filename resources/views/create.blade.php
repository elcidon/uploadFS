@extends('app')

@section('content')
<div class="row">
    <div class="col-md-12">
      <div class="d-flex justify-content-end">
        <a href="{{ route('profile.index') }}" class="btn btn-dark mb-2">Voltar</a>
      </div>
    </div>
  </div>
  {{-- BEGIN ROW OF CARD --}}
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        {{-- CARD HEADER --}}
        <div class="card-header">
          {{ isset($profile) ? 'EDITAR' : 'CRIAR' }} PERFIL
        </div>

        {{-- CARD BODY --}}
        <div class="card-body">

          {{-- BEGIN ERRORS --}}
          @if($errors->any())
            <div class="col-md-12">
                <div class="alert alert-danger" role="alert">
                  <ul>
                    @foreach ( $errors->all() as $error )
                      <li>{{ $error }}</li>
                    @endforeach
                  </ul>
                </div>
            </div>
          @endif
          {{-- END ERRORS --}}

          {{-- BEGIN PROFILE's FORM  --}}
          <form action="{{ isset($profile) ? route('profile.update', $profile->id) : route('profile.store') }}" method="post" enctype='multipart/form-data'>
            @csrf

            @if( isset($profile) )
              @method('PUT')
            @endif

            {{-- BEGIN ROW NAMES --}}
            <div class="row">
              {{-- BEGIN FIRST NAME --}}
              <div class="form-group col">
                <label for="first_name">Primeiro Nome</label>
                <input 
                  type="text" 
                  class="form-control" 
                  name="first_name" 
                  id="first_name" 
                  value="{{ isset($profile) ? $profile->first_name : '' }}">
              </div>
              {{-- END FIRST NAME --}}

              {{-- BEGIN LAST NAME --}}
              <div class="form-group col">
                <label for="last_name">Último Nome</label>
                <input 
                  type="text" 
                  class="form-control" 
                  name="last_name" 
                  id="last_name" 
                  value="{{ isset($profile) ? $profile->last_name : '' }}"
                  >
              </div>
              {{-- END LAST NAME --}}
            </div>
            {{-- END ROW NAMES --}}

            {{-- IMG PERFIL --}}
              <div class="d-flex justify-content-center mb-2">
                <div id="image-preview">
                  <label for="image-upload" id="image-label">Choose File</label>
                  <input type="file" name="image" id="image-upload" class="d-none" />
                </div>
              </div>            
            {{-- IMG PERFIL --}}

            {{-- BEGIN ROW FILE --}}
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  {{-- <label for="image" class="btn btn-warning col-md-12 btn-lg">Selecione a sua imagem</label>
                  <input type="file" class="form-control-file d-none" id="image" name="image"> --}}

                  
                </div>
              </div>
            </div>
            {{-- END ROW NAMES --}}

            {{-- BEGIN ROW SUBMIT --}}
            <div class="row">
              <div class="col-md-12">
              
              @if ( isset($profile) )
                <input type="hidden" name="hidden_image" value="{{ $profile->image }}">
              @endif

              <button type="submit" class="btn btn-success">{{ isset($profile) ? 'Editar Perfil' : 'Adicionar' }}</button>
              </div>
            </div>
            {{-- END ROW SUBMIT --}}
          </form> 
          {{-- END PROFILE's FORM  --}}

        </div>
      </div>
    </div>
  </div>
  {{-- END ROW OF CARD --}}

@endsection

@section('css')
<style>
  #image-preview {
    width: 400px;
    height: 400px;
    position: relative;
    overflow: hidden;
    background-color: #ffffff;
    color: #ecf0f1;
    border: 1px solid #e4e4e4;
  }
  #image-preview input {
    line-height: 200px;
    font-size: 200px;
    position: absolute;
    opacity: 0;
    z-index: 10;
  }
  #image-preview label {
    position: absolute;
    z-index: 5;
    opacity: 0.8;
    cursor: pointer;
    background-color: #bdc3c7;
    width: 200px;
    height: 50px;
    font-size: 20px;
    line-height: 50px;
    text-transform: uppercase;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    margin: auto;
    text-align: center;
  }
</style>
@endsection

@section('js')
<script src="{{ URL::to('/') }}/js/jquery.uploadPreview.min.js"></script>
<script type="text/javascript">
  $(document).ready(function() {
    $.uploadPreview({
      input_field: "#image-upload",   // Default: .image-upload
      preview_box: "#image-preview",  // Default: .image-preview
      label_field: "#image-label",    // Default: .image-label
      label_default: "Escolher", // Default: Choose File
      label_selected: "Trocar foto",  // Default: Change File
      no_label: false                 // Default: false
    });

    @if( isset($profile) )
      $('#image-preview').css('background', "url('{{ URL::to('/') }}/images/{{ $profile->image  }}')")
      $('#image-preview').css('background-size', '400px');
    @endif

  });
</script>
    
@endsection