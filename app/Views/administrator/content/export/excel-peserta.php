<p>&nbsp;</p>
<center>
    <h1><strong>REKAPAN DATA PESERTA</strong></h1>
    <?php
    if ($currentslug != null) :
        $slug  = $currentslug;
        if ($endslug != null) $slug = $endslug;

        $namabidang     = 'semua bidang';
        if (decode($slug) == '') :
            $bidang     = $baseMod->getId('tb_bidang', 'slug_nama_bidang', $slug);
            $namabidang = 'bidang ' . $bidang['nama_bidang'];

        endif;

        $prodi_pertama  = 'tampil acak.';
        $prodi_kedua    = 'tampil acak.';

        if (decode($slug) != '') :
            $enkripslug = explode('+', decode($slug));

            if (count($enkripslug) == 2) :
                $pisah4  = explode('-', $enkripslug[0]);
                $prodis1 = end($pisah4);

                $prodii1       = $baseMod->getId('vw_prodi', 'id_prodi', $prodis1);
                $prodi_pertama = $prodii1['nama_prodi'];

                $pisah3  = explode('-', end($enkripslug));
                $prodis2 = end($pisah3);

                $prodii2     = $baseMod->getId('vw_prodi', 'id_prodi', $prodis2);
                $prodi_kedua = $prodii2['nama_prodi'];
                $bind        = "id_bidang != :bidang1: AND id_bidang != :bidang2:";

                if ($prodii1['id_bidang'] == $prodii2['id_bidang']) $bind  = "id_bidang = :bidang1:";

                $sql         = $baseMod->getBy('tb_bidang', "$bind", ['bidang1' => $prodii1['id_bidang'], 'bidang2' => $prodii2['id_bidang']]);
                $bidang      = $baseMod->getRow($sql);
                $namabidang  = 'bidang ' . $bidang['nama_bidang'];



            else :
                $pisah4 = explode('-', $enkripslug[0]);
                $value2 = end($pisah4);

                if ($pisah4[0] == 2) :
                    $prodii2     = $baseMod->getId('vw_prodi', 'id_prodi', $value2);
                    $prodi_kedua = $prodii2['nama_prodi'];
                    $namabidang  = 'bidang ' . $prodii2['nama_bidang'];

                else :
                    $prodii1       = $baseMod->getId('vw_prodi', 'id_prodi', $value2);
                    $prodi_pertama = $prodii1['nama_prodi'];
                    $namabidang    = 'bidang ' . $prodii1['nama_bidang'];

                endif;

            endif;

        endif;


    ?>
        <h3><?= strtoupper($namabidang); ?> - PRODI PILIHAN PERTAMA : <strong><?= strtoupper($prodi_pertama); ?></strong> - PRODI PILIHAN KEDUA : <strong><?= strtoupper($prodi_kedua); ?></strong></h3>
    <?php endif; ?>

    </div>
