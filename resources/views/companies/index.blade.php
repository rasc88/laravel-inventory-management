@extends('layouts.app', ['activePage' => 'companies', 'titlePage' => __('Companies')])


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
                <a href="{{ route('companies.create')}}" class="btn btn-sm btn-primary">{{ __('Add new') }}
                <div class="ripple-container"></div>
                </a>
              </div>
            </div>
            <div class="table-responsive">
                <table class="table">
                  <thead class=" text-primary">
                        <th>{{ __('ID') }}</th>
                        <th>{{ __('Name') }}</th>
                        <th>{{ __('Logo') }}</th>
                        <th>{{ __('Address') }}</th>
                        <th>{{ __('Details') }}</th>
                        <th >{{ __('') }}</th>
                  </thead>
                  <tbody>
                        @foreach($companies as $company)
                        <tr>
                            <td>{{$company->id}}</td>
                            <td>{{$company->name}}</td>
                            <td>
                              <img src="{{$company->logo}}" width="100">
                            </td>
                            <td>{{$company->address}}</td>
                            <td>{{$company->details}}</td>
                            <td>
                                 <form action="{{ route('companies.destroy', $company->id) }}" method="post">
                                  @csrf
                                  @method('delete')
                                  <a rel="tooltip" class="btn btn-success btn-link" href="{{ route('companies.edit', $company->id) }}" data-original-title="" title="">
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

