<?php

namespace App\Http\Controllers;

use App\Models\Registration;
use Illuminate\Http\Request;

class RegistrationController extends Controller
{
    public function index()
    {
        $registrations = Registration::with(['province', 'city', 'district', 'village'])
            ->latest()
            ->paginate(20);

        return view('registrations.index', compact('registrations'));
    }

    public function create()
    {
        return view('registrations.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'           => 'required|string|max:255',
            'email'          => 'nullable|email|max:255',
            'phone'          => 'nullable|string|max:20',
            'id_product'     => 'required|string|unique:registrations,id_product',
            'referral'       => 'nullable|string|max:255',
            'status'         => 'nullable|string|max:255',
            'koordinat'      => 'nullable|string|max:255',
            'alamat_spesifik' => 'nullable|string|max:1000',

            'province_id' => 'required|exists:indonesia_provinces,code',
            'city_id'     => 'required|exists:indonesia_cities,code',
            'district_id' => 'required|exists:indonesia_districts,code',
            'village_id'  => 'required|exists:indonesia_villages,code',
        ]);

        Registration::create([
            'id_product'      => $request->id_product,
            'name'            => $request->name,
            'email'           => $request->email,
            'phone'           => $request->phone,
            'referral'        => $request->referral,
            'status'          => $request->status,
            'koordinat'       => $request->koordinat,
            'alamat_spesifik' => $request->alamat_spesifik,
            'province_code'   => $request->province_id,
            'city_code'       => $request->city_id,
            'district_code'   => $request->district_id,
            'village_code'    => $request->village_id,
        ]);

        return redirect()->back()->with('success', 'Registrasi berhasil disimpan.');
    }
}
