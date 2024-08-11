<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\healthcare_details;
use App\Models\loginUser;
use Illuminate\Support\Facades\Hash;


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
                $hospital = healthcare_details::where('hospital_name', 'like', "%{$hospitalName}%")->get();
                return [
                    "status" => true,
                    "data" => $hospital,
                ];
            }
            if ($category == 'Doctor') {
                $doctorName = $request->input('query');
                $doctor = healthcare_details::where('doctor_name', 'like', "%{$doctorName}%")->get();
                return [
                    "status" => true,
                    "data" => $doctor,
                ];
            }
            if ($category == 'Disease') {
                $diseaseName = $request->input('query');
                $disease = healthcare_details::where('disease_name', 'like', "%{$diseaseName}%")->get();
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
        // \Log::info('hospital Id', [$request->hospitalId]);
        $healthcare_details = healthcare_details::where('id', $request->hospitalId)->first();
        return [
            "status" => true,
            "data" => $healthcare_details
        ];
        // return view('home', compact('healthcare_details'));
    }
}