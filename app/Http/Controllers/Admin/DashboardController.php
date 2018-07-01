<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Authorizable;

class DashboardController extends Controller{

	use Authorizable;

	public function index(){
		return view("admin.dashboard.index");
	}


}