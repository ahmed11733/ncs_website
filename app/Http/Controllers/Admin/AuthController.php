<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Constant;
use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Blog;
use App\Models\ContactUs;
use App\Models\Driver;
use App\Models\News;
use App\Models\Project;
use App\Models\Trip;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    protected function guard()
    {
        return auth()->guard('admin');
    }

    public function loginForm(){
        return view('admin.login.login');
    }

    public function login(Request $request){

        $credentials = array(
            'email' => $request->email,
            'password' =>$request->password
        );

        if (Auth::guard('admin')->attempt($credentials)) {
            if(auth()->guard('admin')->user()->is_super_admin!=1){
                session()->put('branch_id', auth()->guard('admin')->user()->branch_id);
            }
            return redirect()->route('admin.dashboard');
        }
        else{

            return redirect()->route('admin.login')->with('error',__('Email Or Password not correct'));

        }

    }

    public function dashboard()
    {
//        $totalDrivers = Driver::query()->count();
//        $totalUsers = User::query()->count();
//        $totalTrips = Trip::query()->count();
//        $totalRevenue = Trip::query()->where('status', Constant::TRIP_STATUS['Finished'])->sum('price');
//
//        // Get this month's statistics
//        $currentMonth = Carbon::now()->startOfMonth();
//        $tripsThisMonth = Trip::query()->whereMonth('created_at', $currentMonth->month)
//            ->whereYear('created_at', $currentMonth->year)
//            ->count();
//
//        // Calculate average daily trips for this month
//        $daysInMonth = $currentMonth->daysInMonth;
//        $averageDailyTrips = $daysInMonth > 0 ? round($tripsThisMonth / $daysInMonth, 1) : 0;
//
//        // Get latest records
//        $latestDrivers = Driver::query()->latest()->take(5)->get();
//        $latestUsers = User::query()->latest()->take(5)->get();
//        $latestTrips = Trip::with(['driver', 'user'])->latest()->take(5)->get();
//
//        // Prepare chart data for trips over the last 7 days
//        $tripChartData = [];
//        $tripChartLabels = [];
//
//        for ($i = 6; $i >= 0; $i--) {
//            $date = Carbon::now()->subDays($i);
//            $tripChartLabels[] = $date->format('d/m');
//
//            $tripCount = Trip::query()->whereDate('created_at', $date->format('Y-m-d'))->count();
//            $tripChartData[] = $tripCount;
//        }

        return view('admin.pages.dashboard');
//            , compact(
//            'totalDrivers',
//            'totalUsers',
//            'totalTrips',
//            'totalRevenue',
//            'tripsThisMonth',
//            'averageDailyTrips',
//            'latestDrivers',
//            'latestUsers',
//            'latestTrips',
//            'tripChartData',
//            'tripChartLabels'
//        ));
    }
    public function logout()
    {
        auth()->logout();
        return redirect()->route('admin.login');
    }
}
