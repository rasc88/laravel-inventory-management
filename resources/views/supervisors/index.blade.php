@extends('layouts.app', ['activePage' => 'supervisors', 'titlePage' => __('Supervisors')])


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
                <a href="{{ route('supervisors.create')}}" class="btn btn-sm btn-primary">{{ __('Add new') }}
                <div class="ripple-container"></div>
                </a>
              </div>
            </div>
            <div class="table-responsive">
                <table class="table">
                  <thead class=" text-primary">
                        <th>{{ __('ID') }}</th>
                        <th>{{ __('Name') }}</th>
                        <th>{{ __('Identification') }}</th>
                        <th>{{ __('Signature') }}</th>
                        <th >{{ __('') }}</th>
                  </thead>
                  <tbody>
                        @foreach($supervisors as $supervisor)
                        <tr>
                            <td>{{$supervisor->id}}</td>
                            <td>{{$supervisor->name}}</td>
                            <td>{{$supervisor->identification}}</td>
                            <td><img src="{{$supervisor->signature}}" width="100"></td>
                            <td>
                                 <form action="{{ route('supervisors.destroy', $supervisor->id) }}" method="post">
                                  @csrf
                                  @method('delete')
                                  <a rel="tooltip" class="btn btn-success btn-link" href="{{ route('supervisors.edit', $supervisor->id) }}" data-original-title="" title="">
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

