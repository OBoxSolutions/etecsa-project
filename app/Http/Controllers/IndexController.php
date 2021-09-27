<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use stdClass;
use Carbon\Carbon;


class IndexController extends Controller
{
    public function getData()
    {
        $allData = [];
        $date = Carbon::now()->format('y-n-j');


        $hw_query = DB::table('dbo.hw_data AS data')
            ->join('dbo.claves AS claves', 'claves.clave', '=', 'data.dest')
            ->join('dbo.municipios AS municipios', 'claves.mcpio', '=', 'municipios.code')
            ->join('dbo.hw_causas AS causas', 'data.causa', '=', 'causas.code')
            ->selectRaw('claves.descr AS nombre, municipios.mcpio AS municipio, data.dest AS centro, data.indic AS indicador, causas.ClaseNER AS forma,
            count(*) AS llamadas')
            ->groupBy('claves.descr', 'municipios.mcpio', 'data.dest', 'data.indic', 'causas.ClaseNER')
            ->havingRaw("(causas.ClaseNER LIKE 'USR' OR causas.ClaseNER LIKE 'OK') AND
                        (data.indic LIKE 'LDNE' OR data.indic LIKE 'LDIE')")
            ->where("data.fecha", "=", $date)
            ->get();

        $hw_query2 = $hw_query;

        $alc_query = DB::table('dbo.alc_data AS data')
            ->join('dbo.claves AS claves', 'claves.clave', '=', 'data.dest')
            ->join('dbo.alc_causas AS causas', 'data.causa', '=', 'causas.code')
            ->selectRaw('claves.descr AS nombre, data.dest AS centro, data.indic AS indicador, causas.ClaseNER AS forma,
            count(*) AS llamadas')
            ->groupBy('claves.descr', 'data.dest', 'data.indic', 'causas.ClaseNER')
            ->havingRaw("(causas.ClaseNER LIKE 'USR' OR causas.ClaseNER LIKE 'OK') AND
                        (data.indic LIKE 'LDNE' OR data.indic LIKE 'LDIE')")
            ->get();


        // return response()->json([
        //     "data" => $hw_query
        // ]);

        foreach ($hw_query as $hw_q) {
            $data = new stdClass();
            $centro = $hw_q->centro;
            $municipio = $hw_q->municipio;
            $nombre = $hw_q->nombre;


            $data->centro = $centro;
            $data->nombre = $nombre;
            $data->municipio = $municipio;

            $okLDNE = 0;
            $usrLDNE = 0;
            $okLDIE = 0;
            $usrLDIE = 0;
            $totalLDNE = 0;
            $totalLDIE = 0;

            foreach ($hw_query2 as $hw_q2) {
                if ($hw_q2->centro == $centro) {
                    $llamadas = (int)$hw_q2->llamadas;
                    if ($hw_q2->indicador == "LDNE") {
                        if ($hw_q2->forma == "OK") {
                            $okLDNE = $okLDNE + $llamadas;
                        } else {
                            $usrLDNE = $usrLDNE + $llamadas;
                        }
                        $totalLDNE = $totalLDNE + $llamadas;
                    } else {
                        if ($hw_q2->forma == "OK") {
                            $okLDIE = $okLDIE + $llamadas;
                        } else {
                            $usrLDIE = $usrLDIE + $llamadas;
                        }
                        $totalLDIE = $totalLDIE + $llamadas;
                    }
                }
            }
            foreach ($alc_query as $alc_q) {
                if ($alc_q->centro == $centro) {
                    $llamadas = (int)$alc_q->llamadas;
                    if ($alc_q->indicador == "LDNe") {
                        if ($alc_q->forma == "OK") {
                            $okLDNE = $okLDNE + $llamadas;
                        } else {
                            $usrLDNE = $usrLDNE + $llamadas;
                        }
                        $totalLDNE = $totalLDNE + $llamadas;
                    } else {
                        if ($alc_q->forma == "OK") {
                            $okLDIE = $okLDIE + $llamadas;
                        } else {
                            $usrLDIE = $usrLDIE + $llamadas;
                        }
                        $totalLDIE = $totalLDIE + $llamadas;
                    }
                }
            }
            // var_dump($totalLDNE);
            // var_dump($totalLDIE);
            if ($totalLDNE != 0) {
                $NerLDNE = ($okLDNE * 100) / $totalLDNE;
                $data->NerLDNE = round($NerLDNE, 2);
            }
            else{
                $data->NerLDNE = 0;
            }
            if ($totalLDIE != 0) {
                $NerLDIE = ($okLDIE * 100) / $totalLDIE;
                $data->NerLDIE = round($NerLDIE, 2);
            }
            else{
                $data->NerLDIE = 0;
            }

            $allData[] = $data;
        }
        return response()->json([
            "data" => $allData
        ]);
    }
}
