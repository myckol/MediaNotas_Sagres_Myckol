<table class="table table-responsive" id="notas-table">
    <thead>
        <tr>

            <th>ID Aluno</th>
        <th>ID Disciplina</th>
        <th>Nota 1</th>
        <th>Nota 2</th>
        <th>Nota 3</th>
            <th>Média</th>

            <th colspan="3">Ação</th>
        </tr>
    </thead>
    <tbody>
    @foreach($notas as $nota)
        <tr>
            <td>{!! $nota->aluno->nome !!}</td>
            <td>{!! $nota->disciplina->disciplina !!}</td>
            <td>{!! $nota->nota1 !!}</td>
            <td>{!! $nota->nota2 !!}</td>
            <td>{!! $nota->nota3 !!}</td>
            <td>{!! ($nota->nota3+$nota->nota1+$nota->nota2)/3 !!}</td>
            <td>
                {!! Form::open(['route' => ['notas.destroy', $nota->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('notas.show', [$nota->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('notas.edit', [$nota->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Confirmar Exclusão?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>