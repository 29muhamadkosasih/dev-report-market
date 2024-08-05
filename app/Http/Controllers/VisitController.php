<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Visit;
use App\Models\Customer;
use App\Models\Karyawan;
use App\Models\Visitors;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VisitController extends Controller
{
    public function index()
    {
        $data = Visit::all();
        $usData = Visit::where('user_id', Auth::id())->get();
        return view('pages.visit.index', [
            'data' => $data,
            'usData' => $usData,
        ]);
    }

    public function create()
    {
        $cus = Customer::all();

        $karyawan = Karyawan::where('is_active', '!=', 3)->whereNotIn('id', [1, 2])->get();
        return view('pages.visit.create', [
            'cus' => $cus,
            'karyawan' => $karyawan,
        ]);
    }
    public function store(Request $request)
    {
        // dd($request->all());
        $newNumber = Visit::generateNumber();

        $visit = Visit::create([
            'vi_number' => $newNumber,
            'client_id' => $request->client_id,
            'lokasi' => $request->lokasi,
            'date' => $request->date,
            'agenda' => $request->agenda,
            'jam' => $request->jam,
            'jam_selesai' => $request->jam_selesai,
            'result' => $request->result,
            'fo_1' => $request->fo_1,
            'fo_2' => $request->fo_2,
            'fo_3' => $request->fo_3,
            'user_id' => Auth::id()
        ]);

        // Menambahkan pengunjung
        $names = $request->input('nama_visitor', []);
        foreach ($names as $name) {
            Visitors::create([
                'visitor_id' => $name,
                'vi_number' => $visit->vi_number
            ]);
        }

        // Menambahkan kehadiran
        $Attendance = $request->input('attendance_client', []);
        foreach ($Attendance as $attendance) {
            Attendance::create([
                'desc' => $attendance,
                'vi_number' => $visit->vi_number
            ]);
        }


        return redirect()->route('visit.index')->with('success', 'Data has been Added successfully.');
    }

    public function edit($id)
    {
        $edit = Visit::find($id);
        $cus = Customer::all();
        $karyawan = Karyawan::where('is_active', '!=', 3)->whereNotIn('id', [1, 2])->get();

        return view('pages.visit.edit', [
            'edit' => $edit,
            'cus' => $cus,
            'karyawan' => $karyawan,
        ]);
    }

    public function update(Request $request, $id)
    {
        dd($request);
        $edit = Visit::find($id);
        // Memperbarui data perusahaan
        $edit->update([
            'client_id' => $request->client_id,
            'lokasi' => $request->lokasi,
            'date' => $request->date,
            'agenda' => $request->agenda,
            'jam' => $request->jam,
            'jam_selesai' => $request->jam_selesai,
            'result' => $request->result,
            'fo_1' => $request->fo_1,
            'fo_2' => $request->fo_2,
            'fo_3' => $request->fo_3,
        ]);

        // Menambahkan pengunjung
        $names = $request->input('nama_visitor', []);
        foreach ($names as $name) {
            Visitors::updateOrCreate(
                ['visitor_id' => $name], // Kondisi pencarian
                ['vi_number' => $edit->vi_number] // Data yang akan diperbarui atau dibuat
            );
        }

        // Menambahkan kehadiran
        $attendances = $request->input('attendance_client', []);
        foreach ($attendances as $attendance) {
            Attendance::updateOrCreate(
                ['desc' => $attendance], // Kondisi pencarian
                ['vi_number' => $edit->vi_number] // Data yang akan diperbarui atau dibuat
            );
        }



        return redirect()->route('visit.index')->with('success', 'Data has been Updated successfully.');
    }

    public function destroy($id)
    {
        $delete = Visit::where('id', $id)->first();
        Visitors::where('vi_number', $delete->vi_number)->delete();
        Attendance::where('vi_number', $delete->vi_number)->delete();
        $delete->delete();

        return redirect()->route('visit.index')->with('success', 'Data has been Deleted successfully.');
    }
}
