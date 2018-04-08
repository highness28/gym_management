<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MailBoxController extends Controller
{
	public function index() {
		return view('mailbox.index');
	}

    public function compose() {
    	return view('mailbox.compose');
    }
}
