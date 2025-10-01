<?php

namespace App\Controllers;

use App\Models\CourseModel;

class CourseController extends BaseController
{
    protected $courseModel;

    public function __construct()
    {
        $this->courseModel = new CourseModel();
    }

    // Menampilkan semua mata kuliah
    public function index()
    {
        $data = [
            'title'   => 'Kelola Mata Kuliah',
            'courses' => $this->courseModel->findAll()
        ];
        return view('course_view', $data);
    }

    // Menampilkan form tambah data
    public function new()
    {
        $data = [
            'title' => 'Tambah Mata Kuliah Baru'
        ];
        return view('course_form_view', $data);
    }

    // Memproses data dari form tambah
    public function create()
    {
        $rules = [
            'course_code' => 'required|is_unique[courses.course_code]',
            'course_name' => 'required',
            'credits'     => 'required|integer'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $this->courseModel->save([
            'course_code' => $this->request->getVar('course_code'),
            'course_name' => $this->request->getVar('course_name'),
            'credits'     => $this->request->getVar('credits'),
        ]);

        return redirect()->to('/admin/courses')->with('success', 'Mata kuliah berhasil ditambahkan.');
    }

    // Menampilkan form edit data
    public function edit($id)
    {
        $data = [
            'title'  => 'Edit Mata Kuliah',
            'course' => $this->courseModel->find($id)
        ];

        if (empty($data['course'])) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Mata kuliah tidak ditemukan.');
        }

        return view('course_form_view', $data);
    }

    // Memproses data dari form edit
    public function update($id)
    {
        $rules = [
            'course_code' => "required|is_unique[courses.course_code,id,{$id}]",
            'course_name' => 'required',
            'credits'     => 'required|integer'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $this->courseModel->update($id, [
            'course_code' => $this->request->getVar('course_code'),
            'course_name' => $this->request->getVar('course_name'),
            'credits'     => $this->request->getVar('credits'),
        ]);

        return redirect()->to('/admin/courses')->with('success', 'Mata kuliah berhasil diperbarui.');
    }

    // Menghapus data
    public function delete($id)
    {
        $this->courseModel->delete($id);
        return redirect()->to('/admin/courses')->with('success', 'Mata kuliah berhasil dihapus.');
    }
}