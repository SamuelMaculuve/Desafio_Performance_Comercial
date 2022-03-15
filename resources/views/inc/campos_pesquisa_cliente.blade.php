<div class="row row-sm mg-b-20">
    <div class="col-lg-6">
        <p class="mg-b-10">Selecione o Consultor</p>
        <select name="clientes[]" multiple="multiple" class="3col active form-control">
            @forelse ($clientes as $key =>  $cliente)
                <option value="{{ $cliente->co_cliente }}">{{ $cliente->no_fantasia }}</option>
            @empty

            @endforelse
            @forelse ($clientes_activos as $cliente_activo)
                <option value="{{ $cliente_activo }}" selected>{{ $cliente_activo }}</option>
            @empty
            @endforelse
        </select>
    </div><!-- col-4 -->
    <div class="col-lg-3 mg-t-20 mg-lg-t-0">
        <p class="mg-b-10 text-bold">Data de Inicio</p>
        <input class="form-control"  type="month" id="datePicker"
               min="2003-01" value="{{ $date_inicio}}" name="date_inicio" >
    </div><!-- col-4 -->
    <div class="col-lg-3 mg-t-20 mg-lg-t-0">
        <p class="mg-b-10">Data de Fim</p>
        <input class="form-control"  type="month"
               min="2003-01" value="{{ $date_fim }}" name="date_fim">

    </div><!-- col-4 -->

</div>