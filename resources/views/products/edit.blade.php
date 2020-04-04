@extends('layouts.app', ['activePage' => 'products', 'titlePage' => __('Products')])


@section('content')
<div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
        <form class="form" method="POST" action="{{ route('products.update', $product->id ) }}">
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
                <input type="text" class="form-control" name="name" required value="{{ $product->name }}" />
              </div>

               <div class="form-group">    
                <label for="alias">{{ __('Alias') }}</label>
                <input type="text" class="form-control" name="alias" required value="{{ $product->alias }}" />
              </div>

               <div class="form-group">    
                <label for="brand">{{ __('Brand') }}</label>
                <input type="text" class="form-control" name="brand" required value="{{ $product->brand }}" />
              </div>

               <div class="form-group">    
                <label for="provider">{{ __('Provider') }}</label>
                <input type="text" class="form-control" name="provider" required value="{{ $product->provider }}" />
              </div>

              <div class="form-group">    
                <label for="stock">{{ __('Stock') }}</label>
                <input type="text" class="form-control" name="stock" required value="{{ $product->stock }}"  />
              </div>

              <div class="form-group">    
                <label for="details">{{ __('Details') }}</label>
                <input type="text" class="form-control" name="details" required value="{{ $product->details }}"  />
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

