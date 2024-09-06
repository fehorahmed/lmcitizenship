<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use App\Models\TransactionLog;
use Illuminate\Http\Request;

class TransactionLogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }


    public function accountDetail(Request $request)
    {
        $request->validate([
            "option" => 'nullable|string|required_with:search|max:255',
            "search" => 'nullable|string|max:255',
            "status" => 'nullable|string|max:255',
            "start_date" => 'nullable|date|required_with:end_date',
            "end_date" => 'nullable|date|required_with:start_date',
        ]);
        $query= TransactionLog::query();
        if($request->start_date && $request->end_date){
            $query->whereBetween('date',[$request->start_date,$request->end_date]);
        }
        if($request->status){
            $query->where('is_active',$request->status);
        }

        if($request->option){
            $option = $request->option;
            $data = $request->search;
            $query->whereHas('user',function($q) use ($option,$data){
                $q->where($option,'LIKE',"%{$data}%");
            });
        }
        if($request->download){
            // dd($request->all());
            $settings=Setting::first();
            $data['datas'] =  $datas = $query->get();
            $data['settings'] = $settings;
            // $data['rules'] = $rules;

            //Mpdf
            $defaultConfig = (new \Mpdf\Config\ConfigVariables())->getDefaults();
            $fontDirs = $defaultConfig['fontDir'];

            $defaultFontConfig = (new \Mpdf\Config\FontVariables())->getDefaults();
            $fontData = $defaultFontConfig['fontdata'];

            $mpdf = new \Mpdf\Mpdf([
                'fontDir' => array_merge($fontDirs, [
                    public_path('fonts'),
                ]),
                'fontdata' => $fontData + [ // lowercase letters only in font key
                    'solaimanlipi' => [
                        'R' => 'SolaimanLipi12.ttf',
                        'useOTL' => 0xFF,
                    ]
                ],
                'default_font' => 'solaimanlipi',
                // 'orientation' => 'L',
                // 'margin_top' => 0,
                // 'margin_left' => 0,
                // 'margin_right' => 0,
                'mirrorMargins' => true
            ]);
            $mpdf->WriteHTML(view('admin.pdf.payments',  $data));
            $mpdf->Output("payments.pdf", 'D');
        }




        $datas = $query->orderBy('id', 'DESC')->paginate(15);
        return view('admin.account.index', compact('datas'));
    }
}
