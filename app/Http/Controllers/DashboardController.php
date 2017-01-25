<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class DashboardController extends Controller
{
    public function overview()
    {
        $client_count = DB::table('clients')->count();
        $app_count = 10;//DB::table('applications')->count();
        $app_users = 12;//DB::table('applications')->count();

        /*$general_info = ['$client_count','$app_count','$app_users'];*/
        $general_info = array(
            "1"  => $client_count,
            "2"  => $app_count,
            "3"  => $app_users,
        );

        $users_space = DB::table('clients')
            ->where('space_usage_percentage', '>=', 75)
            ->get();
        $users_memory = DB::table('clients')
            ->where('memory_usage_percentage', '>=', 75)
            ->get();
        $users_cpu = DB::table('clients')
            ->where('client_cpu_usage', '>=', 75)
            ->get();

        $danger_info = array
        (
            "space_risk" => array($users_space),
            "memory_risk" => array($users_memory),
            "cpu_risk" => array($users_cpu),
        );

        return view('dashboard.overview', ['general_info' => $general_info ], ['danger_info' => $danger_info ]);
    }

    public function clients()
    {

        $all_clients = DB::table('clients')->get();
        return view('dashboard.clients', ['all_clients' => $all_clients]);
    }

    public function clientinfo($id)
    {
        $client = DB::table('clients')->where('client_id', $id)->first();
        return view('dashboard.clientinfo', ['client' => $client]);
    }

    public function addClient()
    {
        return view('dashboard.addclient');
    }

    public function postCompanyPerformance(Request $request)
    {
        $client = $request->input('client_name');
        $client_usage = $request->input('client_cpu_usage');

        $affected = \DB::update('update clients set client_cpu_usage = ? where client_name = ?', [$client_usage, $client]);
        return response()->json([
            'success' => true,
            'output' => $client . " " . $client_usage
        ]);

    }

    public function postLogFile(Request $request)
    {
        $client = $request->input('client_name');
        $logFile = null;
        if ($request->hasFile('logFile')) {
            $logFile = $request->file('logFile');
            $destinationPath = 'uploads/';
            $companyName = $client;
            $success = false;
            if (Storage::disk('local')->exists($destinationPath . $companyName)) {
                $a = 9;
                Storage::disk('local')->putFileAs($destinationPath . $companyName, $logFile, $logFile->getClientOriginalName());
                $success = true;
            }
            return response()->json([
                'success' => $success,
                'output' => $client . " " . $logFile->getClientOriginalName() . " file storing " . $success,
                'a' => $a,
            ]);
        }
    }
}
