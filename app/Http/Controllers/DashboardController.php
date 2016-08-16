<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Module;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * The User instance.
     *
     * @var \App\Models\User
     */
    protected $user;

    /**
     * Create a new controller instance.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $year = date('Y');

        $data = [
            'totalUsers' => number_format($this->user->count(), 0),
            'userBanned' => number_format($this->user->where('is_banned', true)->count(), 0),
            'totalModules' => number_format(Module::count(), 0),
            'chart' => $this->user->chart($year),
            'year' => $year,
        ];

        return view('dashboard', $data);
    }
}
