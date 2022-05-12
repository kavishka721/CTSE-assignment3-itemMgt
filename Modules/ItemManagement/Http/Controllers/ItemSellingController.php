<?php

namespace Modules\ItemManagement\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Routing\Controller;
use Modules\ItemManagement\Entities\ItemManagement;
use Modules\ItemManagement\Http\Requests\AddItemRequest;
use Modules\ItemManagement\Http\Resources\ItemResourceCollection;
use Modules\ItemManagement\Http\Requests\UpdateItemRequest;
use Spatie\QueryBuilder\QueryBuilder;



class ItemSellingController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth:api-system-user'])->except([
            'store',
            'index',
            'update',
            'destroy'
        ]);
    }


    /**
     *   * @return  ItemResourceCollection
     * @return ResponseFactory|Response
     */
    public function index(Request $request)
    {
        return response()->json([
            'data' => ItemResourceCollection::make(
                QueryBuilder::for(ItemManagement::class)
                    ->defaultSort('-id')
                    ->allowedFilters(['name', 'price'])
                    ->allowedSorts(['name', 'price'])
                    ->paginate($request->input('per_page', 10))
            ),
        ]);
    }
    /**
     * Store a newly created resource in storage.
     * @param AddItemRequest $request
     * @return ResponseFactory|Response
     */
    public function store(AddItemRequest $request)
    {
        $data = $request->validated();
        $Itemdata = ItemManagement::create($data);

        return response()->json([
            'data' => $Itemdata,
        ]);
    }

    public function update(UpdateItemRequest $request, ItemManagement $id)
    {
        $data = $request->validated();
        $id->update($data);
        return response()->json(['data' => $id]);
    }

    // /**
    //  * Remove the specified resource from storage.
    //  *   * @return User
    //  */
    public function destroy(ItemManagement $id)
    {
        return response()->json(['successfully deleted' => $id->delete()]);
    }
}
