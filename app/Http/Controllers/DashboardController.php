<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard');
    }

    public function getSummary()
    {
        try {
            // 1. Basic Stats
            $total = DB::table('muestras')->count();
            $pending = DB::table('muestras')->where('estatus', 0)->count();
            $approved = DB::table('muestras')->where('estatus', 1)->count();

            // 2. Recent activity from history
            $recentChanges = DB::table('historial_modificaciones as h')
                ->join('muestras as m', 'h.id_muestra', '=', 'm.id_muestra')
                ->select('h.*', 'm.estacion')
                ->orderBy('h.fecha', 'desc')
                ->take(5)
                ->get();

            // 3. QA/QC consistency score based on Conductivity (if available)
            // Param 26: CE Lab, Param 27: CE Terreno
            $samplesQC = DB::table('muestras')
                ->whereNotNull('parametro_26')
                ->whereNotNull('parametro_27')
                ->where('parametro_26', '!=', '')
                ->where('parametro_27', '!=', '')
                ->where('parametro_26', '!=', '0')
                ->where('parametro_27', '!=', '0')
                ->select(['parametro_26', 'parametro_27'])
                ->get();

            $consistentCount = 0;
            $qcTotalComp = count($samplesQC);

            foreach ($samplesQC as $s) {
                $vLab = $this->parseValue($s->parametro_26);
                $vTerr = $this->parseValue($s->parametro_27);

                if ($vLab > 0 && $vTerr > 0) {
                    $diff = abs($vLab - $vTerr) / $vTerr;
                    if ($diff <= 0.10) {
                        $consistentCount++;
                    }
                }
            }

            $qcScore = $qcTotalComp > 0 ? round(($consistentCount / $qcTotalComp) * 100, 1) : 100;

            // 4. Monthly distribution of imports (last 6 months)
            // date_up column exists in muestras table based on ExcelImportService
            $monthlyDistribution = DB::table('muestras')
                ->select(DB::raw("DATE_FORMAT(date_up, '%Y-%m') as month"), DB::raw('count(*) as count'))
                ->where('date_up', '>', now()->subMonths(6))
                ->groupBy('month')
                ->orderBy('month', 'asc')
                ->get();

            return response()->json([
                'stats' => [
                    'total' => $total,
                    'pending' => $pending,
                    'approved' => $approved,
                    'qc_score' => $qcScore,
                ],
                'recent_changes' => $recentChanges,
                'monthly_imports' => $monthlyDistribution
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    private function parseValue($v)
    {
        $v = str_replace(',', '.', (string)$v);
        $v = preg_replace('/[<>]/', '', $v);
        return (float)$v;
    }
}
