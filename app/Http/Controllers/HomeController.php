<?php

namespace Calendar\Http\Controllers;

use Auth;
use Calendar\Http\Requests;
use Calendar\Http\Requests\ChangePasswordRequest;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }

    public function getChangePassword()
    {
        $user = Auth::user();
        return view('changePassword')
            ->with('user', $user);
    }

    public function storeChangePassword(ChangePasswordRequest $request)
    {
        $user = Auth::user();
        $user->password = bcrypt($request->get('password'));
        $user->save();
        return redirect('/')
            ->with('message', 'Neues Passwort wurde gespeichert.');
    }

    public function getReceiveMail()
    {
        $receiveMailSettings = (boolean) Auth::user()->receive_mail;
        return view('receiveMail')
            ->with('receiveMailSettings', $receiveMailSettings);
    }

    public function storeReceiveMail(Request $request)
    {
        $user = Auth::user();
        $user->receive_mail = $request->get('receive_mail');
        $user->save();
        return redirect('/')
            ->with('message', 'Benachrichtigungs-Einstellungen wurden gespeichert.');
    }
    
}
