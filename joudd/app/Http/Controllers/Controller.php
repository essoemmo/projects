<?php

namespace App\Http\Controllers;

use App\Help\Greg2HijriDate;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Help\Date2Time;

class Controller extends BaseController {

    use
        AuthorizesRequests,
        DispatchesJobs,
        ValidatesRequests;

    //extra functions
    private function editFuncMaker(array $items, $func_name = "edit") {
        $s = $func_name . '(';
        foreach ($items as $item) {
            $s .= '\'';
            $s .= $item;
            $s .= '\',';
        }
        $s = rtrim($s, ',');
        $s .= ')';
        return $s;
    }

    protected function generateHtmlEdit_Delete(array $items, $itemId, $deleteOnly = false, $func_name = "edit") {
        if ($deleteOnly) {
            $html = '<a href="delete?id=' . $itemId . '"  class="btn btn-icon waves-effect waves-light btn btn-danger" title="' . _i("Delete") . '">
                   <i class="fa fa-remove"></i></a></div>';
            return $html;
        }
        $html = '<div class="text-center"><a onclick="' . $this->editFuncMaker($items, $func_name) . '" id="item_id_' . $itemId . '" class="btn btn-icon waves-effect waves-light btn-primary" data-toggle="modal" data-target="#modal-edit" title="' . _i("Edit") . '">
                   <i class="fa fa-edit"></i></a>
                   <a href="delete?id=' . $itemId . '"  class="btn btn-icon waves-effect waves-light btn btn-danger" title="' . _i("Delete") . '">
                   <i class="fa fa-remove"></i></a></div>';
        return $html;
    }
    protected function generateHtmlEdit_Del(array $items, $itemId, $deleteOnly = false, $func_name = "edit") {
        if ($deleteOnly) {
            $html = '<a href="delete?id=' . $itemId . '"  class="btn btn-icon waves-effect waves-light btn btn-danger" title="' . _i("Delete") . '">
                   <i class="fa fa-remove"></i></a></div>';
            return $html;
        }
        $html = '<div class="text-center"><a onclick="' . $this->editFuncMaker($items, $func_name) . '" id="item_id_' . $itemId . '" class="btn btn-icon waves-effect waves-light btn-primary" data-toggle="modal" data-target="#modal-edit" title="' . _i("Edit") . '">
                   <i class="fa fa-edit"></i></a>
                   <a href="del?id=' . $itemId . '"  class="btn btn-icon waves-effect waves-light btn btn-danger" title="' . _i("Delete") . '">
                   <i class="fa fa-remove"></i></a></div>';
        return $html;
    }

    public function test() {
        $year = date('Y');
        $greg_hijriDate = new Greg2HijriDate();
        $hijriDate = $greg_hijriDate->Greg2Hijri(1, 1, $year, false);
        $current_hijri_year = (int) $hijriDate["year"];
        //echo $hijri_year."pppppp";
        $data = DB::select("select MAX(created_at) as d from communications");
        if (count($data) > 0) {
            $last = substr($data[0]->d, 0, 4);
            //   echo $last."--------";
            $hijriDate = $greg_hijriDate->Greg2Hijri(1, 1, $last, false);
            $last_record = $hijriDate["year"];
            // $current_hijri_year = 1441;

            if ($last_record != $current_hijri_year) {
                //start archeive
                DB::statement("insert into comm_operations_arch (comm_id,operation_type,destination,redirect_to_id,created,description,created_at,updated_at)" .
                        " select comm_id,operation_type,destination,redirect_to_id,created,description,created_at,updated_at from comm_operations");
                DB::statement("delete from comm_operations");
                DB::statement("insert into communications_arch (record_number,comm_type_id,creator_id,status,title,created,created_at,updated_at,year)" .
                        " select record_number,comm_type_id,creator_id,status,title,created,created_at,updated_at,{$last_record} from communications");
                DB::statement("delete from communications");
            }
        }
    }

