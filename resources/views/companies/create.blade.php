@extends('layouts.app', ['activePage' => 'companies', 'titlePage' => __('Companies')])


@section('content')
<div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
        <form class="form" method="POST" action="{{ route('companies.store') }}" enctype="multipart/form-data">
          @csrf
          <div class="card card-login card-hidden mb-3">
            <div class="card-header card-header-primary">
              <h4 class="card-title ">{{ __('') }}</h4>
              <p class="card-category">{{ __('New') }}</p>
            </div>
            <div class="card-body ">
              <p class="card-description text-center">{{ __('') }}</p>

              <div class="form-group">    
                <label for="name">{{ __('Name') }}</label>
                <input type="text" class="form-control" name="name" />
              </div>
              
              <div class="row">
               <div class="col-md-12 mb-3">
                  {{--  <div class="form-group">      --}}
                    <label for="logo">{{ __('Logo') }}</label>
                    <input type="file" name="file" class="form-control">
                 {{--   </div>  --}}
                </div>
              </div>

               <div class="form-group">    
                <label for="address">{{ __('Address') }}</label>
                <input type="text" class="form-control" name="address" required/>
              </div>

               <div class="form-group">    
                <label for="Details">{{ __('Details') }}</label>
                <input type="text" class="form-control" name="details" required/>
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

