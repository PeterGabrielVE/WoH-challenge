<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Repositories\ItemRepository;
use App\Factories\ItemFactory;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     protected $itemRepository;
     protected $itemFactory;
     
     public function __construct(ItemRepository $itemRepository, ItemFactory $itemFactory)
     {
         $this->itemRepository = $itemRepository;
         $this->itemFactory = $itemFactory;
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
                    'name' => 'required|string|max:50|unique:items',
                    'type' => 'required|integer'
                 ]);

                 if ($validator->fails()) {
                    return response()->json([
                        'success' => false,
                        'message' => $validator->messages()
                    ]);
                } 

                $item = $this->itemFactory->create($request->all());
                $this->itemRepository->create($item->toArray());

                return response()->json([
                    'success' => true,
                    'message' => 'Item '.$request->name.' creado correctamente',
                    'data' => $item
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
}
