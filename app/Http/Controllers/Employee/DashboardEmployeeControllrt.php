<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Models\Borrowing;
use App\Models\NonSpt;
use App\Models\Spt;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardEmployeeControllrt extends Controller
{
    public function index()
    {
        return \view('admin.dashboard', [
            'users' => User::get(),
            'borrowings' => Borrowing::get(),
            'spts' => Spt::get(),
            'nonSpts' => NonSpt::get()
        ]);
    }
}
