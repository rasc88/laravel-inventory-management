<table style="font-family: Arial;">
    <tr>
      <td colspan="9" style="text-align: center">{{$company->name}}</td>
    </tr>
    <tr>
      <td colspan="9" >&nbsp;</td>
    </tr>
    <tr>
      <td colspan="9" style="text-align: center">{{ __('PARA EL CONTROL DE PRECURSORES O SUSTANCIAS QUÍMICAS CONTROLADAS') }}</td>
    </tr>
    <tr>
      <td colspan="9" style="text-align: center"><b>{{$product->alias}}</b>  # Stock: {{$product->stock}}</td>
    </tr>
    <tr>
      <td colspan="9" style="text-align: center">{{__('Nombre Comercial:') }}  {{$product->name}} </td>
    </tr>
    <tr>
      <td colspan="9" >&nbsp;</td>
    </tr>
    <tr>
      <td><b>{{ __('FECHA DE ENTRADA') }}</b></td>
      <td><b>{{ __('CANTIDAD INGRESADA') }}</b></td>
      <td><b>{{ __('Nº DE FACTURA DE COMPRA') }}</b></td>
      <td><b>{{ __('NOMBRE DEL PROVEEDOR') }}</b></td>
      <td><b>{{ __('Nº  DE VIGILANCIA/ PERMISO') }}</b></td>
      <td><b>{{ __('FECHA DE SALIDA') }}</b></td>
      <td><b>{{ __('CANTIDAD DE LA SALIDA') }}</b></td>
      <td><b>{{ __('SALDO') }}</b></td>
      <td><b>{{ __('OBSERVACIÓN') }}</b></td>
    </tr>
    @foreach($movements as $movement)
    <tr>
      <td>{{date('d-m-Y', strtotime($movement->entry_date))}}</td>
      <td>{{$movement->entry_quantity}} {{$movement->entry_unit}}</td>
      <td>{{$movement->invoice_number}}</td>
      <td>{{$movement->provider_name}}</td>
      <td>{{$movement->permission_number}}</td> 
      <td>{{date('d-m-Y', strtotime($movement->exit_date))}}</td>
      <td>{{$movement->exit_quantity}} {{$movement->exit_unit}}</td>
      <td>{{$movement->balance}}</td>
      <td>{{$movement->observations}}</td>
    </tr>
    @endforeach
    @if(count($movements) < 10)
      @for ($i = count($movements); $i <=10; $i++)
        <tr>
          <td colspan="9" style="text-align: right">
            
          </td>
        </tr>
      @endfor
    @endif
    <tr>
     <td colspan="7" style="text-align: right">
      </td>
      <td colspan="2" style="text-align: right">
        @if(isset($supervisor))
        <img src="{{$supervisor->image_path}}" width="100" />
        @endif
      </td>
    </tr>
</table>
