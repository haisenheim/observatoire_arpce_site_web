<?php

namespace App\Http\Controllers\AdminPrepa;

use App\Http\Controllers\Controller;

class DashboardController extends Controller
{

	public function __invoke()
	{
		return view('AdminPrepa/dashboard');
	}
}
