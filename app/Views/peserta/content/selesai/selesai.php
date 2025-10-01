<div class="container">
    <div class="">
        <div class="">
            <div class="row justify-content-center">


                <div class=" col-xl-7">
                    <!-- <img src="<?= base_url(); ?>/uploads/pic-other/timeout.png" height="150" class="mb-2 op-0-8" alt=""> -->
                    <div class="align-self-center">
                        <div class="text-center mb-3">
                            <div class="fw-600 fs-45 mb-0"><?= ($section == 'waktu habis') ? 'Waktu Ujian Berakhir' : 'Ujian Selesai'; ?></div>
                            <span class="fw-400 fs-14 mb-2 mt-0">Silahkan tinggalkan ruangan ujian. Halaman akan secara otomatis di alihkan ke halaman login.</span>
                        </div>
                        <?php if ($sett['status_skor'] == 1) : ?>
                            <div class="card shadow-3">
                                <table class="table table-bordered">
                                    <tr>
                                        <td class="fw-500" colspan="2">
                                            <div class="fw-400 fs-12">nama peserta :</div>
                                            <span class="fs-14"><?= strtoupper($user['nama_peserta']); ?></span>
                                        </td>
                                        <td class="fw-500" colspan="2">
                                            <div class="fw-400 fs-12">no. pendaftaran - nomer induk kependudukan :</div>
                                            <span class="fs-14"><?= $user['no_pendaftaran'] . ' - ' . $user['nik_peserta']; ?></span>
                                        </td>
                                    </tr>
                                    <tr class="text-center">
                                        <td class="fw-500">
                                            <div class="fw-400 fs-12">KPU :</div>
                                            <span class="fs-14"><?= is_null($skor['kpu']) ? 0 : $skor['kpu']; ?></span>
                                        </td>
                                        <td class="fw-500">
                                            <div class="fw-400 fs-12">PPU :</div>
                                            <span class="fs-14"><?= is_null($skor['ppu']) ? 0 : $skor['ppu']; ?></span>
                                        </td>
                                        <td class="fw-500">
                                            <div class="fw-400 fs-12">KMBM :</div>
                                            <span class="fs-14"><?= is_null($skor['kmbm']) ? 0 : $skor['kmbm']; ?></span>
                                        </td>
                                        <td class="fw-500">
                                            <div class="fw-400 fs-12">PK :</div>
                                            <span class="fs-14"><?= is_null($skor['pk']) ? 0 : $skor['pk']; ?></span>
                                        </td>
                                        <td class="fw-500">
                                            <div class="fw-400 fs-12">LIT IND :</div>
                                            <span class="fs-14"><?= is_null($skor['litind']) ? 0 : $skor['litind']; ?></span>
                                        </td>
                                        <td class="fw-500">
                                            <div class="fw-400 fs-12">LIT ING :</div>
                                            <span class="fs-14"><?= is_null($skor['liting']) ? 0 : $skor['liting']; ?></span>
                                        </td>
                                        <td class="fw-500">
                                            <div class="fw-400 fs-12">PM :</div>
                                            <span class="fs-14"><?= is_null($skor['pm']) ? 0 : $skor['pm']; ?></span>
                                        </td>
                                    </tr>
                                </table>
                            </div>

                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>