<?php

function set_message($pesan)
{
    $pisah = explode('-', $pesan);

    (current($pisah) == 0) ? $status = 'telah' : $status = 'gagal';

    switch (end($pisah)):
        case "1":
            return "data " . $status . " ditambahkan";
            break;

        case "2":
            return "data " . $status . " diubah";
            break;

        case "3":
            return "data " . $status . " dihapus";
            break;

        case "4":
            return "tidak ada file yang diunggah.";
            break;

        case "5":
            return "file terlalu besar.";
            break;

        case "6":
            return "ekstemsi file tidak diijinkan.";
            break;

        case "8":
            return "data sudah ada, coba dicek kembali";
            break;

        case "9":
            return "sesuaikan dengan ukuran gambar yang sudah ditentukan.";
            break;

        case "10":
            return "kata sandi yang dimasukan salah.";
            break;

        case "11":
            return "akses sedang dinonaktifkan, silahkan hubungi administrator.";
            break;

        case "12":
            return "NIP / ID Pengguna tidak terdaftar.";
            break;

        case "13":
            return "No. Pendaftaran tidak terdaftar.";
            break;

        case "14":
            return "Mungkin ada kesalahan dengan reCAPTCHA.";
            break;

        case "15":
            return "IP Address sudah ada.";
            break;

        case "16":
            return "Status aktif, Data tidak dapat dihapus.";
            break;

        case "17":
            return "Akses pengguna sedang dinonaktifkan.";
            break;

        case "18":
            return "Kata sandi " . $status . " diubah.";
            break;

        case "19":
            return "Kelompok soal sudah ada.";
            break;

        case "20":
            return "Mata Uji sudah ada, coba dicek kembali.";
            break;

        case "21":
            return "Ruangan sudah ada, coba dicek kembali.";
            break;

        case "22":
            return "Program studi sudah ada, coba dicek kembali.";
            break;

        case "23":
            return "NIP sudah ada, coba dicek kembali.";
            break;

        case "24":
            return "NIP sudah ada, coba dicek kembali.";
            break;

        case "25":
            return "Gambar  " . $status . " dihapus.";
            break;

        case "26":
            return "Peserta tidak terdaftar di sesi ujian ini, silahkan hubungi pengawas.";
            break;

        case "27":
            return "Sesi ini belum diaktifkan.";
            break;

        case "28":
            return "Sesi ujian sudah berakhir.";
            break;

        case "29":
            return "Perserta sudah menyelesaikan ujian.";
            break;

        case "30":
            return "Peserta masih online, silahkan hubungi pengawas.";
            break;

        case "31":
            return "Koneksi peserta pada sistem di putuskan pengawas.";
            break;

        case "32":
            return "IP Komputer sebelumnya belum di reset, silahkan hubungi pengawas.";
            break;

        case "33":
            return "Jumlah peserta yang dimasukan melebih jumlah peserta yang ada.";
            break;

        case "34":
            return "PIN Sesi yang dimasukan salah, periksa kembali atau silahkan hubungi pengawas.";
            break;

        case "35":
            return "Selamat Mengerjakan.";
            break;

        case "36":
            return "Ruangan ini sudah penuh.";
            break;

        case "37":
            return "Jumlah soal sudah terpenuhi.";
            break;

        case "38":
            return "Belum bisa diaktifkan, cek kembali jumlah soal pada kelompok soal disesi ini.";
            break;

        case "39":
            return "Disconnect terlebih dahulu sebelum mereset IP";
            break;

        case "40":
            return "Peserta harus login terlebih";
            break;

        case "41":
            return "data " . $status . " diimport";
            break;

        default:
            return "mungkin ada kesalahan.";
            break;

    endswitch;
}
