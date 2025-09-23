<?= $this->extend('template'); ?>

<?= $this->section('content'); ?>

<h3><?= esc($title); ?></h3>

<?php if (isset($student)): ?>
    <p>Mengubah jadwal mata kuliah untuk mahasiswa: <strong><?= esc($student['full_name']); ?></strong> (NIM: <?= esc($student['nim']); ?>)</p>
<?php else: ?>
    <p>Pilih mata kuliah yang ingin Anda ambil pada semester ini.</p>
<?php endif; ?>

<form action="<?= $form_action; ?>" method="post">
    <?= csrf_field(); ?>
    <div class="course-list">
        <?php if (!empty($all_courses)): ?>
            <?php foreach ($all_courses as $course): ?>
                <div class="course-item">
                    <input type="checkbox" 
                           class="course-checkbox" name="course_ids[]" 
                           value="<?= $course['id']; ?>" 
                           id="course_<?= $course['id']; ?>"
                           data-credits="<?= $course['credits']; ?>" <?= in_array($course['id'], $enrolled_course_ids) ? 'checked' : ''; ?>
                    >
                    <label for="course_<?= $course['id']; ?>">
                        <strong><?= esc($course['course_name']); ?></strong> (<?= esc($course['course_code']); ?>) - <?= esc($course['credits']); ?> SKS
                    </label>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>Tidak ada mata kuliah yang tersedia.</p>
        <?php endif; ?>
    </div>
    
    <div class="total-sks-container">
        Total SKS yang Dipilih: <strong id="total-sks-display">0</strong>
    </div>
    
    <button type="submit" class="btn-save">Simpan Perubahan</button>
    <a href="<?= $back_url; ?>" class="btn-cancel">Batal</a>
</form>

<style>
/* ... (style Anda yang lain) ... */
.total-sks-container {
    margin: -10px 0 20px 0;
    padding: 15px;
    background-color: #e7f3fe;
    border: 1px solid #b3d7ff;
    border-radius: 5px;
    font-size: 16px;
    text-align: right;
}
</style>

<script>
    // 1. DOM Selector: Pilih semua checkbox mata kuliah dan elemen display SKS
    const courseCheckboxes = document.querySelectorAll('.course-checkbox');
    const totalSksDisplay = document.getElementById('total-sks-display');

    /**
     * Fungsi untuk menghitung ulang dan menampilkan total SKS
     */
    function updateTotalSks() {
        let currentTotal = 0;
        
        // Loop melalui setiap checkbox
        courseCheckboxes.forEach(checkbox => {
            // Jika checkbox tercentang
            if (checkbox.checked) {
                // Ambil nilai SKS dari 'data-credits' dan tambahkan ke total
                currentTotal += parseInt(checkbox.getAttribute('data-credits'));
            }
        });

        // 3. DOM Manipulation: Update teks di dalam elemen display
        totalSksDisplay.textContent = currentTotal;
    }

    // 2. Event Handling: Pasang "pendengar" di setiap checkbox
    courseCheckboxes.forEach(checkbox => {
        // Jalankan fungsi updateTotalSks() setiap kali ada 'perubahan' (centang/tidak)
        checkbox.addEventListener('change', updateTotalSks);
    });

    // Panggil fungsi sekali saat halaman pertama kali dimuat
    // untuk menghitung SKS dari mata kuliah yang sudah tercentang
    document.addEventListener('DOMContentLoaded', updateTotalSks);
</script>

<style>
.course-list { margin: 20px 0; border: 1px solid #ddd; border-radius: 5px; padding: 10px; }
.course-item { display: flex; align-items: center; padding: 12px; border-bottom: 1px solid #eee; }
.course-item:last-child { border-bottom: none; }
.course-item input[type="checkbox"] { margin-right: 15px; transform: scale(1.2); }
.course-item label { cursor: pointer; flex-grow: 1; }
.btn-save { padding: 10px 20px; background-color: #28a745; color: white; border: none; border-radius: 5px; cursor: pointer; font-size: 16px; margin-top: 20px; }
.btn-cancel { display: inline-block; padding: 10px 20px; background-color: #6c757d; color: white; text-decoration: none; border-radius: 5px; font-size: 16px; margin-top: 20px; margin-left: 10px;}
</style>

<?= $this->endSection(); ?>