<?php

namespace App\Http\Controllers;

use App\Repositories\PlayerRepository;
use App\Factories\PlayerFactory;

use DB;
use App\Models\User;
use Illuminate\Http\Request;

class PlayerController extends Controller
{
    protected $playerRepository;
    protected $playerFactory;
    
    public function __construct(PlayerRepository $playerRepository, PlayerFactory $playerFactory)
    {
        $this->playerRepository = $playerRepository;
        $this->playerFactory = $playerFactory;
    }
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
        try {
            $player = $this->playerFactory->create($request->all());
            $this->playerRepository->create($player->toArray());

            return response()->json([
                'success' => true,
                'message' => 'Jugador '.$request->name.' creado correctamente',
                'data' => $player
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ]);
        }
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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

    public function storeItem(Request $request)
    {
        try {
            $player = $this->playerFactory->createItemPlayer($request->all());
            $this->playerRepository->createItemPlayer($player->toArray());

            return response()->json([
                'success' => true,
                'message' => 'El item fue equipado correctamente',
                'data' => $player
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ]);
        }
        
    }

    public function getPlayerUlti(Request $request){

       if($request->user_id){
        $user = User::find($request->user_id);
            if($user->roles()->first()->name === 'admin'){

                if($request->user_id && User::find($request->user_id) ){
                    $players = DB::table('historic')->where('attack_id',1)
                                ->join('players','players.id','=','historic.player_id')
                                ->join('battles','battles.id','=','historic.battle_id')
                                ->where('players.life','>',0)
                                ->where('players.lastAttack',1)
                                ->where('battles.status',2)
                                ->select('players.name as name')
                                ->get();

                    if(count($players) == 0){
                        return response()->json([
                            'success' => false,
                            'message' => 'No hay jugadores'
                        ]);
                    }
                    return response()->json([
                        'success' => true,
                        'data' => $players
                    ]);
                    return $players;

                }
            }
       }
    }
}
