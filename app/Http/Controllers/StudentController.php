<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class StudentController extends Controller
{
    public function index()
    {
        $students = Student::all();

        return view('student.index', [
            'students' => $students
        ]);
    }

    public function create()
    {
        return view('student.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nim' => 'required|unique:students,nim',
            'nama' => 'required',
            'email' => 'required|email',
            'prodi' => 'required',
            'foto' => 'required|image|mimes:jpg,jpeg,png|max:2048'
        ], [
            'nim.required' => 'NIM harus diisi.',
            'nim.unique' => 'NIM sudah digunakan.',
            'nama.required' => 'Nama harus diisi.',
            'email.required' => 'Email harus diisi.',
            'email.email' => 'Format email tidak valid.',
            'prodi.required' => 'Program studi harus diisi.',
            'foto.required' => 'Foto harus diisi.',
            'foto.image' => 'File harus berupa gambar.',
            'foto.mimes' => 'Foto harus berformat jpg, jpeg, atau png.',
            'foto.max' => 'Ukuran foto maksimal 2MB.'
        ]);

        $foto = $request->file('foto')->store('foto-siswa', 'public');

        $student = new Student();
        $student->nim = $request->nim;
        $student->nama = $request->nama;
        $student->email = $request->email;
        $student->prodi = $request->prodi;
        $student->foto = $foto;

        if ($student->save()) {
            return redirect('/student')->with([
                'notifikasi' => 'Data berhasil disimpan!',
                'type' => 'success'
            ]);
        }

        return redirect()->back()->with([
            'notifikasi' => 'Data gagal disimpan!',
            'type' => 'error'
        ]);
    }

    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        $student = Student::where('nim', $id)->first();

        if (!$student) {
            return redirect('/student')->with([
                'notifikasi' => 'Data siswa tidak ditemukan!',
                'type' => 'error'
            ]);
        }

        return view('student.edit', [
            'student' => $student
        ]);
    }

    public function update(Request $request, string $id)
    {
        $student = Student::where('nim', $id)->first();

        if (!$student) {
            return redirect('/student')->with([
                'notifikasi' => 'Data tidak ditemukan!',
                'type' => 'error'
            ]);
        }

        $request->validate([
            'nim' => 'required|unique:students,nim,' . $id . ',nim',
            'nama' => 'required',
            'email' => 'required|email',
            'prodi' => 'required',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
        ], [
            'nim.required' => 'NIM harus diisi.',
            'nim.unique' => 'NIM sudah digunakan.',
            'nama.required' => 'Nama harus diisi.',
            'email.required' => 'Email harus diisi.',
            'email.email' => 'Format email tidak valid.',
            'prodi.required' => 'Program studi harus diisi.',
            'foto.image' => 'File harus berupa gambar.',
            'foto.mimes' => 'Foto harus berformat jpg, jpeg, atau png.',
            'foto.max' => 'Ukuran foto maksimal 2MB.'
        ]);

        $student->nim = $request->nim;
        $student->nama = $request->nama;
        $student->email = $request->email;
        $student->prodi = $request->prodi;

        if ($request->hasFile('foto')) {
            if ($student->foto && Storage::disk('public')->exists($student->foto)) {
                Storage::disk('public')->delete($student->foto);
            }

            $foto = $request->file('foto')->store('foto-siswa', 'public');
            $student->foto = $foto;
        }

        $student->save();

        return redirect('/student')->with([
            'notifikasi' => 'Data berhasil diupdate!',
            'type' => 'success'
        ]);
    }

    public function destroy(string $id)
    {
        $student = Student::where('nim', $id)->first();

        if (!$student) {
            return redirect('/student')->with([
                'notifikasi' => 'Data siswa tidak ditemukan!',
                'type' => 'error'
            ]);
        }

        if ($student->foto && Storage::disk('public')->exists($student->foto)) {
            Storage::disk('public')->delete($student->foto);
        }

        if ($student->delete()) {
            return redirect('/student')->with([
                'notifikasi' => 'Data berhasil dihapus!',
                'type' => 'success'
            ]);
        }

        return redirect()->back()->with([
            'notifikasi' => 'Data gagal dihapus!',
            'type' => 'error'
        ]);
    }
}