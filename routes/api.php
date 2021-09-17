<?php

use App\Http\Controllers\IndexController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\TestTable;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Route::get('calls', function () {
//     return response()->json([
//         "data" => [
//             [
//                 "centro" => "DL0",
//                 "nombre" => "Delicia",
//                 "municipio" => "Ranchuelo",
//                 "NerLDNE" => 51.73501577287066,
//                 "NerLDIE" => 68.75
//             ],
//             [
//                 "centro" => "GR0",
//                 "nombre" => "Guaracabulla",
//                 "municipio" => "Placetas",
//                 "NerLDNE" => 57.43363885251756,
//                 "NerLDIE" => 63.31658291457286
//             ],
//             [
//                 "centro" => "SAGI",
//                 "nombre" => "GI 26-Julio (Sagua la Grande)",
//                 "municipio" => "Sagua la Grande",
//                 "NerLDNE" => 67.76714513556618,
//                 "NerLDIE" => 64.21257062146893
//             ],
//             [
//                 "centro" => "MRN0",
//                 "nombre" => "Mariana Grajales",
//                 "municipio" => "Santa Clara",
//                 "NerLDNE" => 58.90157555654781,
//                 "NerLDIE" => 58.93970893970894
//             ],
//             [
//                 "centro" => "IF0",
//                 "nombre" => "Cifuentes",
//                 "municipio" => "Cifuentes",
//                 "NerLDNE" => 59.24399653408153,
//                 "NerLDIE" => 72.82449150765359
//             ],
//             [
//                 "centro" => "LD0",
//                 "nombre" => "Lutgardita",
//                 "municipio" => "Corralillo",
//                 "NerLDNE" => 52.750754780275074,
//                 "NerLDIE" => 13.307984790874524
//             ],
//             [
//                 "centro" => "MAT",
//                 "nombre" => "Mata",
//                 "municipio" => "Cifuentes",
//                 "NerLDNE" => 57.5278975025093,
//                 "NerLDIE" => 67.816091954023
//             ],
//             [
//                 "centro" => "VN0",
//                 "nombre" => "Viñas",
//                 "municipio" => "Remedios",
//                 "NerLDNE" => 54.4980443285528,
//                 "NerLDIE" => 0
//             ],
//             [
//                 "centro" => "YE0",
//                 "nombre" => "San Juan de los Yeras",
//                 "municipio" => "Ranchuelo",
//                 "NerLDNE" => 29.816008806416104,
//                 "NerLDIE" => 28.79141794272861
//             ],
//             [
//                 "centro" => "JSM",
//                 "nombre" => "Jose Marti",
//                 "municipio" => "Santa Clara",
//                 "NerLDNE" => 28.83248056349259,
//                 "NerLDIE" => 34.01915572898191
//             ],
//             [
//                 "centro" => "DV0",
//                 "nombre" => "San Diego del Valle",
//                 "municipio" => "Cifuentes",
//                 "NerLDNE" => 29.930699247873353,
//                 "NerLDIE" => 33.8006230529595
//             ],
//             [
//                 "centro" => "NISA",
//                 "nombre" => "Nueva Isabela",
//                 "municipio" => "Sagua la Grande",
//                 "NerLDNE" => 66.62452591656131,
//                 "NerLDIE" => 60.267857142857146
//             ],
//             [
//                 "centro" => "CZ0",
//                 "nombre" => "Calabazar de Sagua",
//                 "municipio" => "Encrucijada",
//                 "NerLDNE" => 27.13764492604719,
//                 "NerLDIE" => 33.9430029774564
//             ],
//             [
//                 "centro" => "OT0",
//                 "nombre" => "Motembo",
//                 "municipio" => "Corralillo",
//                 "NerLDNE" => 27.290739411342425,
//                 "NerLDIE" => 27.68777614138439
//             ],
//             [
//                 "centro" => "ECV",
//                 "nombre" => "Emilio Cordova",
//                 "municipio" => "Encrucijada",
//                 "NerLDNE" => 56.70123787219806,
//                 "NerLDIE" => 66.78885630498533
//             ],
//             [
//                 "centro" => "ZL0",
//                 "nombre" => "Zulueta",
//                 "municipio" => "Remedios",
//                 "NerLDNE" => 30.51713770294648,
//                 "NerLDIE" => 38.06176249058499
//             ],
//             [
//                 "centro" => "JBC",
//                 "nombre" => "Jibacoa",
//                 "municipio" => "Manicaragua",
//                 "NerLDNE" => 54.241754505270315,
//                 "NerLDIE" => 81.60535117056857
//             ],
//             [
//                 "centro" => "ZHHM",
//                 "nombre" => "ZH Hospital Materno",
//                 "municipio" => "Santa Clara",
//                 "NerLDNE" => 40.06695140251645,
//                 "NerLDIE" => 55.42168674698795
//             ],
//             [
//                 "centro" => "DV0",
//                 "nombre" => "San Diego del Valle",
//                 "municipio" => "Cifuentes",
//                 "NerLDNE" => 29.930699247873353,
//                 "NerLDIE" => 33.8006230529595
//             ],
//             [
//                 "centro" => "PCH",
//                 "nombre" => "La Panchita",
//                 "municipio" => "Santa Clara",
//                 "NerLDNE" => 59.66452385889726,
//                 "NerLDIE" => 50.55741360089186
//             ],
//             [
//                 "centro" => "RH0",
//                 "nombre" => "Ranchuelo",
//                 "municipio" => "Ranchuelo",
//                 "NerLDNE" => 59.35915462951127,
//                 "NerLDIE" => 69.53286008701626
//             ],
//             [
//                 "centro" => "OD0",
//                 "nombre" => "Rodrigo",
//                 "municipio" => "Santo Domingo",
//                 "NerLDNE" => 29.008722981207107,
//                 "NerLDIE" => 35.214785214785216
//             ],
//             [
//                 "centro" => "CS0",
//                 "nombre" => "Carbo Servia",
//                 "municipio" => "Placetas",
//                 "NerLDNE" => 62.01639580037394,
//                 "NerLDIE" => 83.41463414634147
//             ]
//         ]
//     ]);
// });

Route::get('calls', [IndexController::class, 'getData']);
