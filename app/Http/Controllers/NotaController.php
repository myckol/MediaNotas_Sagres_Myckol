<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateNotaRequest;
use App\Http\Requests\UpdateNotaRequest;
use App\Repositories\AlunoRepository;
use App\Repositories\DisciplinaRepository;
use App\Repositories\NotaRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use App\Models\Disciplina;

class NotaController extends AppBaseController
{
    /** @var  NotaRepository */
    private $notaRepository;
    private $disciplinaRepository;
    private $alunosRepository;

    public function __construct(NotaRepository $notaRepo,DisciplinaRepository $disciplinaRepo,AlunoRepository $alunoRepo)
    {
        $this->notaRepository = $notaRepo;
        $this->disciplinaRepository = $disciplinaRepo;
        $this->alunosRepository = $alunoRepo;
    }

    /**
     * Display a listing of the Nota.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->notaRepository->pushCriteria(new RequestCriteria($request));
        $notas = $this->notaRepository->with(['aluno','disciplina'])->all();
        return view('notas.index')
            ->with('notas', $notas);
    }

    /**
     * Show the form for creating a new Nota.
     *
     * @return Response
     */
    public function create()
    {
        $disciplinas = $this->disciplinaRepository->pluck('disciplina','id');
        $alunos = $this->alunosRepository->pluck('nome','id');
        return view('notas.create')->with('disciplinas',$disciplinas)->with('alunos',$alunos);
    }

    /**
     * Store a newly created Nota in storage.
     *
     * @param CreateNotaRequest $request
     *
     * @return Response
     */
    public function store(CreateNotaRequest $request)
    {
        $input = $request->all();

        $nota = $this->notaRepository->create($input);

        Flash::success('Nota salva com sucesso.');

        return redirect(route('notas.index'));
    }

    /**
     * Display the specified Nota.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $nota = $this->notaRepository->findWithoutFail($id);

        if (empty($nota)) {
            Flash::error('Nota not found');

            return redirect(route('notas.index'));
        }

        return view('notas.show')->with('nota', $nota);
    }

    /**
     * Show the form for editing the specified Nota.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $nota = $this->notaRepository->findWithoutFail($id);
        $disciplinas = $this->disciplinaRepository->pluck('disciplina','id');
        $alunos = $this->alunosRepository->pluck('nome','id');
        if (empty($nota)) {
            Flash::error('Nota not found');

            return redirect(route('notas.index'));
        }

        return view('notas.edit')->with('nota', $nota)->with('disciplinas',$disciplinas)->with('alunos',$alunos);
    }

    /**
     * Update the specified Nota in storage.
     *
     * @param  int              $id
     * @param UpdateNotaRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateNotaRequest $request)
    {
        $nota = $this->notaRepository->findWithoutFail($id);

        if (empty($nota)) {
            Flash::error('Nota not found');

            return redirect(route('notas.index'));
        }

        $nota = $this->notaRepository->update($request->all(), $id);

        Flash::success('Nota atualizada com sucesso.');

        return redirect(route('notas.index'));
    }

    /**
     * Remove the specified Nota from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $nota = $this->notaRepository->findWithoutFail($id);

        if (empty($nota)) {
            Flash::error('Nota not found');

            return redirect(route('notas.index'));
        }

        $this->notaRepository->delete($id);

        Flash::success('Nota deleted successfully.');

        return redirect(route('notas.index'));
    }
}
