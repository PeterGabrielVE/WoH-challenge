<?php

namespace App\Http\Controllers;

use App\Repositories\ItemPlayerRepository;
use App\Factories\ItemPlayerFactory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ItemPlayerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $itemPlayerRepository;
    protected $itemPlayerFactory;

    public function __construct(ItemPlayerRepository $itemPlayerRepository, ItemPlayerFactory $itemPlayerFactory)
    {
        $this->itemPlayerRepository = $itemPlayerRepository;
        $this->itemPlayerFactory = $itemPlayerFactory;
    }

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

            $isAdmin = is_admin($request->user_id);
        
            if($isAdmin){

                $validator = Validator::make($request->all(), [
                    'player_id' => 'required|integer',
                    'item_id' => 'required|integer'
                 ]);

                 if ($validator->fails()) {
                    return response()->json([
                        'success' => false,
                        'message' => $validator->messages()
                    ]);
                } 

                $player_id = $request->player_id;
                $item_id = $request->item_id;

                $itemPlayer = $this->itemPlayerFactory->create($player_id, $item_id);
                $this->itemPlayerRepository->create($player_id, $item_id);

                return response()->json([
                    'success' => true,
                    'message' => 'Registro creado correctamente',
                    'data' => $itemPlayer
                ]);
            }else{
                return response()->json([
                    'success' => false,
                    'message' => 'Ocurrio un problema. Comuniquese con el administrador'
                ]);
            }
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
     * @param  \App\Models\ItemPlayer  $itemPlayer
     * @return \Illuminate\Http\Response
     */
    public function show(ItemPlayer $itemPlayer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ItemPlayer  $itemPlayer
     * @return \Illuminate\Http\Response
     */
    public function edit(ItemPlayer $itemPlayer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ItemPlayer  $itemPlayer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ItemPlayer $itemPlayer)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ItemPlayer  $itemPlayer
     * @return \Illuminate\Http\Response
     */
    public function destroy(ItemPlayer $itemPlayer)
    {
        //
    }
}
