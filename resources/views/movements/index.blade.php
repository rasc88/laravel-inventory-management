@extends('layouts.app', ['activePage' => 'movements', 'titlePage' => __('Movements')])


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
            <div class="row">
              <div class="col-12 text-right">
                <a href="{{ route('movements.create')}}" class="btn btn-sm btn-primary">{{ __('Add new') }}
                <div class="ripple-container"></div>
                </a>
              </div>
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
                        <th>{{ __('Observations') }}</th>
                        <th>{{ __('Supervisor') }}</th>
                        <th>{{ __('Balance') }}</th>
                        <th >{{ __('') }}</th>
                  </thead>
                  <tbody>
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
                            <td>{{$movement->observations}}</td>
                            <td>{{$movement->supervisor_name}}</td>
                            <td>{{$movement->balance}}</td>
                            <td>
                                 <form action="{{ route('movements.destroy', $movement->id) }}" method="post">
                                  @csrf
                                  @method('delete')
                                  <a rel="tooltip" class="btn btn-success btn-link" href="{{ route('movements.edit', $movement->id) }}" data-original-title="" title="">
                                    <i class="material-icons">edit</i>
                                    <div class="ripple-container"></div>
                                  </a>
                                  <button type="button" class="btn btn-danger btn-link" data-original-title="" title="" onclick="confirm('{{ __("Are you sure you want to delete this?") }}') ? this.parentElement.submit() : ''">
                                      <i class="material-icons">close</i>
                                      <div class="ripple-container"></div>
                                  </button>
                              </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

