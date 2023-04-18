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
        $newShoe = Shoe::orderBy('updated_at', 'DESC')->paginate(7);
        //dd($newShoe);

        //$shoes = Shoe::orderBy('updated_at', 'DESC')->paginate(12);
        return view('admin.shoes.index', compact('newShoe'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Shoe $shoe)
    {
        $newShoe = new Shoe;
        return view('admin.shoes.form', compact('shoe'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
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
                'model' => 'Il modello è richiesto',
                'model' => 'Il modello deve avere un nome',
                'model' => 'Lunghezza massima per il nome del modello 50 caratteri',
                'type' => 'Il tipo è richiesto',
                'type' => 'Il tipo deve essere una parola',
                'type' => 'Lunghezza massima per il nome del modello 100 caratteri',
                'number' => 'Il numero di scarpe è richiesto',
                'number' => 'Devi inserire un numero',
                'color' => 'Il colore delle scarpe è richiesto',
                'color' => 'Puoi inserire solo caratteri minuscoli',
                'quantity' => 'La quantità è richiesta',
                'quantity' => 'Devi inserire un numero',
                'quantity' => 'Il numero minimo inseribile per lo store è di 50 pezzi',



            ]
        );


        $data = $request->all();

        $path = null;
        if (Arr::exists($data, 'image')) {
            $path = Storage::put('uploads/shoes', $data['image']);
            //$data['image'] = $path;
        }

        $newShoe = new Shoe;
        $newShoe->fill($data);
        $newShoe->image = $path;
        $newShoe->save();

        return to_route('shoes.show', $newShoe)
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
        $newShoe = new Shoe;
        //$newShoe->fill($request->all());
        //$newShoe->save();
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
        $data = $request->all();

        $path = null;
        if (Arr::exists($data, 'image')) {
            $path = Storage::put('uploads/shoes', $data['image']);
            //$data['image'] = $path;
        }

        $newShoe = new Shoe;
        $newShoe->fill($data);
        $newShoe->image = $path;
        $newShoe->save();

        return to_route('shoes.show', $newShoe)
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
