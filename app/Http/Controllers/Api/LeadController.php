<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Lead;
use Illuminate\Support\Facades\Mail;
use App\Mail\NewContact;

class LeadController extends Controller
{
    public function store(Request $request) 
    {
        $data = $request->all();

        $new_lead = Lead::create($data);

        Mail::to('info@boolpress.it')->send( new NewContact( $new_lead ) );

        return response()->json(
            [
                'success' => true
            ]
        );
    }
}
