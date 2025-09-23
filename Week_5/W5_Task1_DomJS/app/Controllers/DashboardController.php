<?php

namespace App\Controllers;

use App\Models\StudentModel;
use App\Models\CourseModel;

class DashboardController extends BaseController
{
    protected $studentModel;
    protected $courseModel;

    public function __construct()
    {
        $this->studentModel = new StudentModel();
        $this->courseModel = new CourseModel();
    }

    public function myDetail()
    {
        // 1. Dapatkan user_id dari session
        $userId = session()->get('user_id');

        // 2. Cari data student berdasarkan user_id menggunakan method yang sudah ada
        $student = $this->studentModel->where('user_id', $userId)->join('users', 'users.id = students.user_id')->first();

        if (empty($student)) {
            return redirect()->to('/home')->with('error', 'Data mahasiswa tidak ditemukan.');
        }

        $data = [
            'title'   => 'Detail Profil Saya',
            'student' => $student
        ];

        // Kita gunakan lagi view yang sudah ada
        return view('student_detail_view', $data);
    }

    // app/Controllers/DashboardController.php

    public function myCourses()
    {
        // 1. Dapatkan user_id dari session
        $userId = session()->get('user_id');

        // 2. Cari data student berdasarkan user_id
        $student = $this->studentModel->where('user_id', $userId)->first();
        
        // 3. Jika data student tidak ditemukan, beri pesan error
        if (!$student) {
            return redirect()->to('/home')->with('error', 'Hanya mahasiswa yang dapat melihat jadwal.');
        }

        // 4. Panggil model untuk mengambil data mata kuliah MENGGUNAKAN ID DARI TABEL STUDENTS
        $courses = $this->studentModel->getCoursesByStudentId($student['id']);

        $data = [
            'title' => 'Jadwal Mata Kuliah Saya',
            'courses' => $courses
        ];

        return view('my_courses_view', $data);
    }
    
    public function studentDetail($id = null)
    {
        $student = $this->studentModel->getStudentById($id);
        if (empty($student)) {
            return redirect()->to('/dashboard/students')->with('error', 'Data mahasiswa tidak ditemukan.');
        }
        $data = [
            'title' => 'Detail Mahasiswa',
            'student' => $student
        ];
        return view('student_detail_view', $data);
    }

    public function enroll()
    {
        $student = $this->studentModel->where('user_id', session()->get('user_id'))->first();
        if (!$student) {
            return redirect()->to('/home')->with('error', 'Data mahasiswa tidak ditemukan.');
        }

        $enrolled_courses = $this->studentModel->getCoursesByStudentId($student['id']);
        
        $data = [
            'title'               => 'Ubah Jadwal Mata Kuliah',
            'all_courses'         => $this->courseModel->findAll(),
            'enrolled_course_ids' => array_column($enrolled_courses, 'id'),
            'form_action'         => base_url('dashboard/enroll/save'),
            'back_url'            => base_url('dashboard/courses')
        ];
        return view('enroll_view', $data);
    }

    public function saveEnrollment()
    {
        $student = $this->studentModel->where('user_id', session()->get('user_id'))->first();
        if (!$student) {
            return redirect()->to('/home')->with('error', 'Aksi tidak valid.');
        }

        $course_ids = $this->request->getPost('course_ids') ?? [];
        if ($this->studentModel->updateEnrollments($student['id'], $course_ids)) {
            return redirect()->to('/dashboard/courses')->with('success', 'Jadwal mata kuliah berhasil diperbarui.');
        }
        return redirect()->back()->withInput()->with('error', 'Gagal memperbarui jadwal.');
    }
}