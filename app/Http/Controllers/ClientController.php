<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class ClientController extends Controller
{

    public function addClient()
    {

        $client_id = request()->input('client_id');
        $client_name = request()->input('client_name');
        $client_address = request()->input('client_address');
        $client_email = request()->input('client_email');

        $client = \DB::table('clients')->where('client_id', $client_id)->first();

        if (empty($client_id)) {
            return response()->json([
                'error' => true,
                'msg' => 'Client ID is required.'
            ]);
        }
        if (empty($client_name)) {
            return response()->json([
                'error' => true,
                'msg' => 'Client Name is required.'
            ]);
        }
        if (empty($client_address)) {
            return response()->json([
                'error' => true,
                'msg' => 'Client Address is required.'
            ]);
        }
        if (isset($client)) {
            return response()->json([
                'error' => true,
                'msg' => 'Client ID already exists.'
            ]);
        }
        DB::table('clients')->insert(
            [
                'client_id' => $client_id,
                'client_name' => $client_name,
                'client_address' => $client_address,
                'client_emailaddress' => $client_email,
            ]
        );
        $newClient = \DB::table('clients')->where('client_id', $client_id)->first();

        if (!isset($newClient)) {
            return response()->json([
                'error' => true,
                'msg' => 'Error adding new client.'
            ]);
        }
        return response()->json([
            'error' => false,
            'msg' => "success"
        ]);
    }

}
