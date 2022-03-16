<form action="{{ route('con_desempenho_sub') }}" method="GET">
    @csrf
    <!-- campos de pesquisa -->
    @include('inc.campos_pesquisa')
    <!-- campos de pesquisa -->
    @include('inc.btn_template')
    <!-- row btn submit -->
</form>
