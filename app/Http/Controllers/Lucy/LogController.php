<?php

namespace App\Http\Controllers\Lucy;

use App\Models\Log;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LogController extends Controller
{
    /**
     * Log instance.
     * 
     * @var \App\Models\Log
     */
    protected $log;

    /**
     * User instance.
     * 
     * @var \App\Models\User
     */
    protected $user;

    /**
     * Create a new controller instance.
     * 
     * @param  \App\Models\Log  $log
     * @param  \App\Models\User  $user
     * @return void
     */
    public function __construct(Log $log, User $user)
    {
        $this->log = $log;
        $this->user = $user;
    }

    /**
     * Logs page.
     * 
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = [
            'form' => [
                'url' => action(route_action($this, 'index')),
                'method' => 'GET',
            ],
            'data' => [
                'start_date' => date('Y-m-d'),
                'end_date' => date('Y-m-d'),
                'user' => null,
            ],
            'dropdown' => User::dropdown(),
        ];

        if ($request->has('start_date')) {
            $data['data']['start_date'] = $request->input('start_date');
        }

        if ($request->has('end_date')) {
            $data['data']['end_date'] = $request->input('end_date');
        }

        if ($request->has('user')) {
            $data['data']['user'] = (int) $request->input('user');
        }

        $data['logs'] = $this->log->logs($data['data']['start_date'], $data['data']['end_date'], $data['data']['user']);

        return view('lucy.logs.index', $data);
    }
}
