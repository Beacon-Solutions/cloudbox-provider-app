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
            "1" => $client_count,
            "2" => $app_count,
            "3" => $app_users,
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

        return view('dashboard.overview', ['general_info' => $general_info], ['danger_info' => $danger_info]);
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
        $client_id = $request->input('client_id');
        $client_usage_storage = $request->input('client_storage_usage');
        $client_usage_memory = $request->input('client_memory_usage');
        $client_usage_cpu = $request->input('client_cpu_usage');

        $affected = \DB::update('update clients set space_usage_percentage = ?,memory_usage_percentage = ?,client_cpu_usage = ?  where client_id = ?', [$client_usage_storage, $client_usage_memory, $client_usage_cpu, $client_id]);
        return response()->json([
            'success' => true,
            'output' => $client_id . " " . $client_usage_storage . " " . $client_usage_memory . " " . $client_usage_cpu
        ]);

    }

    public function postLogFile(Request $request)
    {
        $client_id = $request->input('client_id');
        $logFile = null;
        $client_name = null;
        if ($request->hasFile('logFile')) {
            $client_name = DB::table('clients')
                ->where('client_id', $client_id)
                ->first()->client_name;
            $logFile = $request->file('logFile');
            $destinationPath = 'uploads/';
            $companyName = $client_name;
            $success = false;
            if (Storage::disk('public')->exists($destinationPath . $companyName)) {
                $a = "company folder existed";
                Storage::disk('public')->putFileAs($destinationPath . $companyName, $logFile, $logFile->getClientOriginalName());
                $success = true;
            } else {
                $a = "Company Folder did not exist.. Folder was created";
                Storage::disk('public')->putFileAs($destinationPath . $companyName, $logFile, $logFile->getClientOriginalName());
                $success = true;
            }
            return response()->json([
                'success' => $success,
                'output' => $client_name . " " . $logFile->getClientOriginalName() . " file storing " . $success,
                'a' => $a,
            ]);
        }
    }

    public function getLogFile(Request $request) {
        $client_name = $request->input('client_name');
        $name = "public/uploads/".$client_name;
        $files = Storage::files($name);
        $noOfFiles = sizeof($files);
        $url = null;
        if ($noOfFiles>0) {
            $url  = Storage::url($files[0]);
            return redirect($url);
        }

        return response()->json([
            'noOfFiles' => $noOfFiles,
            'url' => $url,
            'name' => $client_name,
        ]);
    }
}
