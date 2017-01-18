<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class DashboardController extends Controller
{
    public function overview()
    {

        $all_running_apps = DB::table('user_app')->where('launched', 1)->whereNotNull('ipv4')->get();

        if ($all_running_apps->count() == 0) {
            $all_running_apps = [];
        }

        return view('dashboard.overview', ['all_running_apps' => $all_running_apps]);
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

    public function appsAdmin()
    {
        $all_user_apps = DB::table('user_app')
            ->where(['user_id' => session('id'), 'has_permission' => 1])
            ->get();

        $available_admin_apps = [];
        foreach ($all_user_apps as $admin_app) {
            $app_data = DB::table('app')->where('id', $admin_app->app_id)->first();
            if ($app_data->app_type == 1) {
                if (!isset($admin_app->name)) {
                    $admin_app->name = $app_data->name;
                }
                if (!isset($admin_app->description)) {
                    $admin_app->description = $app_data->description;
                }
                $available_admin_apps[] = $admin_app;
            }

        }

        return view('dashboard.clients.admin', ['available_admin_apps' => $available_admin_apps]);
    }

    public function users()
    {
        $all_users = DB::table('user')->get();

        return view('dashboard.users', ['all_users' => $all_users]);
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
