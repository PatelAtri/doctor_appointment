<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\healthcare_details;
use App\Models\loginUser;

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

    public function login(Request $request) {
    // \Log::info('login request',[$request->all()]);
        $email = $request->input('email');
        $password = $request->input('password');
        \Log::info('email',[$email]);
        \Log::info('password',[$password]);
        $user = new \App\Models\loginUser();
        $user->name = "John";
        $user->email = $email;
        $user->password = bcrypt($request->input('password')); // Hash the password
        $user->address = "abc street, africa";
        $user->user_contact_no = "1234567890";
        $user->save();
        $user = loginUser::where('email',$email)->first();
        \Log::info('user',[$user]);
        if ($user && \Hash::check($password, $user->password)) {
            return [
                "status" => true
            ];
        } else {
            return 
                ["status" => false
            ];
        }
    }
}