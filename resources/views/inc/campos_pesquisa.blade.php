<div class="row row-sm mg-b-20">
    <div class="col-lg-6">
        <p class="mg-b-10">Selecione o Consultor</p>
        <select name="consultores[]" multiple="multiple" class="3col active form-control">

            @foreach ($consultores_activos as $consultor_activo)
                <option value="{{ $consultor_activo->co_usuario }}" selected>{{ $consultor_activo->no_usuario }}</option>
            @endforeach

            @foreach ($consultores as $consultor)
                <option value="{{ $consultor->co_usuario }}">{{ $consultor->no_usuario }}</option>
            @endforeach
        </select>
    </div><!-- col-4 -->
    <div class="col-lg-3 mg-t-20 mg-lg-t-0">
        <p class="mg-b-10 text-bold">Data de Inicio</p>
        @if(session('date_inicio_activo'))
            <input class="form-control"  type="month" id="datePicker"
                   min="2003-01" value="{{ session()->get('date_inicio_activo') }}"
                   name="date_inicio" >
        @else
            <input class="form-control"  type="month" id="datePicker"
                   min="2003-01" value="2007-01" name="date_inicio" >
        @endif

    </div><!-- col-4 -->
    <div class="col-lg-3 mg-t-20 mg-lg-t-0">
        <p class="mg-b-10">Data de Fim</p>
        @if(session('date_fim_activo'))
            <input class="form-control"  type="month"
                   min="2003-01" value="{{ session()->get('date_fim_activo') }}" name="date_fim"
        @else
            <input class="form-control"  type="month"
                   min="2003-01" value="2007-12" name="date_fim"
        @endif
       >

    </div><!-- col-4 -->

</div>
