<div class="row row-sm mg-b-20">
    <div class="col-lg-6">
        <p class="mg-b-10">Selecione o Consultor</p>
        <select name="consultores[]" multiple="multiple" class="3col active form-control">
            {{--                        @foreach ($consultores as $consultor)--}}
            {{--                            <option value="{{ $consultor->co_usuario }}">{{ $consultor->no_usuario }}</option>--}}
            {{--                        @endforeach--}}
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
