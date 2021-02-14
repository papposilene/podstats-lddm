<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\ItemHasDetail;
use Illuminate\Http\Request;

class SourceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function click($uuid)
    {
        $link = ItemHasDetail::findOrFail($uuid)->increment('clicks');
        Route::redirect($link->data, 301);
    }
}
