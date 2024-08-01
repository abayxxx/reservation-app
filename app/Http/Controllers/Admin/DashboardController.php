<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    //
    public function index(Request $request)
    {


        // Get the current month's first day and last day
        $firstDayOfMonth = Carbon::now()->startOfYear();
        $lastDayOfMonth = Carbon::now()->endOfYear();

        // Array to store the dates with an interval of 5 days
        $datesPerFiveMonths = [];

        // Loop through the month, incrementing the date by 5 days in each iteration
        for ($i = 0; $i < 12; $i += 1) {
            $date = $firstDayOfMonth->copy()->addMonths($i);
            $datesPerFiveMonths[] = $date->format('F');
        }

        // Create an array to store the date ranges
        $dateRanges = [];

        // Loop through the month in five-day intervals and add date ranges to the array
        for ($date = $firstDayOfMonth; $date->lte($lastDayOfMonth); $date->addMonths(1)) {
            $dateRanges[] = [
                $date->copy(),
                $date->copy()->addMonths(1)->lte($lastDayOfMonth) ? $date->copy()->addMonths(1) : $lastDayOfMonth,
            ];
        }

        $resultOrder = collect($dateRanges)->map(function ($range) {
            [$start, $end] = $range;

            return Order::whereBetween('created_at', [$start, $end])->count();
        })->toArray();



        $totalOrder = Order::count();

        // dd($datesPerFiveDays);
        return view('admin.dashboard', compact('totalOrder', 'datesPerFiveMonths', 'resultOrder'));
    }



    public function filterMonth(Request $request)
    {
        if ($request->has('month')) {
            //get month from request
            $firstDayOfMonth = Carbon::parse($request->month)->startOfMonth();
            $lastDayOfMonth = Carbon::parse($request->month)->endOfMonth();


            // Array to store the dates with an interval of 5 days
            $datesPerFiveMonths = [];

            // Loop through the month, incrementing the date by 5 days in each iteration
            for ($i = 0; $i < 31; $i += 5) {
                $date = $firstDayOfMonth->copy()->addDays($i);
                $datesPerFiveMonths[] = $date->toDateString();
            }

            // Create an array to store the date ranges
            $dateRanges = [];

            // Loop through the month in five-day intervals and add date ranges to the array
            for ($date = $firstDayOfMonth; $date->lte($lastDayOfMonth); $date->addDays(5)) {
                $dateRanges[] = [
                    $date->copy()->format('Y-m-d') . " 00:00:00",
                    $date->copy()->addDays(4)->lte($lastDayOfMonth) ? $date->copy()->addDays(4)->format('Y-m-d') . " 23:59:59" : $lastDayOfMonth->format("Y-m-d") . " 23:59:59",
                ];
            }
        } else {
            // Get the current month's first day and last day
            $firstDayOfMonth = Carbon::now()->startOfYear();
            $lastDayOfMonth = Carbon::now()->endOfYear();

            // Array to store the dates with an interval of 5 days
            $datesPerFiveMonths = [];

            // Loop through the month, incrementing the date by 5 days in each iteration
            for ($i = 0; $i < 12; $i += 1) {
                $date = $firstDayOfMonth->copy()->addMonths($i);
                $datesPerFiveMonths[] = $date->format('F');
            }

            // Create an array to store the date ranges
            $dateRanges = [];

            // Loop through the month in five-day intervals and add date ranges to the array
            for ($date = $firstDayOfMonth; $date->lte($lastDayOfMonth); $date->addMonths(1)) {
                $dateRanges[] = [
                    $date->copy(),
                    $date->copy()->addMonths(1)->lte($lastDayOfMonth) ? $date->copy()->addMonths(1) : $lastDayOfMonth,
                ];
            }
        }

        // Fetch count of data for each date range
        $data = collect($dateRanges)->map(function ($range) {
            [$start, $end] = $range;
            return Order::whereBetween('created_at', [$start, $end])->count();
        })->toArray();


        //return  data
        return response()->json([
            'resultOrder' => $data,
            'datesPerFiveMonths' => $datesPerFiveMonths
        ]);
    }
}