    public function print_cert($id) {
                                    
       $result = $this->get($id);
        if ($result == null)
            return view("not-found");
        $start_date = explode('-', $result->start_date);
        $year = $start_date[0];
        $month = $start_date[1];
        $day = $start_date[2];
        $greg_hijriDate = new Greg2HijriDate();
        $hijriDate = $greg_hijriDate->Greg2Hijri($day, $month, $year, false);
        //$hijriMonth = array("Muharram", "Safar", "Rab? al-Awwal", "Rab? ath-Th?n? ", "Jum?d? al-Ula", "Jum?d? ath-Th?niya", "Rajab", "Sha'ban", "Ramadan", "Shawwal", "Dh? al-Qa'da", "Dh? al-Hijjah");
//        $hijri_year = $hijriDate["year"];
        $hijri_year = (int) $hijriDate["year"];
        $hijri_month = $hijriDate["month"]; // $hijriMonth[$hijriDate["month"] - 1];
        $hijri_day = (int) $hijriDate["day"];
//        dd($hijri_year);
//        dd($hijriDate);
        // calculate time to course
        $date_to_time = new Date2Time();
        $time = $date_to_time->calulatetime($result->start_date, $result->end_date);
//dd($time);
        $start = \DateTime::createFromFormat("Y-m-d", $result->start_date)->format("d-m-Y");


        $html = view('user.print', ["result" => $result, "hijri_year" => $hijri_year, "hijri_month" => $hijri_month,
            "hijri_day" => $hijri_day, "time" => $time, "date" => $start])->render();
        //$html = "عنوان";
//dd(asset("fonts"));

        $defaultConfig = (new \Mpdf\Config\ConfigVariables())->getDefaults();
        $fontDirs = $defaultConfig['fontDir'];

        $defaultFontConfig = (new \Mpdf\Config\FontVariables())->getDefaults();
        $fontData = $defaultFontConfig['fontdata'];
//dd(asset("fonts"));
        $mpdf = new \Mpdf\Mpdf(
                [
//            'fontDir' => array_merge($fontDirs, [
//                asset("fonts"),
//            ]),
//            'fontdata' => $fontData + [
//        'al-mohanad' => [
//            'R' => 'al-mohanad.ttf',
//            'I' => 'al-mohanad.ttf',
//        ],
//        'Cairo-Black' => [
//            'R' => 'Cairo-Black.ttf',
//            'I' => 'Cairo-Black.ttf',
//        ]
//            ],
                      'UTF-8' => 'A4',
           'default_font' => 'Cairo-Black',
                    'orientation' => 'L'
        ]);




//        $mpdf = new \Mpdf\Mpdf(['default_font_size' => 9,
//            'default_font' => 'Cairo-Black', 'orientation' => 'L']);
        $mpdf->autoScriptToLang = true;
        $mpdf->autoLangToFont = true;
        //$mpdf->SetFont("Akkadian");
        $barcode = \QrCode::size(100)->generate(url('/') . "/user/cert/" . $result->cert_no);
        $barcode = trim($barcode, '<?8-UTF="encoding" 0.1="version xml>');
        $mpdf->SetHTMLHeader('   <div class="certificate-number">
                <strong>شهادة رقم :</strong>
                ' .  $result->cert_no. '
            </div>
            <div class="logo"><img src="' . asset('cert/logo.png') . '" alt=""></div>');
        $mpdf->SetHTMLFooter('  <div class="barcode">
                ' . $barcode . '
            </div>
            <div class="footer-note"> للتحقق من الشهادة الرجاء الدخول علي موقع الجمعية ( http://www.hailh.org.sa/ ) والضغط على
                أيقونة ( التحقق من الشهادة )
            </div>');
        $html = iconv("UTF-8", "UTF-8//IGNORE", $html);
        //$mpdf->SetTopMargin(5);
        //$mpdf->SetLeftMargin(5);
        //$mpdf->SetMargins(10, 10, 2);
        $mpdf->WriteHTML($html);
        $mpdf->Output();

//return $pdf->download('invoice.pdf');
        return view('user.cert', ["result" => $result, "hijri_year" => $hijri_year, "hijri_month" => $hijri_month,
            "hijri_day" => $hijri_day, "time" => $time, "date" => $start]);
    }
    private function get($id)
    {
          $applicants = DB::table('applicants')->select('applicants.first_name', 'applicants.last_name', 'applicants.personal_id', 'applicants.created_at',
                        'courses.title', 'courses.start_date', 'courses.end_date', "courses.duration", "applicant_course.id","applicant_course.cert_no")
                ->join('applicant_course', 'applicant_course.applicant_id', '=', 'applicants.id')
                ->join('courses', 'applicant_course.course_id', '=', 'courses.id')
                ->join('applicant_results', function($join) {
            $join->on('applicant_results.course_id', '=', 'applicant_course.course_id')
            ->on('applicant_results.applicant_id', '=', 'applicant_course.applicant_id');
        })
        // ->join('aplicant_results', 'aplicant_results.course_id', '=', 'courses.id')

        ;
        $applicants->where('applicant_course.cert_no', '=', $id);
        $result = $applicants->get()->first();
        return $result;
    }
     public function cert($id) {
      $result = $this->get($id);
        if ($result == null)
            return view("not-found");

        $start_date = explode('-', $result->start_date);
        $year = $start_date[0];
        $month = $start_date[1];
        $day = $start_date[2];
        $greg_hijriDate = new Greg2HijriDate();
        $hijriDate = $greg_hijriDate->Greg2Hijri($day, $month, $year, false);
        $hijri_year = (int) $hijriDate["year"];
        $hijri_month = $hijriDate["month"]; // $hijriMonth[$hijriDate["month"] - 1];
        $hijri_day = (int) $hijriDate["day"];
        $date_to_time = new Date2Time();
        $time = $date_to_time->calulatetime($result->start_date, $result->end_date);
        $start = \DateTime::createFromFormat("Y-m-d", $result->start_date)->format("d-m-Y");
        return view('user.cert', ["result" => $result, "hijri_year" => $hijri_year, "hijri_month" => $hijri_month,
            "hijri_day" => $hijri_day, "time" => $time, "date" => $start])->render();
       
    }

}