</center>
<table border="1" padding="10" width="100%" cellspacing="1" cellpadding="1" class="table datatable-basic table-bordered">
    <thead>
        <tr bgcolor="#eeeeee">
            <th rowspan="2" width="1%">#</th>
            <th rowspan="2" width="1%">NO. PENDAFTARAN</th>
            <th rowspan="2">NAMA PESERTA</th>
            <th rowspan="2">NIK PESERTA</th>
            <th rowspan="2">NISN</th>
            <th rowspan="2" class="text-center" width="1%">JK</th>
            <th colspan="2" class="text-center" width="1%">PROGRAM STUDI PILIHAN PERTAMA</th>
            <th colspan="2" class="text-center" width="1%">PROGRAM STUDI PILIHAN KEDUA</th>
            <th rowspan="2" width="1%">BIDANG</th>
    		<th colspan="5" width="1%" class="text-center">BOBOT</th>
        </tr>
        <tr bgcolor="#eeeeee">
    		             
            <th class="text-nowrap" witdh="1%">POLITEKNIK</th>
            <th class="text-nowrap" witdh="1%">PROGRAM STUDI</th>
            <th class="text-nowrap" witdh="1%">POLITEKNIK</th>
            <th class="text-nowrap" witdh="1%">PROGRAM STUDI</th>
     <th class="text-nowrap text-center" witdh="1%">MTK</th>
                        <th class="text-nowrap text-center" witdh="1%">BINDO</th>
                        <th class="text-nowrap text-center" witdh="1%">BING</th>
                        <th class="text-nowrap text-center" witdh="1%">SKOLAS</th>
    <th class="text-nowrap text-center" witdh="1%">NILAI</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $no = 0;
        foreach ($pesertas as $peserta) :

			$nilai = 0;

                        if ($peserta['id_bidang'] == 2) :
                            $nilai = ( 0.25 * $peserta['Matematika']) + (0.25 * $peserta['Skolastik'])  + (0.25 * $peserta['Indonesia'])  + (0.25 * $peserta['Inggris']);
                        else :
                            $nilai = ( 0.35 * $peserta['Matematika']) + (0.25 * $peserta['Skolastik'])  + (0.20 * $peserta['Indonesia'])  + (0.20 * $peserta['Inggris']);

                        endif;

            $sql1   = $baseMod->getBy('vw_hasil', 'id_peserta = :id_peserta: AND bobot = :bobot:', ['id_peserta' => $peserta['id_peserta'], 'bobot' => 'benar']);
            $count1 = $baseMod->numRows($sql1);

            $sql2   = $baseMod->getBy('vw_hasil', 'id_peserta = :id_peserta: AND bobot = :bobot:', ['id_peserta' => $peserta['id_peserta'], 'bobot' => 'salah']);
            $count2 = $baseMod->numRows($sql2);


            $sql4   = $baseMod->getBy('tb_jawaban', 'id_peserta = :id_peserta:', ['id_peserta' => $peserta['id_peserta']]);
            $count4 = $baseMod->numRows($sql4);

            $jawab  = $count1 + $count2;
            $skor   = ($count1 * $sett['bobot_1']) - $count2;

            $prodi1    = $baseMod->getId('vw_prodi', 'id_prodi', $peserta['prodi_pertama']);
            $poltek1   = $baseMod->getId('tb_poltek', 'id_poltek', $peserta['poltek_pertama']);

            $nmprodi2  = null;
            $nmpoltek2 = null;
            if ($peserta['prodi_kedua'] != null) :
                $prodi2    = $baseMod->getId('vw_prodi', 'id_prodi', $peserta['prodi_kedua']);
                $poltek2   = $baseMod->getId('tb_poltek', 'id_poltek', $peserta['poltek_kedua']);

                $nmprodi2  = $prodi2['nama_prodi'];
                $nmpoltek2 = $poltek2['nama_poltek'];

            endif;
            $clss1 = '';
            $clss2 = '';

            $slug  = $currentslug;
            if ($endslug != null) $slug = $endslug;

            if (decode($slug) != '') :
                $enkripslug = explode('+', decode($slug));

                if (count($enkripslug) == 2) :
                    $pisah4  = explode('-', $enkripslug[0]);
                    $prodis1 = end($pisah4);

                    $pisah3  = explode('-', end($enkripslug));
                    $prodis2 = end($pisah3);

                    $clss1 = '';
                    $clss2 = '';

                else :
                    $pisah4 = explode('-', $enkripslug[0]);
                    $value2 = end($pisah4);

                    $key2    = 'prodi_pertama';
                    if ($pisah4[0] == 2) :
                        if ($value2 == $peserta['prodi_kedua']) :
                            $clss2 = '#f7ce45';

                        endif;

                    else :
                        if ($value2 == $peserta['prodi_pertama']) :
                            $clss1 = '#fac8c8';

                        endif;

                    endif;

                endif;

            endif;

            $no++; ?>
            <tr>
                <td><?= $no; ?>.</td>
                <td><?= "'" . $peserta['no_pendaftaran']; ?></td>
                <td><?= strtoupper($peserta['nama_peserta']); ?></td>
                <td><?= "'" . $peserta['nik_peserta']; ?></td>
                <td><?= "'" . $peserta['nisn_peserta']; ?></td>
                <td>
                    <center><?= strtoupper($peserta['jk_peserta']); ?></center>
                </td>
                <td bgcolor="<?= $clss1; ?>"><?= strtoupper($poltek1['nama_poltek']); ?></td>
                <td bgcolor="<?= $clss1; ?>"><?= strtoupper($prodi1['nama_prodi']); ?></td>
                <td bgcolor="<?= $clss2; ?>">
                    <?php if ($nmprodi2 != null) : ?>
                        <?= strtoupper($poltek2['nama_poltek']); ?>
                    <?php else : ?>
                        <center>-</center>
                    <?php endif; ?>
                </td>
                <td bgcolor="<?= $clss2; ?>">
                    <?php if ($nmprodi2 != null) : ?>
                        <?= strtoupper($nmprodi2); ?>
                    <?php else : ?>
                        <center>-</center>
                    <?php endif; ?>
                </td>
                <td>BIDANG <?= strtoupper($peserta['nama_bidang']); ?></td>
                <td class="fw-500 text-center" width="1%"><?= $peserta['Matematika']; ?></td>
                            <td class="fw-500 text-center" width="1%"><?= $peserta['Indonesia']; ?></td>
                            <td class="fw-500 text-center" width="1%"><?= $peserta['Inggris']; ?></td>
                            <td class="fw-500 text-center" width="1%"><?= $peserta['Skolastik']; ?></td>
                     <td class="fw-500 text-center" width="1%"><?= $nilai; ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<p><strong>KETERANGAN :</strong></p>
<table>
    <tr>
        <td bgcolor="#fac8c8">&nbsp;&nbsp;</td>
        <td colspan="2"><strong>: PRODI PILIHAN PERTAMA (AKTIF)</strong></td>
    </tr>
</table>
<table>
    <tr>
        <td bgcolor="#f7ce45">&nbsp;&nbsp;</td>
        <td colspan="2"><strong>: PRODI PILIHAN KEDUA (AKTIF)</strong></td>
    </tr>
</table>