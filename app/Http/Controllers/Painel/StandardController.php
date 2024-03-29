<?php

namespace App\Http\Controllers\Painel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class StandardController extends Controller
{ 
    
    protected $totalpages = 15;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $datas = $this->model->paginate($this->totalpages);

        return view("{$this->view}.index",compact('datas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        // $data =' ';
        return view ("{$this->view}.create-edit");

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        // dd($request);

         //VALIDA OS DADOS
         $this->validate($request, $this->model->rules());
        //PEGANDO OS DADOS DO FORMULÁRIO
        $dataForm = $request->all();
       
        //Verificar se existe a imagem
        if ( $request->hasFile('image')){
            //pegar a imagem
            $image = $request->file('image');
            //Definir no nome da imagem
            $nameFile = uniqid(date('YmdHis')).'.'.$image->getClientOriginalExtension();
            $upload = $image->storeAs($this->upload['path'], $nameFile);
            if ( $upload )
                $dataForm['image'] = $nameFile;
            else
                return redirect()
                    ->route("{$this->route}.create")
                    ->withErrors(['errors' => 'Erro no upload da imagem'])
                    ->withInput();
        }
    
        //inserir os dados
        $insert = $this->model->create($dataForm);
        //RETORNADO MENSAGEM PARA VIEW
           if($insert)
               return redirect()
                   ->route("{$this->route}.index")
                   ->with(['success'=>'Cadastro realizado com sucesso!']);
           else
               return redirect()
                   ->route("{$this->route}.create")
                   ->withErrors(['errors' => 'Falha ao cadastrar'])
                   ->withInput();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //Recuperar usuário
        $data = $this->model->find($id);

        return view("{$this->view}.show", compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //Recuperar usuário
        $data = $this->model->find($id);
 
        return view("{$this->view}.create-edit", compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

         //Criar objeto usuario
         $data = $this->model->find($id);

        //VALIDA OS DADOS
        $this->validate($request, $this->model->rules($id));
         //PEGANDO OS DADOS DO FORMULÁRIO
        $dataForm = $request->all();
        
 
 
         //Verificar se existe a imagem
        if ( $request->hasFile('image')){
             //pegar a imagem
             $image = $request->file('image');
 
             //Definir no nome da imagem
            if ($data->image == ''){
                $nameImage = uniqid(date('YmdHis')).'.'.$image->getClientOriginalExtension();
                $dataForm['image'] = $nameImage;
            } else {
                $nameImage = $data->image;
            }
 
             $upload = $image->storeAs($this->upload['path'], $nameImage);
 
             if ( $upload )
                 $dataForm['image'] = $nameImage;
             else
                 return redirect()
                     ->route("{$this->route}.index")
                     ->withErrors(['errors' => 'Erro no upload da imagem'])
                     ->withInput();
         }
        //Alterar os dados
        $update = $data->update($dataForm);
        if($update)
            return redirect()
                ->route("{$this->route}.index")
                ->with(['success'=>'Alteração realizada com sucesso!']);
        else
            return redirect()
                ->route("{$this->route}.update")
                ->withErrors(['errors' => 'Falha ao editar'])
                ->withInput(); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = $this->model->find($id);
        $delete = $data->delete();
        if ($delete) {
            return redirect()
                ->route("{$this->route}.index")
                ->with(['success'=>"{$data->name} excluido com sucesso!"]);
        } else {
            return redirect()
                ->route("{$this->route}.show")
                ->withErrors(['errors'=>'Falha ao excluir!']);
        }
    }



}
