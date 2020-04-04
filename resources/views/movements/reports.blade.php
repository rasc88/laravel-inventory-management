@extends('layouts.app', ['activePage' => 'movements-reports', 'titlePage' => __('Movements Reports')])


@section('content')
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header card-header-primary">
            <h4 class="card-title ">{{ __('') }}</h4>
            <p class="card-category">{{ __('List') }}</p>
          </div>
          <div class="card-body">
            
            <div class="row" style="padding:0 20px 0 20px !important">
                <form class="form w-100" method="GET" action="{{ route('movements.reports') }}">
                  @csrf
                  <div class="row">
                      <div class="col-12">
                        <button type="submit" class="btn btn-primary btn-sm pull-right" name="action" value="download">{{ __('Download XLS') }}</button>
                        <div class="ripple-container"></div>
                        </a>
                      </div>
                      <div class="col-2">
                        <div class="form-group">    
                            <label for="companies_id">{{ __('Company') }}</label>
                            {!! Form::select('companies_id', $company ?? '', Request::get('companies_id'), ['class' => 'form-control','placeholder' => __('Select a option...')] ) !!}
                        </div>
                      </div>
                      <div class="col-2">
                       <div class="form-group">    
                            <label for="product_id">{{ __('Product') }}</label>
                            {!! Form::select('product_id',  isset($product) ? $product :null, Request::get('product_id'), ['class' => 'form-control','placeholder' => __('Select a option...')] ) !!}
                        </div>
                      </div>
                      <div class="col-2">
                        <div class="form-group">    
                          <label for="supervisor_id">{{ __('Supervisor') }}</label>
                          {!! Form::select('supervisor_id', isset($supervisor) ? $supervisor :null, Request::get('supervisor_id'), ['class' => 'form-control','placeholder' => __('Select a option...')]) !!}
                        </div>
                      </div>
                      <div class="col-3">
                        <div class="" style="margin-top: 13px;">    
                          <label for="companies_id" >{{ __('Entry Date') }}</label>
                          <input type="text" name="entrydate"  class="form-control" />
                        </div>
                      </div>
                      <div class="col-3">
                        <div class="" style="margin-top: 13px;">    
                          <label for="companies_id">{{ __('Exit Date') }}</label>
                          <input type="text" name="exitdate" class="form-control" />
                        </div>
                      </div>
                      <div class="col-12">
                        <button type="submit" class="btn btn-primary btn-sm pull-right">{{ __('Filter') }}</button>
                        <div class="ripple-container"></div>
                        </a>
                      </div>
                  </div>
                </form>
            </div>
            <div class="table-responsive">
                <table class="table">
                  <thead class=" text-primary">
                        <th>{{ __('ID') }}</th>
                        <th>{{ __('Company') }}</th>
                        <th>{{ __('Product') }}</th>
                        <th>{{ __('Entry Date') }}</th>
                     {{--     <th>{{ __('Entry Quantity') }}</th>
                        <th>{{ __('Entry Unit') }}</th>  --}}
                        {{--  <th>{{ __('Invoice Number') }}</th>
                        <th>{{ __('Provider Name') }}</th>
                        <th>{{ __('Permission Number') }}</th>  --}}
                        <th>{{ __('Exit Date') }}</th>
                       {{--   <th>{{ __('Exit Quantity') }}</th>
                        <th>{{ __('Exit Unit') }}</th>  --}}
                        <th>{{ __('Balance') }}</th>
                        <th>{{ __('Observations') }}</th>
                        <th>{{ __('Supervisor') }}</th>
                        <th >{{ __('') }}</th>
                  </thead>
                  <tbody>
                  @if(isset($movements))
                        @foreach($movements as $movement)
                        <tr>
                            <td>{{$movement->id}}</td>
                            <td>{{$movement->company_name}}</td>
                            <td>{{$movement->product_name}}</td>
                            <td>{{date('d-m-Y', strtotime($movement->entry_date))}}</td>
                            {{--  <td>{{$movement->entry_quantity}}</td>
                            <td>{{$movement->entry_unit}}</td>  --}}
                           {{--   <td>{{$movement->invoice_number}}</td>
                            <td>{{$movement->provider_name}}</td>
                            <td>{{$movement->permission_number}}</td>  --}}
                            <td>{{date('d-m-Y', strtotime($movement->exit_date))}}</td>
                           {{--   <td>{{$movement->exit_quantity}}</td>
                            <td>{{$movement->exit_unit}}</td>  --}}
                            <td>{{$movement->balance}}</td>
                            <td>{{$movement->observations}}</td>
                            <td>{{$movement->supervisor_name}}</td>
                            <td>

                            </td>
                        </tr>
                        @endforeach
                    @else
                    <tr>
                      <td colspan="13" class="text-center p-5">{{ __('Please select a valid company and product...') }}</td>
                    </tr>
                    @endif
                    
                    </tbody>
                </table>
            </div>
          </div>
        </div>
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
        opens: 'left', "showDropdowns": true,
        locale: {
          cancelLabel: 'Clear',
           format: 'DD/MM/YYYY'
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

