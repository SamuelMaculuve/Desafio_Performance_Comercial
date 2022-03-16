<form action="{{ route('con_desempenho_filtrar') }}" method="GET">
    @csrf
    @include('inc.campos_pesquisa_cliente')
    <!-- row btn submit -->
    @include('inc.btn_template')
    <!-- row btn submit -->
</form>
