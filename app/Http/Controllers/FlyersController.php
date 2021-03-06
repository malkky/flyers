<?php

namespace App\Http\Controllers;

use App\Flyer;
use App\Photo;
use Illuminate\Http\Request;
use App\Http\Requests\FlyerRequest;
use Illuminate\Support\Facades\Auth;

class FlyersController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth', ['except' => ['show', 'index']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $signedIn = Auth::check();
        $flyers = Flyer::all();
        return view('pages.home', compact('signedIn', 'flyers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('flyers.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     * @param \App\Http\Requests\FlyerRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(FlyerRequest $request)
    {
        $flyer = Flyer::create($request->all());

        flash()->overlay('Success!', 'Your flyer has been created.');
        
        return redirect(flyer_path($flyer));
    }

    /**
     * Display the specified resource
     *
     * @param $zip
     * @param $street
     *
     * @return \Illuminate\Http\Response
     */
    public function show($zip, $street)
    {
        $user = auth()->user();
        $flyer = Flyer::locatedAt($zip, $street);
        return view('flyers.show', compact('flyer', 'user'));
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
