<?php

namespace App\Http\Controllers\Marchand;


use App\Http\Controllers\ExtendedController;
use App\Models\Question;
use App\Models\RecompenseImmediate;
use Illuminate\Http\Request;

class ParametreController extends ExtendedController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('/Marchand/Fidelite/index');
    }

    public function saveob(Request $request){
        $offre = RecompenseImmediate::create(
            [
                'name'=>$request->name,
                'taux'=>$request->taux,
                'fournisseur_id'=>auth()->user()->fournisseur_id,
                'user_id'=>auth()->user()->id,
                'type'=>1,
            ]
        );

        $request->session()->flash('success','ok');

        return back();
    }

    public function saveact(Request $request){
        $offre = RecompenseImmediate::create(
            [
                'name'=>$request->name,
                'coef'=>$request->coef,
                'fournisseur_id'=>auth()->user()->fournisseur_id,
                'user_id'=>auth()->user()->id,
                'type'=>2,
                'validity'=>$request->validity,
                'echeance'=>$request->echeance
            ]
        );

        $request->session()->flash('success','ok');

        return back();
    }


    public function getQuestions(){
        $questions = Question::all();
        return view('Marchand/Parametres/questions')->with(compact('questions'));
    }



    public function saveQuestion(Request $request){

        $data = $request->except('photo');
        $data['user_id'] = auth()->user()->id;
        $data['token'] = sha1(time());
        if(request('photo')){
            $data['image'] = $this->entityPhotoCreate(request('photo'),'questions',time());
        }
        Question::create($data);
        return back();
    }

    public function enableQuestion($id){
        $question = Question::find($id);
        $question->active = 1;
        $question->save();

        return back();
    }

    public function disableQuestion($id){
        $question = Question::find($id);
        $question->active = 0;
        $question->save();

        return back();
    }






    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Projet  $projet
     * @return \Illuminate\Http\Response
     */
	public function show($token)
	{
		//$projet = Creance::where('token',$token)->first();


		return view('/Consultant/Creances/show')->with(compact('projet'));
	}


}
