<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use stdClass;

class IndexController extends Controller
{
    public function getData()
    {
        $allData = [];

        $hw_query = DB::table('dbo.hw_data AS data')
            ->join('dbo.claves AS claves', 'claves.clave', '=', 'data.dest')
            ->join('dbo.municipios AS municipios', 'claves.mcpio', '=', 'municipios.code')
            ->join('dbo.hw_causas AS causas', 'data.causa', '=', 'causas.code')
            ->selectRaw('municipios.mcpio AS municipio, data.dest AS centro, data.indic AS indicador, causas.ClaseNER AS forma,
            count(*) AS llamadas')
            ->groupBy('municipios.mcpio', 'data.dest', 'data.indic', 'causas.ClaseNER')
            ->havingRaw("(causas.ClaseNER LIKE 'USR' OR causas.ClaseNER LIKE 'OK') AND
                        (data.indic LIKE 'LDNE' OR data.indic LIKE 'LDIE')")
            ->get();

        $hw_query2 = $hw_query;

        $alc_query = DB::table('dbo.alc_data AS data')
            ->join('dbo.claves AS claves', 'claves.clave', '=', 'data.dest')
            ->join('dbo.alc_causas AS causas', 'data.causa', '=', 'causas.code')
            ->selectRaw('data.dest AS centro, data.indic AS indicador, causas.ClaseNER AS forma,
            count(*) AS llamadas')
            ->groupBy('data.dest', 'data.indic', 'causas.ClaseNER')
            ->havingRaw("(causas.ClaseNER LIKE 'USR' OR causas.ClaseNER LIKE 'OK') AND
                        (data.indic LIKE 'LDNE' OR data.indic LIKE 'LDIE')")
            ->get();


        // return response()->json([
        //     "data" => $alc_query
        // ]);

        foreach ($hw_query as $hw_q) {
            $data = new stdClass();
            $centro = $hw_q->centro;
            $municipio = $hw_q->municipio;


            $data->centro = $centro;
            $data->municipio = $municipio;

            $okLDNE = 0;
            $usrLDNE = 0;
            $okLDIE = 0;
            $usrLDIE = 0;
            $total = 0;

            foreach ($hw_query2 as $hw_q2) {
                if ($hw_q2->centro == $centro) {
                    $llamadas = (int)$hw_q2->llamadas;
                    $total = $total + $llamadas;
                    if ($hw_q2->indicador == "LDNE") {

                        if ($hw_q2->forma == "OK") {
                            $okLDNE = $okLDNE + $llamadas;
                        } else {
                            $usrLDNE = $usrLDNE + $llamadas;
                        }
                    } else {
                        if ($hw_q2->forma == "OK") {
                            $okLDIE = $okLDIE + $llamadas;
                        } else {
                            $usrLDIE = $usrLDIE + $llamadas;
                        }
                    }
                }
            }
            foreach ($alc_query as $alc_q) {
                if ($alc_q->centro == $centro) {
                    $llamadas = (int)$alc_q->llamadas;
                    $total = $total + $llamadas;
                    if ($alc_q->indicador == "LDNe") {

                        if ($alc_q->forma == "OK") {
                            $okLDNE = $okLDNE + $llamadas;
                        } else {
                            $usrLDNE = $usrLDNE + $llamadas;
                        }
                    } else {
                        if ($alc_q->forma == "OK") {
                            $okLDIE = $okLDIE + $llamadas;
                        } else {
                            $usrLDIE = $usrLDIE + $llamadas;
                        }
                    }
                }
            }
            $NerLDNE = (($okLDNE + $usrLDNE) * 100) / $total;
            $NerLDIE = (($okLDIE + $usrLDIE) * 100) / $total;

            $data->NerLDNE = $NerLDNE;
            $data->NerLDIE = $NerLDIE;

            $allData[] = $data;
        }
        return response()->json([
            "data" => $allData
        ]);
    }
}
