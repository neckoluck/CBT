<?php if ($page == 'soal') : ?>
    <!-- Basic modal -->
    <div id="md-info" class="modal fade" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-body">
                    <h5 class="fw-900 m-b-0">PETUNJUK UMUM UNTUK PESERTA :</h5>
                    <ol class="list fs-15 mt-3 fw-300">
                        <li class="mb-3">
                            Berikut ada <span class="fw-800"><?= $soal['jumdata']; ?> soal</span> yang terdiri dari beberapa mata uji yakni Matematika, Fisika, Bahasa Indonesia, Bahasa Inggris.
                        </li>
                        <li class="mb-3">Kerjakan soal-soal mulai dari yang mudah baru kemudian yang lebih sulit sehingga semua soal terjawab.</li>
                        <li class="mb-3">
                            <p> Petunjuk pengerjaan soal : </p>
                            Pilihlah salah satu jawaban yang paling tepat dengan mengklik pilihan <img src="<?= base_url(); ?>/uploads/pic-other/uncheck.png" class=" ml-1 mr-1"> menjadi <img src="<?= base_url(); ?>/uploads/pic-other/check.png" class="ml-1 mr-1"> dari kemungkinan jawaban yang ada (A, B, C, D atau E)
                        </li>
                        <li class="mb-3">Selama ujian berlangsung, peserta tidak diperbolehkan berbicara dengan siapapun mengenai soal ujian.</li>
                        <li class="mb-3">Selama ujian berlangsung peserta tidak diperkenankan menggunakan alat bantu selain pensil.</li>
                        <li class="mb-3">
                            <p>Penilaian :</p>
                            Setiap jawaban yang benar = 4, jawaban yang salah = -1 dan tidak ada jawaban = 0
                        </li>
                        <li class="mb-3">Setelah ujian selesai, peserta tidak diperkenankan meninggalkan tempat sebelum diijinkan pengawas.</li>
                        <li class="mb-3">Waktu untuk ujian <span class="fw-800"><?= $ruses['durasi']; ?> menit</span>.</li>
                    </ol>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-link text-dark" data-dismiss="modal">Keluar</button>
                </div>
            </div>
        </div>
    </div>
    <!-- /basic modal -->

    <!-- Basic modal -->
    <div id="md-finish" class="modal fade" tabindex="-1">
        <div class="modal-dialog">
            <form action="<?= $action['finish']; ?>" method="POST">
                <?= csrf_field(); ?>
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="fw-500">Periksa kembali semua pertanyaan agar tidak ada yang terlewatkan !.</div>
                        Jika sudah yakin dengan semua jawaban Anda, klik tombol <span class="badge bg-primary pd-8 ml-1 mr-1 shadow-1">YA</span> untuk menyelesaikan ujian ?
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-link text-dark" data-dismiss="modal">Tidak</button>
                        <button type="submit" class="btn bg-primary">Ya</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- /basic modal -->
<?php endif; ?>