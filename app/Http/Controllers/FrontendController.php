<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Members;
use App\Models\PriceLists;
use Illuminate\Support\Facades\Validator;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendEmail;

class FrontendController extends Controller
{
    public function feHome(Request $request) {
        $datas = Members::all();
        $ipm_prices = PriceLists::where('type','IPM')->limit(5)->get();
        $cal_prices = PriceLists::where('type','Kalibrasi Alat Kesehatan')->limit(5)->get();
        $calib_prices = PriceLists::where('type','Kalibrasi Kalibrator')->limit(5)->get();

        return view('frontend.index', compact('datas','ipm_prices','cal_prices','calib_prices'));
    }

    public function feMembers(Request $request) {
        $datas = Members::all();
        return view('frontend.list-of-members', compact('datas'));
    }

    public function feIPMPrice(Request $request) {
        $ipm_prices = PriceLists::where('type','IPM')->get();
        return view('frontend.price-list-ipm', compact('ipm_prices'));
    }

    public function feCalibrationPrice(Request $request) {
        $cal_prices = PriceLists::where('type','Kalibrasi Alat Kesehatan')->get();
        $calib_prices = PriceLists::where('type','Kalibrasi Kalibrator')->get();
        return view('frontend.price-list-kalibrasi', compact('cal_prices','calib_prices'));
    }

    public function feMemberDetail($id) {
        $data = Members::find($id);
        return view('frontend.member-details', compact('data'));
    }

    public function feContactUs(Request $request) {
        return view('frontend.contact-us');
    }

    public function feAboutUs(Request $request) {
        return view('frontend.about-us');
    }

    public function feSendEmail(Request $request) {
        //define validation rules
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'subject' => 'required',
            'message' => 'required',
        ]);

        //check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $return = [];
        try {
            $data_insert = [
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'subject' => $request->subject,
                'message' => $request->message,
                'created_at' => now(),
                'updated_at' => now(),
            ];

            $message = [
                'nama' => $data_insert['name'],
                'no_telepon' => $data_insert['phone'],
                'email' => $data_insert['email'],
                'pesan' => $data_insert['message'],
                'tgl_jam' => date('d-M-Y H:i:s'),
            ];

            $data = [
                'subject' => 'Question - '.$data_insert['subject'],
                'title' => 'Pertanyaan',
                'subtitle' => $data_insert['name']." Membuat Pertanyaan.",
                'message' => $message,
                'url' => route('home.index'),
            ];

            Mail::to($data_insert['email'])->cc(env('MAIL_USERNAME'))->send(new SendEmail($data));

            DB::table('emails')->insert($data_insert);

            $return['message'] = 'Success Send Email';
            $return['url'] = route('home.index');
        } catch (Exception $e) {
            $return['message'] = $e->getMessage();
        }

        return $return;
    }
}
