@extends('layouts.app', ['activePage' => 'movements', 'titlePage' => __('Movements')])


@section('content')
<div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
        <form class="form" method="POST" action="{{ route('movements.store') }}">
          @csrf
          <div class="card card-login card-hidden mb-3">
            <div class="card-header card-header-primary">
              <h4 class="card-title ">{{ __('') }}</h4>
              <p class="card-category">{{ __('New') }}</p>
            </div>
            <div class="card-body ">
              <p class="card-description text-center">{{ __('') }}</p>

              <div class="row">
                  <div class="col-md-3">
                    <div class="form-group">    
                      <label for="companies_id">{{ __('Company') }}</label>
                      {!! Form::select('companies_id', $company, null, ['class' => 'form-control']) !!}
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="form-group">    
                      <label for="product_id">{{ __('Product') }}</label>
                      {!! Form::select('product_id', $product, null, ['class' => 'form-control']) !!}
                    </div>
                  </div>
                  <div class="col-md-3">
                  <div class="form-group">    
                    <label for="supervisor_id">{{ __('Supervisor') }}</label>
                    {!! Form::select('supervisor_id', $supervisor, null, ['class' => 'form-control']) !!}
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-3">
                  <div class="form-group">    
                    <label for="entrydate">{{ __('Entry Date') }}</label>
                    <input type="text" class="form-control" name="entrydate" required/>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group">    
                    <label for="entry_quantity">{{ __('Entry Quantity') }}</label>
                    <input type="text" class="form-control" name="entry_quantity" required/>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group">    
                    <label for="entry_unit">{{ __('Entry unit') }}</label>
                    <input type="text" class="form-control" name="entry_unit" required/>
                  </div>
                </div>
                
              </div>  
              <div class="row">
                <div class="col-md-3">
                  <div class="form-group">    
                    <label for="invoice_number">{{ __('Invoice Number') }}</label>
                    <input type="text" class="form-control" name="invoice_number" />
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group">    
                    <label for="invoice_number">{{ __('Provider Name') }}</label>
                    <input type="text" class="form-control" name="provider_name" />
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group">    
                    <label for="permission_number">{{ __('Permission Number') }}</label>
                    <input type="text" class="form-control" name="permission_number" />
                  </div>
                </div>
              </div>    
              <div class="row">
               <div class="col-md-3">
                  <div class="form-group">    
                    <label for="exitdate">{{ __('Exit Date') }}</label>
                    <input type="text" class="form-control" name="exitdate" />
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group">    
                    <label for="exit_quantity">{{ __('Exit Quantity') }}</label>
                    <input type="text" class="form-control" name="exit_quantity" />
                  </div>
                </div>
                
                 <div class="col-md-3">
                  <div class="form-group">    
                    <label for="exit_unit">{{ __('Exit Unit') }}</label>
                    <input type="text" class="form-control" name="exit_unit" />
                  </div>
                </div>
              </div> 
              <div class="form-group">    
                <label for="balance">{{ __('Balance') }}</label>
                <input type="tex" class="form-control" name="balance"/>
              </div>
              <div class="form-group">    
                <label for="observations">{{ __('Observations') }}</label>
                <input type="textarea" class="form-control" name="observations" rows="4" />
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

<script type="text/javascript" src="{{ asset('date') }}/jquery.min.js"></script>
<script type="text/javascript" src="{{ asset('date') }}/moment.min.js"></script>
<script type="text/javascript" src="{{ asset('date') }}/daterangepicker.min.js"></script>
<link rel="stylesheet" type="text/css" href="{{ asset('date') }}/daterangepicker.css" />
<script>
  jQuery(document).ready(function($) {
    $('input[name=entrydate],input[name=exitdate]').daterangepicker({
        opens: 'left', "showDropdowns": true, singleDatePicker: true,
        locale: {
          cancelLabel: 'Clear',
           format: 'DD-MM-YYYY'
        }
      }, function(start, end, label) {
        //console.log("A new date selection was made: " + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD'));
    });
  $('input[name=entrydate],input[name=exitdate]').val('');

  $('input[name=entrydate],input[name=exitdate]').on('cancel.daterangepicker', function(ev, picker) {
    $(this).val('');
  });

  });
</script>
@endsection

