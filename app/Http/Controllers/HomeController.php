<?php

namespace App\Http\Controllers;


class HomeController extends Controller
{

    public function index()
    {
        $user = session('username');
        if (!isset($user)) {
            return redirect('/login');
        }
        $menu_items = [
            [
                'name' => 'Overview',
                'url' => '/dashboard/overview'
            ],
            [
                'name' => 'Clients',
                'url' => '/dashboard/clients'
            ],
            [
                'name' => 'Add Client',
                'url' => '/dashboard/addclient'
            ],
        ];

        $session_data = [
            'username' => session('username'),
            'full_name' => session('full_name'),
            'menu_items' => $menu_items
        ];
        return view('index', compact('session_data'));
    }
}