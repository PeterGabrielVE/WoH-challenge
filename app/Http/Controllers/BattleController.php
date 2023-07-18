<?php

namespace App\Http\Controllers;

use App\Models\Battle;
use App\Models\Player;
use DB;
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
        ->first();
        
        if($battleByPlayer === null){
            $result = $this->store($request);
            return $result;
        }else if($battleByPlayer->player1_id != $player_id && $battleByPlayer->player2_id === null){
 
            $this->update($request,$battleByPlayer->id);
            return response()->json(['Mensaje' => 'Partida en progreso'], 201);
        }else{

            if($battleByPlayer->status == 1){
                $mensaje = "Esperando por el otro jugador...";
            }else{
                $mensaje = "Partida en progreso";
            }

            return response()->json(['Mensaje' => $mensaje], 200);
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
        $battleByPlayer = Battle::where('player1_id',$request->player_id)->whereIn('status',[1,2])->first();

        if($battleByPlayer != null){
            throw new \Exception("Error al crear el partido");
        }
        $last = Battle::latest('id')->first();
        $number = $last === null ? 1 : $last->id;
        $battle = Battle::create([
            'name' => 'Partido #'.$number,
            'player1_id' => $request->player_id,
            'status' => 1,
        ]);

        // Retornar respuesta
        return response()->json(['Mensaje'=>'Esperando por el otro jugador','battle' => $battle], 201);
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
        $player = Player::find($request->player_id);
        if($player->life > 0){
            $battle = Battle::find($id);
            $battle->player2_id = $request->player_id;
            $battle->status = 2;
            $battle->save();
        }
        
        return response()->json(['battle' => $battle, 'Mensaje' => 'Partida en progreso'], 201);
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

    public function fight(Request $request)
    {
        $battle = Battle::where('id',$request->battle_id)
                ->where('status',2)
                ->where('player1_id',$request->player_id)
                ->orWhere(function($q) use($request){
                    $q->where('player2_id',$request->player_id)
                      ->where('status',2);
                })
                ->first();
        if($battle === null){
            return response()->json(['Mensaje' => 'Debe de iniciar una partida'], 500);
        }    

        $lastAttack = DB::table('historic')->where('player_id',$request->player_id)
                        ->first();
        //dd($lastAttack);
        if($lastAttack != null && $lastAttack->attack_id != 2 && $request->attack_id == 3){
            return response()->json(['Mensaje' => 'Para utilizar la Ulti debes utilizar antes un ataque cuerpo a cuerpo'], 500);
        }

        $player1 = Player::find($battle->player1_id);
        $player2 = Player::find($battle->player2_id);

        $ataqueJugador1 = $player1->getAtaqueTotal($request->attack_id);
        $defensaJugador1 = $player1->getDefensaTotal();
        $ataqueJugador2 = $player2->getAtaqueTotal($request->battle_id);
        $defensaJugador2 = $player2->getDefensaTotal();
        
        if($player1->getPuntosDeVida() > 0 && $player2->getPuntosDeVida() > 0) {
            // Jugador 1 ataca a Jugador 2
            if ($player1->id == $request->player_id) {

                $pto_attack = $ataqueJugador1 - $defensaJugador2;
                if($pto_attack <= 0){
                    $pto_attack = 1;
                }
                $vida = $player2->life - $pto_attack;
                if($vida < 0){
                    $vida = 0;

                    $battle->status = 3;
                    $battle->winner_id = $player1->id;
                    $battle->save();
                }

                $player2->life = $vida;
                $player2->lastAttack = $request->attack_id;
                $player2->save();

                DB::table('historic')->insert(
                    ['player_id' => $request->player_id, 'battle_id' => $request->battle_id,
                    'attack_id' => $request->attack_id]
                );

            }
    
            // Jugador 2 ataca a Jugador 1
            if ($player2->id == $request->player_id) {
              
                $pto_attack = $ataqueJugador2 - $defensaJugador1;
                if($pto_attack <= 0){
                    $pto_attack = 1;

                }

                $vida = $player1->life - $pto_attack;

                if($vida < 0){
                    $vida = 0;

                    $battle->status = 3;
                    $battle->winner_id = $player2->id;
                    $battle->save();
                }

                $player1->life = $vida;
                $player1->lastAttack = $request->attack_id;
                $player1->save();

                DB::table('historic')->insert(
                    ['player_id' => $request->player_id, 'battle_id' => $request->battle_id,
                    'attack_id' => $request->attack_id]
                );
            }
        }

        if ($player1->getPuntosDeVida() <= $player2->getPuntosDeVida()) {
            return response()->json([
                'ganador' => $player2->name,
                'perdedor' => $player1->name
            ]);
        } else {
            return response()->json([
                'ganador' => $player1->name,
                'perdedor' => $player2->name
            ]);
        }
    }
}
