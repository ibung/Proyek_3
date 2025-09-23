<?php

namespace App\Models;

use CodeIgniter\Model;

class StudentModel extends Model
{
    protected $table            = 'students';
    protected $primaryKey       = 'id';
    protected $returnType       = 'array';
    protected $allowedFields    = ['nim', 'age', 'entry_year', 'user_id'];

    public function getStudentsWithUser()
    {
        return $this->select('students.*, users.full_name, users.username')
            ->join('users', 'users.id = students.user_id')
            ->where('users.role', 'mahasiswa')
            ->orderBy('students.id', 'ASC')
            ->findAll();
    }

    public function searchStudents($keyword)
    {
        return $this->select('students.id, students.nim, students.age, students.entry_year, users.full_name, users.username')
            ->join('users', 'users.id = students.user_id')
            ->where('users.role', 'mahasiswa')
            ->groupStart()
                ->like('users.full_name', $keyword)
                ->orLike('students.nim', $keyword)
            ->groupEnd()
            ->orderBy('students.id', 'ASC')
            ->findAll();
    }

    public function getStudentById($id)
    {
        return $this->select('students.*, users.full_name, users.username')
            ->join('users', 'users.id = students.user_id')
            ->where('students.id', $id)
            ->first();
    }

    /**
     * Mengambil semua mata kuliah yang diambil oleh seorang mahasiswa.
     * PERBAIKAN: Method ini sekarang lebih fleksibel.
     */
    public function getCoursesByStudentId($student_id)
    {
        // Query ini akan:
        // 1. Memilih semua kolom dari tabel 'courses'
        // 2. Bergabung dengan tabel 'takes'
        // 3. Menyaring hasilnya hanya untuk student_id yang spesifik
        return $this->db->table('courses')
            ->select('courses.*, takes.enroll_date') // Ambil juga tgl enroll
            ->join('takes', 'takes.course_id = courses.id')
            ->where('takes.student_id', $student_id)
            ->get()
            ->getResultArray();
    }
    
    public function updateEnrollments($student_id, $course_ids = [])
    {
        $takesTable = $this->db->table('takes');
        $this->db->transStart();
        $takesTable->where('student_id', $student_id)->delete();

        if (!empty($course_ids)) {
            $dataToInsert = [];
            foreach ($course_ids as $course_id) {
                $dataToInsert[] = [
                    'student_id'  => $student_id,
                    'course_id'   => $course_id,
                    'enroll_date' => date('Y-m-d')
                ];
            }
            $takesTable->insertBatch($dataToInsert);
        }
        $this->db->transComplete();
        return $this->db->transStatus();
    }
}