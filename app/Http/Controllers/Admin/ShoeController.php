<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Shoe;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Storage;

class ShoeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $shoe = Shoe::orderBy('updated_at', 'DESC')->paginate(7);
        //dd($shoe);

        //$shoes = Shoe::orderBy('updated_at', 'DESC')->paginate(12);
        return view('admin.shoes.index', compact('shoe'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Shoe $shoe)
    {
        $shoe = new Shoe;
        return view('admin.shoes.form', compact('shoe'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Shoe $shoe)
    {
        $request->validate(
            [
                'model' => 'required|string|max:50',
                'type' => 'required|string|max:100',
                'number' => 'required|integer',
                'color' => 'required|lowercase',
                'quantity' => 'required|integer|min:50',

            ],
            [
                'model.required' => 'Il modello è richiesto',
                'model.string' => 'Il modello deve avere un nome',
                'model.max' => 'Lunghezza massima per il nome del modello 50 caratteri',
                'type.required' => 'Il tipo è richiesto',
                'type.string' => 'Il tipo deve essere una parola',
                'type.max' => 'Lunghezza massima per il type del modello 100 caratteri',
                'number.required' => 'Il numero di scarpe è richiesto',
                'number.integer' => 'Devi inserire un numero',
                'color.required' => 'Il colore delle scarpe è richiesto',
                'color.lowercase' => 'Puoi inserire solo caratteri minuscoli',
                'quantity.required' => 'La quantità è richiesta',
                'quantity.integer' => 'Devi inserire un numero',
                'quantity.min' => 'Il numero minimo inseribile per lo store è di 50 pezzi',



            ]
        );

        $data = $request->all();

        $path = null;
        if (Arr::exists($data, 'image')) {
            if($shoe->image) Storage::delete($shoe->image);
            $path = Storage::put('uploads/shoes', $data['image']);
            //$data['image'] = $path;
        }

        
        $shoe = new Shoe;
        $shoe->fill($data);
        $shoe->image = $path;
        $shoe->save();

        

        return to_route('shoes.show', $shoe)
            ->with('message', 'Prodotto aggiunto con successo');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Shoe  $shoe
     * @return \Illuminate\Http\Response
     */
    public function show(Shoe $shoe)
    {
        $shoe = new Shoe;
        //$shoe->fill($request->all());
        //$shoe->save();
        return view('admin.shoes.show', compact('shoe'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Shoe  $shoe
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Shoe $shoe)
    {
        $data = $request->all();

        $shoe->fill($data);
        $shoe->save();
        return view('admin.shoes.form', compact('shoe'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Shoe  $shoe
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Shoe $shoe)
    {
        $request->validate(
            [
                'model' => 'required|string|max:50',
                'type' => 'required|string|max:100',
                'number' => 'required|integer',
                'color' => 'required|lowercase',
                'quantity' => 'required|integer|min:50',

            ],
            [
                'model.required' => 'Il modello è richiesto',
                'model.string' => 'Il modello deve avere un nome',
                'model.max' => 'Lunghezza massima per il nome del modello 50 caratteri',
                'type.required' => 'Il tipo è richiesto',
                'type.string' => 'Il tipo deve essere una parola',
                'type.max' => 'Lunghezza massima per il type del modello 100 caratteri',
                'number.required' => 'Il numero di scarpe è richiesto',
                'number.integer' => 'Devi inserire un numero',
                'color.required' => 'Il colore delle scarpe è richiesto',
                'color.lowercase' => 'Puoi inserire solo caratteri minuscoli',
                'quantity.required' => 'La quantità è richiesta',
                'quantity.integer' => 'Devi inserire un numero',
                'quantity.min' => 'Il numero minimo inseribile per lo store è di 50 pezzi',



            ]
        );


        $data = $request->all();

        $path = null;
        if (Arr::exists($data, 'shoe_preview_img')) {
            if($shoe->image) Storage::delete($shoe->image);
            $path = Storage::put('uploads/shoes', $data['image']);
            //$data['image'] = $path;
        }

        
        $shoe->fill($data);
        $shoe->image = $path;
        $shoe->save();

        return to_route('shoes.show', $shoe)
            ->with('message', "La Scarpa $shoe->name è stata modificata con successo");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Shoe  $shoe
     * @return \Illuminate\Http\Response
     */
    public function destroy(Shoe $shoe)
    {
        $shoe->delete();
        return redirect()->route('shoes.index')->with('message', "La Scarpa $shoe->name è stata eliminata!sei veramente un pazzo");;
    }
}