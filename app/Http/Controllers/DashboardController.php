<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use App\Models\BloodPressureRecord;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        
        $totalPatients = Patient::where('user_id', $user->id)->count();
        
        $todayRecords = BloodPressureRecord::whereHas('patient', function($query) use ($user) {
            $query->where('user_id', $user->id);
        })->whereDate('measurement_date', Carbon::today())->count();
        
        $recentPatients = Patient::where('user_id', $user->id)
            ->with('bloodPressureRecords')
            ->latest()
            ->take(5)
            ->get();
        
        // Data untuk grafik
        $chartData = $this->getChartData($user->id);
        
        return view('dashboard', compact(
            'totalPatients', 
            'todayRecords', 
            'recentPatients',
            'chartData'
        ));
    }
    
    private function getChartData($userId)
    {
        $months = [];
        for ($i = 5; $i >= 0; $i--) {
            $date = Carbon::now()->subMonths($i);
            $months[$date->format('Y-m')] = [
                'month' => $date->format('F'),
                'systolic' => 0,
                'diastolic' => 0,
                'count' => 0
            ];
        }
        
        $records = BloodPressureRecord::whereHas('patient', function($query) use ($userId) {
            $query->where('user_id', $userId);
        })
        ->where('measurement_date', '>=', Carbon::now()->subMonths(6))
        ->get();
        
        foreach ($records as $record) {
            $key = $record->measurement_date->format('Y-m');
            if (isset($months[$key])) {
                $months[$key]['systolic'] += $record->systolic;
                $months[$key]['diastolic'] += $record->diastolic;
                $months[$key]['count']++;
            }
        }
        
        // Hitung rata-rata
        foreach ($months as &$month) {
            if ($month['count'] > 0) {
                $month['systolic'] = round($month['systolic'] / $month['count']);
                $month['diastolic'] = round($month['diastolic'] / $month['count']);
            }
        }
        
        return array_values($months);
    }
}