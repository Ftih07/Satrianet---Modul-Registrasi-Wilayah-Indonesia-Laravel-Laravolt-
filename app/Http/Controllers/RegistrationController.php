<?php

namespace App\Http\Controllers;

use App\Models\Registration;
use Illuminate\Http\Request;

class RegistrationController extends Controller
{
    public function index()
    {
        $registrations = Registration::with(['province', 'city', 'district', 'village', 'product'])
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
            'name'            => 'required|string|max:255',
            'email'           => 'nullable|email|max:255',
            'phone'           => 'nullable|string|max:20',
            'product_id'      => 'required|exists:products,id',
            'referral'        => 'nullable|string|max:255',
            'status'          => 'nullable|string|max:255',
            'koordinat'       => 'nullable|string|max:255',
            'alamat_spesifik' => 'nullable|string|max:1000',

            'province_code'   => 'required|exists:indonesia_provinces,code',
            'city_code'       => 'required|exists:indonesia_cities,code',
            'district_code'   => 'required|exists:indonesia_districts,code',
            'village_code'    => 'required|exists:indonesia_villages,code',
        ]);

        Registration::create($request->only([
            'name',
            'email',
            'phone',
            'product_id',
            'referral',
            'status',
            'koordinat',
            'alamat_spesifik',
            'province_code',
            'city_code',
            'district_code',
            'village_code',
        ]));

        return redirect()->back()->with('success', 'Registrasi berhasil disimpan.');
    }
}
