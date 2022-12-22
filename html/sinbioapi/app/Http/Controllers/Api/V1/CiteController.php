<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Cite;
use Illuminate\Http\Request;

use App\Http\Resources\V1\CiteResource;

class CiteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return CiteResource::collection(Cite::all());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Cite  $cite
     * @return \Illuminate\Http\Response
     */
    public function show(Cite $cite)
    {
        //
        return new CiteResource($cite);
    }

}
