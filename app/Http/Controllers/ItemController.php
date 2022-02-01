<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    public function getItems()
    {
        $items = Item::with('category')->get();
        return response()->json([
            'status' => 'success',
            'data' => $items
        ]);
    }
}
