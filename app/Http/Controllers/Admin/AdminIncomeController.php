<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Rent;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;
use Barryvdh\DomPDF\PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class AdminIncomeController extends Controller
{
    public function index(Request $request)
    {
        $year  = $request->input('year', date('Y'));
        $month = $request->input('month');

        // Base query: only paid transactions
        $query = Rent::where('status', 'paid');

        // Filter by year
        if ($year) {
            $query->whereYear('created_at', $year);
        }

        // Filter by month (optional)
        if ($month) {
            $query->whereMonth('created_at', $month);
        }

        $incomes = $query->select(
            DB::raw('YEAR(created_at) as year'),
            DB::raw('MONTH(created_at) as month'),
            DB::raw('SUM(total_price) as total_income')
        )
            ->groupBy('year', 'month')
            ->orderBy('year', 'desc')
            ->orderBy('month', 'desc')
            ->get();

        // Total income for selected filter
        $total_income = $incomes->sum('total_income');

        $title = 'Data Pemasukan';

        return view('admin.pages.income.index', compact('incomes', 'year', 'month', 'total_income', 'title'));
    }

    public function printPdf(Request $request)
    {
        $year  = $request->input('year', date('Y'));
        $month = $request->input('month');

        $query = Rent::where('status', 'paid');

        if ($year) {
            $query->whereYear('created_at', $year);
        }
        if ($month) {
            $query->whereMonth('created_at', $month);
        }

        $incomes = $query->select(
            DB::raw('YEAR(created_at) as year'),
            DB::raw('MONTH(created_at) as month'),
            DB::raw('SUM(total_price) as total_income')
        )
            ->groupBy('year', 'month')
            ->orderBy('year', 'desc')
            ->orderBy('month', 'desc')
            ->get();

        $total_income = $incomes->sum('total_income');

        // Load view for PDF
        $pdf = FacadePdf::loadView('admin.pages.income.income', compact('incomes', 'year', 'month', 'total_income'))
            ->setPaper('A4', 'portrait');

        return $pdf->download("income_report_{$year}" . ($month ? "_{$month}" : '') . ".pdf");
    }
}
