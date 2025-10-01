<?php

function role($role)
{
    ($role == 0) ? $tampil = 'SUPER ADMINISTRATOR' : $tampil = 'ADMINISTRATOR';
    return $tampil;
}

function conn(int $db_id = 1)
{
    $arry =
        [
            1 => 'default'
        ];

    (count($arry) !== $db_id) ? $db_name = $arry[1] : $db_name = $arry[$db_id];

    return $conn = \Config\Database::connect($db_name);
}

function is_active($page = [], $model = '')
{
    $request = \Config\Services::request();
    $control = $request->uri->getSegment(2);

    if ($model == 1) :
        $class = 'nav-item-expanded nav-item-open';

    elseif ($model == 2) :
        $class   = "table-secondary";
        $control = $request->uri->getSegment(3);

    elseif ($model == 3) :
        $class   = "active";
        $control = $request->uri->getSegment(3);

    elseif ($model == 4) :
        $class = 'show';

    else :
        $class = "active";

    endif;


    (in_array($control, $page)) ? $tampil = $class : $tampil = '';
    return $tampil;
}

function randMix($length = 4)
{
    $characters        = '01a23u45e67o89';
    $charactersLength  = strlen($characters);
    $randomString      = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}


function randNum($length = 4)
{
    $characters = '0123456789';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

function is_notif($msg)
{
    if ($msg == 0) :
        $notif = 'success';
        $pesan = 'Berhasil';

    else :
        $notif = 'error';
        $pesan = 'Gagal';

    endif;

    return $arry = ['notif' => $notif, 'pesan' => $pesan];
}

function is_empty($data)
{
    if (is_null($data) || empty($data) || $data == '-' || $data == 0) :
        $tampil = '-';

    else :
        $tampil = $data;

    endif;

    return $tampil;
}

function is_nip($nip, $batas = " ")
{
    $nip = trim($nip, " ");
    $panjang = strlen($nip);

    if ($panjang == 18) :
        $sub[] = substr($nip, 0, 8);
        $sub[] = substr($nip, 8, 6);
        $sub[] = substr($nip, 14, 1);
        $sub[] = substr($nip, 3, 3);
        return $sub[0] . $batas . $sub[1] . $batas . $sub[2] . $batas . $sub[3];
    /*
    elseif ($panjang == 15) :
        $sub[] = substr($nip, 0, 8);
        $sub[] = substr($nip, 8, 6);
        $sub[] = substr($nip, 14, 1);
        return $sub[0] . $batas . $sub[1] . $batas . $sub[2];
    
    elseif ($panjang == 9) :
        $sub = str_split($nip, 3);
        return $sub[0] . $batas . $sub[1] . $batas . $sub[2];
            */
    else :
        return $nip;

    endif;
}


function encode($data)
{
    return base64_encode(base64_encode(base64_encode($data)));
}

function decode($data)
{
    return base64_decode(base64_decode(base64_decode($data)));
}

function slug($string)
{
    return url_title($string, '-', true);
}

function indoDate($date)
{
    $tanggal = substr($date, 8, 2);
    $bulan   = getMount(substr($date, 5, 2));
    $tahun   = substr($date, 0, 4);

    return $tanggal . ' ' . $bulan . ' ' . $tahun;
}

function getMount($mount)
{
    switch ($mount) {
        case 1:
            return "Januari";
            break;
        case 2:
            return "Februari";
            break;
        case 3:
            return "Maret";
            break;
        case 4:
            return "April";
            break;
        case 5:
            return "Mei";
            break;
        case 6:
            return "Juni";
            break;
        case 7:
            return "Juli";
            break;
        case 8:
            return "Agustus";
            break;
        case 9:
            return "September";
            break;
        case 10:
            return "Oktober";
            break;
        case 11:
            return "November";
            break;
        case 12:
            return "Desember";
            break;
    }
}

function getTime()
{
    date_default_timezone_set("Asia/Taipei");
    return date('H:i:s');
}

function getRegards($jam)
{


    if ($jam > '01:00:00' && $jam < '10:00:00') :
        $salam = 'Pagi';

    elseif ($jam >= '10:00:00' && $jam < '15:00:00') :
        $salam = 'Siang';

    elseif ($jam < '18:00:00') :
        $salam = 'Sore';

    else :
        $salam = 'Malam';

    endif;

    return $salam;
}

function is_staf($status)
{
    $jab = 'pengawas';
    if ($status != 1) $jab = 'teknisi';

    return $jab;
}


function is_abbreviation($string)
{
    $clean = preg_replace("/[^a-zA-Z]/", " ", $string);
    $pisah = explode(' ', $clean);

    $arry  = [];

    foreach ($pisah as $psh) :
        $arry[] = substr($psh, 0, 1);

    endforeach;

    return join('', $arry);
}


function is_position()
{
    return [['id' => 1, 'status' => 'diatas soal'], ['id' => 2, 'status' => 'ditengah soal'], ['id' => 3, 'status' => 'dibawah soal']];
}

function number_to_str($number)
{
    switch ($number):
        case 1:
            return 'A';
            break;
        case 2:
            return 'B';
            break;
        case 3:
            return 'C';
            break;
        case 4:
            return 'D';
            break;
        case 5:
            return 'E';
            break;

        default:
            return '-';
            break;

    endswitch;
}

function is_gender($jk)
{
    $tampil = 'Ib. ';
    if ($jk == 'l') $tampil = 'Bp. ';

    return $tampil;
}

function remove_sess($sess)
{
    if (session()->has($sess) != false) :
        return session()->remove($sess);

    endif;
}

function tahunAjar($tahun)
{
    return $tahun . '/' . $tahun + 1;
}

function decimalToTime($decimal)
{
    $hours   = floor($decimal / 60);
    $minutes = floor($decimal % 60);
    $seconds = $decimal - (int)$decimal;
    $seconds = round($seconds * 60);

    return str_pad($hours, 2, "0", STR_PAD_LEFT) . " JAM : " . str_pad($minutes, 2, "0", STR_PAD_LEFT) . " MENIT : " . str_pad($seconds, 2, "0", STR_PAD_LEFT) . " DETIK";
}

function is_status($aksi, $status)
{
    if ($aksi == 'peserta') :

        switch ($status):
            case 1:
                return [
                    'color' => 'info',
                    'mssg'  => 'sedang ujian',
                    'icon'  => 'arrow-down5'
                ];
                break;

            case 2:
                return [
                    'color' => 'slate',
                    'mssg'  => 'pindah pc',
                    'icon'  => 'arrow-down5'
                ];
                break;

            case 3:
                return [
                    'color' => 'success',
                    'mssg'  => 'selesai ujian',
                    'icon'  => 'arrow-up5'
                ];
                break;

            case 4:
                return [
                    'color' => 'primary',
                    'mssg'  => 'siap ujian',
                    'icon'  => 'arrow-down5'
                ];
                break;

            case 5:
                return [
                    'color' => 'danger',
                    'mssg'  => 'tidak hadir',
                    'icon'  => 'arrow-down5'
                ];
                break;

            case 6:
                return [
                    'color' => 'teal',
                    'mssg'  => 'gangguan',
                    'icon'  => 'dash'
                ];
                break;

            default:
                return [
                    'color' => 'warning',
                    'mssg'  => 'belum ujian',
                    'icon'  => 'dash'
                ];
                break;

        endswitch;

    elseif ($aksi == 'sess') :
        $arry = [
            'color' => 'success',
            'mssg'  => 'online'
        ];

        if ($status != 1) :
            $arry = [
                'color' => 'light op-0-7',
                'mssg'  => 'offline'
            ];

        endif;

        return $arry;

    else :

    endif;
}

function clean_char($char)
{
    return preg_replace('/[^A-Za-z0-9\-]/', '', $char);
}