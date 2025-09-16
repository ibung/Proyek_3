<?php

namespace App\Controllers;

use App\Models\StudentModel;
use App\Models\UserModel;
use App\Models\CourseModel;

class StudentController extends BaseController
{
    protected $studentModel;
    protected $courseModel;

    public function __construct()
    {
        $this->studentModel = new StudentModel();
        $this->courseModel = new CourseModel();
    }

    public function index()
    {
        $keyword = $this->request->getGet('search');
        $data = [
            'title' => 'Kelola Mahasiswa',
            'students' => $keyword ? $this->studentModel->searchStudents($keyword) : $this->studentModel->getStudentsWithUser(),
            'keyword' => $keyword ?? ''
        ];
        return view('student_view', $data);
    }

    public function detail($id = null)
    {
        $student = $this->studentModel->getStudentById($id);
        if (empty($student)) {
            return redirect()->to('/admin/students')->with('error', 'Data mahasiswa tidak ditemukan.');
        }
        $data = [
            'title' => 'Detail Mahasiswa',
            'student' => $student
        ];
        return view('student_detail_view', $data);
    }
    
    public function delete($id = null)
    {
        $student = $this->studentModel->find($id);
        if (!$student) {
             return redirect()->to('/admin/students')->with('error', 'Data tidak ditemukan.');
        }
        $userModel = new UserModel();
        $userModel->delete($student['user_id']);
        return redirect()->to('/admin/students')->with('success', 'Data mahasiswa berhasil dihapus.');
    }

    public function enroll($student_id = null)
    {
        $student = $this->studentModel->getStudentById($student_id);
        if (!$student) {
            return redirect()->to('/admin/students')->with('error', 'Data mahasiswa tidak ditemukan.');
        }

        $enrolled_courses = $this->studentModel->getCoursesByStudentId($student['id']);

        $data = [
            'title'               => 'Ubah Jadwal: ' . $student['full_name'],
            'student'             => $student,
            'all_courses'         => $this->courseModel->findAll(),
            'enrolled_course_ids' => array_column($enrolled_courses, 'id'),
            'form_action'         => base_url('admin/students/' . $student_id . '/enroll/save'),
            'back_url'            => base_url('admin/students')
        ];
        return view('enroll_view', $data);
    }
    
    public function saveEnrollment($student_id = null)
    {
        $student = $this->studentModel->find($student_id);
        if (!$student) {
            return redirect()->to('/admin/students')->with('error', 'Aksi tidak valid.');
        }

        $course_ids = $this->request->getPost('course_ids') ?? [];
        if ($this->studentModel->updateEnrollments($student['id'], $course_ids)) {
            return redirect()->to('/admin/students')->with('success', 'Jadwal untuk mahasiswa tersebut berhasil diperbarui.');
        }
        return redirect()->back()->withInput()->with('error', 'Gagal memperbarui jadwal.');
    }

    // METHOD BARU: Untuk menampilkan halaman form edit
    public function edit($id = null)
    {
        $student = $this->studentModel->getStudentById($id);
        if (empty($student)) {
            return redirect()->to('/admin/students')->with('error', 'Data mahasiswa tidak ditemukan.');
        }

        $data = [
            'title'   => 'Edit Mahasiswa',
            'student' => $student,
        ];

        return view('student_edit_view', $data);
    }

    // METHOD BARU: Untuk memproses update data
    public function update($id = null)
    {
        $student = $this->studentModel->find($id);
        if (!$student) {
            return redirect()->to('/admin/students')->with('error', 'Data mahasiswa tidak ditemukan.');
        }

        // Aturan validasi
        $rules = [
            'full_name'  => 'required|min_length[3]',
            'nim'        => "required|is_unique[students.nim,id,{$id}]", // NIM harus unik kecuali untuk data ini sendiri
            'age'        => 'required|integer',
            'entry_year' => 'required|exact_length[4]|integer',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        // Siapkan data untuk diupdate
        $studentData = [
            'nim'        => $this->request->getVar('nim'),
            'age'        => $this->request->getVar('age'),
            'entry_year' => $this->request->getVar('entry_year'),
        ];
        
        $userData = [
            'full_name' => $this->request->getVar('full_name'),
        ];

        // Update ke database
        $userModel = new UserModel();
        $this->studentModel->update($id, $studentData);
        $userModel->update($student['user_id'], $userData);

        return redirect()->to('/admin/students')->with('success', 'Data mahasiswa berhasil diupdate.');
    }
}