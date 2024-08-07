<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\healthcare_details;

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
            \Log::info('category',[$category]);
            if ($category == 'Hospital') {
                $hospitalName = $request->input('query');
                $hospital = healthcare_details::where('hospital_name', 'like', "%{$hospitalName}%")->first();
                \Log::info('hospital',[$hospital]);
                return [
                    "status" => true,
                    "data" => $hospital,
                ];
            }
            if ($category == 'Doctor') {
                $doctorName = $request->input('query');
                $doctor = healthcare_details::where('doctor_name', 'like', "%{$doctorName}%")->first();
                \Log::info('doctor',[$doctor]);
                return [
                    "status" => true,
                    "data" => $doctor,
                ];
            }
            if ($category == 'Disease') {
                $diseaseName = $request->input('query');
                $disease = healthcare_details::where('disease_name', 'like', "%{$diseaseName}%")->first();
                \Log::info('disease',[$disease]);
                return [
                    "status" => true,
                    "data" => $disease,
                ];
            }
            // return view('home', compact(''));
        } catch (\Exception $e) {
            return [
                "status" => false,
                "message" => $e->getMessage()
            ];
        }
    }
}