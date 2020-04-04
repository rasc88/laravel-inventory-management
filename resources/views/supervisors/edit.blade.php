@extends('layouts.app', ['activePage' => 'supervisors', 'titlePage' => __('Supervisors')])


@section('content')
<div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
        <form class="form" method="POST" action="{{ route('supervisors.update', $supervisors->id ) }}" enctype="multipart/form-data">
          @method('PATCH')
          @csrf
          <div class="card card-login card-hidden mb-3">
            <div class="card-header card-header-primary">
              <h4 class="card-title ">{{ __('') }}</h4>
              <p class="card-category">{{ __('Update') }}</p>
            </div>
            <div class="card-body ">
              <p class="card-description text-center">{{ __('') }}</p>

              <div class="form-group">    
                <label for="name">{{ __('Name') }}</label>
                <input type="text" class="form-control" name="name" value="{{ $supervisors->name }}" required/>
              </div>

               <div class="form-group">    
                <label for="alias">{{ __('Identification') }}</label>
                <input type="text" class="form-control" name="identification" value="{{ $supervisors->identification }}" required/>
              </div>

              <div class="row">
                   <div class="col-md-12 mb-3">
                    {{--  <div class="form-group">      --}}
                     <label for="logo">{{ __('Signature') }}</label>
                      <img src="{{$supervisors->signature}}" width="100">
                      <input type="file" name="file" class="form-control">
                    {{--   </div>  --}}
                  </div>
              </div>

            </div>

            <div class="card-footer justify-content-around">
              <a href="{{url()->previous()}}" class="btn btn-primary btn-sm">{{ __('Cancel') }}</a>
              <button type="submit" class="btn btn-primary btn-sm">{{ __('Save') }}</button>
            </div>


          </div>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection

