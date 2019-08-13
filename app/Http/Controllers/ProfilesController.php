<?php

namespace App\Http\Controllers;

use App\Profile;
use Illuminate\Http\Request;
use App\Http\Requests\CreateProfileRequest;

class ProfilesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $profiles = Profile::latest()->paginate(5);
        return view('index', compact('profiles'))->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateProfileRequest $request)
    {
        $request->validated();

        // Seta o nome da imagem padrão (caso o usuário não envie nenhuma imagem)
        $img_name = 'noimage.png';

        // Verifica se a imagem foi enviada
        if( $request->hasFile('image') ){

            // Pegando a imagem que foi feito o upload
            $image = $request->file('image');

            $img_name = rand().'.'.$image->getClientOriginalExtension();
            $image->move(public_path('images'), $img_name);
        }
        

        $form_data = array(
            'first_name' => $request->first_name,
            'last_name'  => $request->last_name,
            'image'      => $img_name
        );

        Profile::create($form_data);

        return redirect('profile')->with('success', 'Perfil adicionado com sucesso');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $profile = Profile::findOrFail($id);
        return view('show', compact('profile'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $profile = Profile::findOrFail($id);
        return view('create', compact('profile'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CreateProfileRequest $request, $id)
    {

        $request->validated();

        $img_name = $request->hidden_image;
        
        // Caso não tenha sido feito o upload de uma nova imagem...
        if( $request->hasFile('image') ) {
            
            $image    = $request->file('image');
            $img_name = rand().'.'.$image->getClientOriginalExtension();
            $image->move(public_path('images'), $img_name);
        }

        $form_data = array(
            'first_name' => $request->first_name,
            'last_name'  => $request->last_name,
            'image'      => $img_name
        ); 

        Profile::whereId($id)->update($form_data);
        
        return redirect('profile')->with('success', 'Perfil alterado com sucesso');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $profile = Profile::findOrFail($id);

        if( $profile ) {
            $profile->delete();
            return redirect('profile')->with('success', 'Perfil Deletado com sucesso!');
        } 
        return redirect('profile');
    }
}
