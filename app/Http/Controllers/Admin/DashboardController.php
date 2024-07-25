<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Responden;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    //
    public function index(Request $request)
    {


        // // Get the current month's first day and last day
        // $firstDayOfMonth = Carbon::now()->startOfMonth();
        // $lastDayOfMonth = Carbon::now()->endOfMonth()->endOfDay();

        // // Array to store the dates with an interval of 5 days
        // $datesPerFiveDays = [];

        // // Loop through the month, incrementing the date by 5 days in each iteration
        // for ($i = 0; $i < 31; $i += 5) {
        //     $date = $firstDayOfMonth->copy()->addDays($i);
        //     $datesPerFiveDays[] = $date->toDateString();
        // }


        // // Get the current month's first day and last day
        // // $firstDayOfMonth = Carbon::now()->startOfMonth();
        // // $lastDayOfMonth = Carbon::now()->endOfMonth();

        // // Create an array to store the date ranges
        // $dateRanges = [];

        // // Loop through the month in five-day intervals and add date ranges to the array
        // for ($date = $firstDayOfMonth; $date->lte($lastDayOfMonth); $date->addDays(5)) {
        //     $dateRanges[] = [
        //         $date->copy(),
        //         $date->copy()->addDays(4)->lte($lastDayOfMonth) ? $date->copy()->addDays(4)->endOfDay() : $lastDayOfMonth,
        //     ];
        // }

        // // Fetch count of data for each date range
        // $resultMen = collect($dateRanges)->map(function ($range) {
        //     [$start, $end] = $range;

        //     return Responden::where('jenis_kelamin', 'Laki-laki')->whereBetween('created_at', [$start, $end])->count();
        // })->take(6)->toArray();

        // $resultWomen = collect($dateRanges)->map(function ($range) {
        //     [$start, $end] = $range;
        //     return Responden::where('jenis_kelamin', 'Perempuan')->whereBetween('created_at', [$start, $end])->count();
        // })->toArray();

        // // dd($resultMen);


        // // dd($datesPerFiveDays);

        // $woman = Responden::where('jenis_kelamin', 'Perempuan')->count();
        // $man = Responden::where('jenis_kelamin', 'Laki-laki')->count();

        // dd($datesPerFiveDays);
        return view('admin.dashboard');
    }



    public function filterMonth(Request $request)
    {
        // if ($request->has('month')) {
        //     //get month from request
        //     $firstDayOfMonth = Carbon::parse($request->month)->startOfMonth();
        //     $lastDayOfMonth = Carbon::parse($request->month)->endOfMonth();


        //     // Array to store the dates with an interval of 5 days
        //     $datesPerFiveDays = [];

        //     // Loop through the month, incrementing the date by 5 days in each iteration
        //     for ($i = 0; $i < 31; $i += 5) {
        //         $date = $firstDayOfMonth->copy()->addDays($i);
        //         $datesPerFiveDays[] = $date->toDateString();
        //     }
        // } else {
        //     // Get the current month's first day and last day
        //     $firstDayOfMonth = Carbon::now()->startOfMonth();
        //     $lastDayOfMonth = Carbon::now()->endOfMonth();

        //     // Array to store the dates with an interval of 5 days
        //     $datesPerFiveDays = [];

        //     // Loop through the month, incrementing the date by 5 days in each iteration
        //     for ($i = 0; $i < 31; $i += 5) {
        //         $date = $firstDayOfMonth->copy()->addDays($i);
        //         $datesPerFiveDays[] = $date->toDateString();
        //     }
        // }

        // // Create an array to store the date ranges
        // $dateRanges = [];

        // // Loop through the month in five-day intervals and add date ranges to the array
        // for ($date = $firstDayOfMonth; $date->lte($lastDayOfMonth); $date->addDays(5)) {
        //     $dateRanges[] = [
        //         $date->copy(),
        //         $date->copy()->addDays(4)->lte($lastDayOfMonth) ? $date->copy()->addDays(4) : $lastDayOfMonth,
        //     ];
        // }

        // // Fetch count of data for each date range
        // $resultMen = collect($dateRanges)->map(function ($range) {
        //     [$start, $end] = $range;
        //     return Responden::where('jenis_kelamin', 'Laki-laki')->whereBetween('created_at', [$start, $end])->count();
        // })->take(6)->toArray();

        // $resultWomen = collect($dateRanges)->map(function ($range) {
        //     [$start, $end] = $range;
        //     return Responden::where('jenis_kelamin', 'Perempuan')->whereBetween('created_at', [$start, $end])->count();
        // })->toArray();


        // //return  data
        // return response()->json([
        //     'resultMen' => $resultMen,
        //     'resultWomen' => $resultWomen,
        //     'datesPerFiveDays' => $datesPerFiveDays
        // ]);
    }
}
