<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

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
        return view('dashboard.clientinfo',['client' => $client]);
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
        $all_users = DB::table('user') -> get();

        return view('dashboard.users', ['all_users' => $all_users]);
    }
}
