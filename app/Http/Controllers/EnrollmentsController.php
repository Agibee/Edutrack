<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Enrollments;

class EnrollmentController extends Controller
{
    public function index()
    {
        $enrollments = Enrollments::all();
        return view('enrollments.index', compact('enrollments'));
    }

    public function show(Enrollments $enrollment)
    {
        return view('enrollments.show', compact('enrollment'));
    }

    public function destroy(Enrollments $enrollment)
    {
        $enrollment->delete();
        return redirect()->route('enrollments.index')->with('success','Enrollment berhasil dihapus');
    }
}


