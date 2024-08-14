<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\healthcare_details;
use App\Models\loginUser;
use App\Models\appointmentData;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\AppointmentConfirmation;

class HomeController extends Controller
{
    public function index()
    {
        return view('home');
    }

    public function search(Request $request)
    {
        try {
            $category = $request->input('category');
            // \Log::info('category',[$category]);
            if ($category == 'Hospital') {
                $hospitalName = $request->input('query');
                $hospital = healthcare_details::where('hospital_name', 'like', "%{$hospitalName}%")
                    ->where('status', 1)
                    ->get();
                return [
                    "status" => true,
                    "data" => $hospital,
                ];
            }
            if ($category == 'Doctor') {
                $doctorName = $request->input('query');
                $doctor = healthcare_details::where('doctor_name', 'like', "%{$doctorName}%")
                    ->where('status', 1)
                    ->get();
                return [
                    "status" => true,
                    "data" => $doctor,
                ];
            }
            if ($category == 'Disease') {
                $diseaseName = $request->input('query');
                $disease = healthcare_details::where('disease_name', 'like', "%{$diseaseName}%")
                    ->where('status', 1)
                    ->get();
                return [
                    "status" => true,
                    "data" => $disease,
                ];
            }
        } catch (\Exception $e) {
            return [
                "status" => false,
                "message" => $e->getMessage()
            ];
        }
    }

    public function login(Request $request)
    {
        $email = $request->input('email');
        $password = $request->input('password');
        $user = loginUser::where('email', $email)->first();
        if ($user) {
            if (Hash::check($password, $user->password)) {
                return [
                    "status" => true,
                    "userId" => $user->id,
                ];
            } else {
                return [
                    "status" => false
                ];
            }
        } else {
            return [
                "status" => false
            ];
        }
    }

    public function signup(Request $request)
    {
        try {
            $user = new loginUser();
            $user->name = $request->input('name');
            $user->email = $request->input('email');
            $user->password = bcrypt($request->input('password')); // Hash the password
            $user->address = $request->input('address');
            $user->user_contact_no = $request->input('user_contact_no');
            $user->save();
            return [
                "status" => true,
                "message" => "Signup successfully done."
            ];
        } catch (\Exception $e) {
            \Log::info('signup error', [$e->getMessage()]);
            return [
                "status" => false,
                "message" => $e->getMessage()
            ];
        }
    }

    public function doctorData(Request $request)
    {
        $healthcare_details = healthcare_details::where('id', $request->hospitalId)->first();
        return [
            "status" => true,
            "data" => $healthcare_details
        ];
    }

    public function bookAppointment(Request $request)
    {
        parse_str($request->input('formData'), $formDataArray);

        $appointmentData = new AppointmentData();
        $appointmentData->hospital_id = $request->hospitalId;
        $appointmentData->user_id = $request->userId;
        $appointmentData->date = $formDataArray['appointment_date'];
        $appointmentData->time = $formDataArray['appointment_time'];
        $appointmentData->save();

        $doctor = healthcare_details::where('id', $request->hospitalId)->select('doctor_name', 'doctor_email')->first();
        $hospital = healthcare_details::where('id', $request->hospitalId)->select('hospital_name', 'hospital_email')->first();
        $user = LoginUser::where('id', $request->userId)->select('name', 'email')->first();

        // Prepare email data
        $userEmailData = [
            'name' => $user->name,
            'date' => $formDataArray['appointment_date'],
            'time' => $formDataArray['appointment_time']
        ];

        $doctorEmailData = [
            'name' => $doctor->doctor_name,
            'date' => $formDataArray['appointment_date'],
            'time' => $formDataArray['appointment_time']
        ];

        $hospitalEmailData = [
            'name' => $doctor->doctor_name,
            'date' => $formDataArray['appointment_date'],
            'time' => $formDataArray['appointment_time']
        ];

        // Send emails
        Mail::to($doctor->doctor_email)->send(new AppointmentConfirmation($doctorEmailData));
        Mail::to($hospital->hospital_email)->send(new AppointmentConfirmation($hospitalEmailData));
        Mail::to($user->email)->send(new AppointmentConfirmation($userEmailData));

        return [
            "status" => true,
            "message" => "Appointment booked and emails sent successfully."
        ];
    }
}