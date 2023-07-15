<?php

namespace App\Http\Controllers;

use App\Models\Battle;
use Illuminate\Http\Request;

class BattleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function start(Request $request)
    {
        $player_id = $request->player_id;

        $battleByPlayer = Battle::whereIn('status',[1,2])
        ->where('player1_id',$player_id)
        ->orWhere(function($query) use ($player_id){
            $query->where('player2_id',$player_id);
         })
        ->first();

        if($battleByPlayer === null){
            $this->store($request);
        }else{
            $battle_id = $battleByPlayer->id;
            $this->update($request, $battle_id);
        }

        if($battleByPlayer != null){
            throw new \Exception("Error al crear el partido");
        }


    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request->all());
        $battleByPlayer = Battle::where('player1_id',$request->player_id)->whereIn('status',[1,2])->first();

        if($battleByPlayer != null){
            throw new \Exception("Error al crear el partido");
        }

        $number = $last === null ? 1 : $last->id;
        $battle = Battle::create([
            'name' => 'Partido #'.$number,
            'player1_id' => $request->player_id,
            'status' => 1,
        ]);

        // Retornar respuesta
        return response()->json(['battle' => $battle], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Battle  $Battle
     * @return \Illuminate\Http\Response
     */
    public function show(Battle $Battle)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Battle  $Battle
     * @return \Illuminate\Http\Response
     */
    public function edit(Battle $battle)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Battle  $Battle
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Battle  $Battle
     * @return \Illuminate\Http\Response
     */
    public function destroy(Battle $battle)
    {
        //
    }
}
