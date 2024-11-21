<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Bookings as Booking;
// use App\Models\Customer;
// use App\Models\Provider;
use App\Models\User as  Customer;
use App\Models\User as  Provider;
use App\Models\Services as Service;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    //
    public function dashboard(){
        $providers = Provider::latest()
            ->take(10)
            ->get();

        $customers = Customer::latest()
            ->take(10)
            ->get();

        $bookings = Booking::with('service')
            ->latest()
            ->take(10)
            ->get();

        $totalBookingsCount = Booking::count();
        $totalServiceCount = Service::count();
        $totalCustomerCount = Customer::count();

        // $totalRevenue = Booking::sum('total_amount');
        $totalRevenue = 10;


        return view('admin.page.dashboard',compact('providers','customers','bookings','totalBookingsCount','totalServiceCount','totalRevenue','totalCustomerCount'));
    }

    public function getBookingDataForChart()
    {
        // Retrieve completed bookings with their creation month
        $data = Booking::select(
                DB::raw('MONTH(created_at) as month'),
                DB::raw('COUNT(*) as count')
            )
            ->groupBy('month')
            ->get();

        return response()->json($data);
    }

}
