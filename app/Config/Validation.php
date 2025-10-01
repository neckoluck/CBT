<?php

namespace Config;

use CodeIgniter\Validation\CreditCardRules;
use CodeIgniter\Validation\FileRules;
use CodeIgniter\Validation\FormatRules;
use CodeIgniter\Validation\Rules;

class Validation
{
	//--------------------------------------------------------------------
	// Setup
	//--------------------------------------------------------------------

	/**
	 * Stores the classes that contain the
	 * rules that are available.
	 *
	 * @var string[]
	 */
	public $ruleSets = [
		Rules::class,
		FormatRules::class,
		FileRules::class,
		CreditCardRules::class,
	];

	/**
	 * Specifies the views that are used to display the
	 * errors.
	 *
	 * @var array<string, string>
	 */
	public $templates = [
		'list'   => 'CodeIgniter\Validation\Views\list',
		'single' => 'CodeIgniter\Validation\Views\single',
	];

	//--------------------------------------------------------------------
	// Rules
	//--------------------------------------------------------------------

	/**
	 * ADMIN RULES
	 **/
	public $admin =
	[
		'nama_administrator'    => 'required|trim',
		'nip_administrator'     => 'required|trim',
		'jk_administrator'      => 'required',
		'no_telp_administrator' => 'required|trim',
		'password'              => 'required|trim|min_length[8]',
		'cpassword'             => 'required|trim|min_length[8]|matches[password]',
		'namaFile' 	   			=> 'max_size[namaFile,1024]|is_image[namaFile]|mime_in[namaFile,image/jpg,image/jpeg]'
	];

	public $admin_errors =
	[
		'nama_administrator'    => ['required' => 'harap isi bidang ini'],
		'nip_administrator'     => ['required' => 'harap isi bidang ini'],
		'jk_administrator'      => ['required' => 'pilih salah satu opsi'],
		'no_telp_administrator' => ['required' => 'harap isi bidang ini'],
		'password'              => ['required' => 'harap isi bidang ini', 'min_length' => 'minimal 8 karakter'],
		'cpassword'             => ['required' => 'harap isi bidang ini', 'min_length' => 'minimal 8 karakter', 'matches' => 'isi bidang tidak cocok'],
		'namaFile' 	   		    => ['max_size' => 'ukuran file terlalu besar', 'is_image' => 'mungkin file yang diunggah bukan foto', 'mime_in' => 'eksensi file tidak diijinkan']
	];

	public $profiladmin =
	[
		'nama_administrator'    => 'required|trim',
		'nip_administrator'     => 'required|trim',
		'jk_administrator'      => 'required',
		'no_telp_administrator' => 'required|trim',
		'namaFile' 	   			=> 'max_size[namaFile,1024]|is_image[namaFile]|mime_in[namaFile,image/jpg,image/jpeg]'
	];

	public $profiladmin_errors =
	[
		'nama_administrator'    => ['required' => 'harap isi bidang ini'],
		'nip_administrator'     => ['required' => 'harap isi bidang ini'],
		'jk_administrator'      => ['required' => 'pilih salah satu opsi'],
		'no_telp_administrator' => ['required' => 'harap isi bidang ini'],
		'namaFile' 	   		    => ['max_size' => 'ukuran file terlalu besar', 'is_image' => 'mungkin file yang diunggah bukan foto', 'mime_in' => 'eksensi file tidak diijinkan']
	];

	/**
	 * STAF RULES
	 **/
	public $staf =
	[
		'nama_staf'    => 'required|trim',
		'nip_staf'     => 'trim',
		'jk_staf'      => 'required',
		'no_telp_staf' => 'trim',
		'password'     => 'required|trim|min_length[8]',
		'cpassword'    => 'required|trim|min_length[8]|matches[password]',
		'namaFile' 	   => 'max_size[namaFile,1024]|is_image[namaFile]|mime_in[namaFile,image/jpg,image/jpeg]'
	];

	public $staf_errors =
	[
		'nama_staf'    => ['required' => 'harap isi bidang ini'],
		'nip_staf'     => [],
		'jk_staf'      => ['required' => 'pilih salah satu opsi'],
		'no_telp_staf' => [],
		'password'     => ['required' => 'harap isi bidang ini', 'min_length' => 'minimal 8 karakter'],
		'cpassword'    => ['required' => 'harap isi bidang ini', 'min_length' => 'minimal 8 karakter', 'matches' => 'isi bidang tidak cocok'],
		'namaFile' 	   => ['max_size' => 'ukuran file terlalu besar', 'is_image' => 'mungkin file yang diunggah bukan foto', 'mime_in' => 'eksensi file tidak diijinkan']
	];

	public $profilstaf =
	[
		'nama_staf'    => 'required|trim',
		'nip_staf'     => 'trim',
		'jk_staf'      => 'required',
		'no_telp_staf' => 'trim',
		'namaFile' 	   => 'max_size[namaFile,1024]|is_image[namaFile]|mime_in[namaFile,image/jpg,image/jpeg]'
	];

	public $profilstaf_errors =
	[
		'nama_staf'    => ['required' => 'harap isi bidang ini'],
		'nip_staf'     => [],
		'jk_staf'      => ['required' => 'pilih salah satu opsi'],
		'no_telp_staf' => [],
		'namaFile' 	   => ['max_size' => 'ukuran file terlalu besar', 'is_image' => 'mungkin file yang diunggah bukan foto', 'mime_in' => 'eksensi file tidak diijinkan']
	];

	/**
	 * KEAMANAN RULES
	 **/
	public $aman =
	[
		'newpassword'  => 'required|trim|min_length[8]',
		'cnewpassword' => 'required|trim|min_length[8]|matches[newpassword]',
	];

	public $aman_errors =
	[
		'newpassword'  => ['required' => 'harap isi bidang ini', 'min_length' => 'minimal 8 karakter'],
		'cnewpassword' => ['required' => 'harap isi bidang ini', 'min_length' => 'minimal 8 karakter', 'matches' => 'isi bidang tidak cocok'],
	];

	/**
	 * _AUTH RULES
	 **/
	public $login1 =
	[
		'username'  => 'required|trim',
		'password'  => 'required|trim',
		'cpassword' => 'required|trim|matches[password]',
	];

	public $login1_errors =
	[
		'username'  => ['required' => 'harap isi bidang ini'],
		'password'  => ['required' => 'harap isi bidang ini'],
		'cpassword' => ['required' => 'harap isi bidang ini', 'matches' => 'isi bidang tidak cocok'],
	];

	/**
	 * RUANGAN RULES
	 **/
	public $ruang =
	[
		'ruangan'   => 'required|trim',
		'kapasitas' => 'required|trim|integer'
	];

	public $ruang_errors =
	[
		'ruangan'   => ['required' => 'harap isi bidang ini'],
		'kapasitas' => ['required' => 'harap isi bidang ini', 'integer' => 'harap isi dengan angka']
	];

	/**
	 * PRODI RULES
	 **/
	public $prodi =
	[
		'prodi'     => 'required|trim',
		'id_bidang' => 'required|trim'
	];

	public $prodi_errors =
	[
		'prodi'     => ['required' => 'harap isi bidang ini'],
		'id_bidang' => ['required' => 'pilih opsi dalam daftar']
	];

	/**
	 * MATA UJI RULES
	 **/
	public $matauji =
	[
		'mata_uji'  => 'required|trim',
		'id_bidang' => 'required|trim'
	];

	public $matauji_errors =
	[
		'mata_uji'  => ['required' => 'harap isi bidang ini'],
		'id_bidang' => ['required' => 'pilih opsi dalam daftar']
	];

	/**
	 * KELOMPOK SOAL RULES
	 **/
	public $kesol =
	[
		'abjad'         => 'required|trim',
		'number'        => 'required|trim',
		'tahun'         => 'required|trim|integer',
		'durasi'        => 'required|trim|integer',
		'jumlah_soal'   => 'required|trim|integer',
		'idbidang'      => 'required|trim'
	];

	public $kesol_errors =
	[
		'abjad'     	=> ['required' => 'pilih opsi dalam daftar'],
		'number'     	=> ['required' => 'pilih opsi dalam daftar'],
		'tahun'     	=> ['required' => 'pilih opsi dalam daftar', 'integer' => 'harap isi dengan angka'],
		'durasi'        => ['required' => 'harap isi bidang ini', 'integer' => 'harap isi dengan angka'],
		'jumlah_soal'   => ['required' => 'harap isi bidang ini', 'integer' => 'harap isi dengan angka'],
		'idbidang'      => ['required' => 'pilih opsi dalam daftar']
	];

	/**
	 * BERITA ACARA RULES
	 **/
	public $berita =
	[
		'berita_acara'   => 'required|trim',
	];

	public $berita_errors =
	[
		'berita_acara'   => ['required' => 'harap isi bidang ini'],
	];

	/**
	 * POLITEKNIK RULES
	 **/
	public $poli =
	[
		'kd_poltek'   => 'required|trim|integer',
		'nama_poltek' => 'required|trim',
	];

	public $poli_errors =
	[
		'kd_poltek'   => ['required' => 'harap isi bidang ini', 'integer' => 'harap isi dengan angka'],
		'nama_poltek' => ['required' => 'harap isi bidang ini'],
	];

	/**
	 * SESI RULES
	 **/
	public $sesi =
	[
		'sesi'        	   => 'required|trim',
		'id_jadwal'        => 'required|trim|integer',
		'tahun_angkatan'   => 'required|trim|integer',
		'waktu'            => 'required|trim'
	];

	public $sesi_errors =
	[
		'sesi' 		       => ['required' => 'pilih opsi dalam daftar'],
		'id_jadwal'        => ['required' => 'pilih opsi dalam daftar', 'integer' => 'harap isi dengan angka'],
		'tahun_angkatan'   => ['required' => 'pilih opsi dalam daftar', 'integer' => 'harap isi dengan angka'],
		'waktu'            => ['required' => 'harap isi bidang ini']
	];

	/**
	 * JADWAL RULES
	 **/
	public $jadwal =
	[
		'tggl'      => 'required|trim',
		'bln'       => 'required|trim'
	];

	public $jadwal_errors =
	[
		'tggl' 		=> ['required' => 'pilih opsi dalam daftar'],
		'bln' 		=> ['required' => 'pilih opsi dalam daftar'],
	];

	/**
	 * STAF KEAMANAN RULES
	 **/
	public $stafaman =
	[
		'oldpassword'  => 'required|trim|min_length[8]',
		'newpassword'  => 'required|trim|min_length[8]',
		'cnewpassword' => 'required|trim|min_length[8]|matches[newpassword]',
	];

	public $stafaman_errors =
	[
		'oldpassword'  => ['required' => 'harap isi bidang ini'],
		'newpassword'  => ['required' => 'harap isi bidang ini', 'min_length' => 'minimal 8 karakter'],
		'cnewpassword' => ['required' => 'harap isi bidang ini', 'min_length' => 'minimal 8 karakter', 'matches' => 'isi bidang tidak cocok'],
	];

	/**
	 * KOMPONEN RULES
	 **/

	public $komponen =
	[
		'nama_instansi' => 'required|trim',
		'url_website'   => 'required|trim',
		'namaFile' 	    => 'max_size[namaFile,1024]|is_image[namaFile]'
	];

	public $komponen_errors =
	[
		'nama_instansi' => ['required' => 'harap isi bidang ini'],
		'url_website'   => ['required' => 'harap isi bidang ini'],
		'namaFile' 	    => ['max_size' => 'ukuran file terlalu besar', 'is_image' => 'mungkin file yang diunggah bukan foto']
	];

	/**
	 * SOAL RULES
	 **/

	public $soal =
	[
		'id_kelompok_soal' => 'required|trim',
		'id_mata_uji'      => 'required|trim',
		'soal_1' 		   => 'required|trim',
		'posisi_gambar'    => 'trim',
		'namaFile' 	       => 'max_size[namaFile,1024]|is_image[namaFile]|mime_in[namaFile,image/jpg,image/jpeg,image/png]',
		'namaFile1' 	   => 'max_size[namaFile1,1024]|is_image[namaFile1]|mime_in[namaFile1,image/jpg,image/jpeg,image/png]',
		'namaFile2' 	   => 'max_size[namaFile2,1024]|is_image[namaFile2]|mime_in[namaFile2,image/jpg,image/jpeg,image/png]',
		'namaFile3' 	   => 'max_size[namaFile3,1024]|is_image[namaFile3]|mime_in[namaFile3,image/jpg,image/jpeg,image/png]',
		'namaFile4' 	   => 'max_size[namaFile4,1024]|is_image[namaFile4]|mime_in[namaFile4,image/jpg,image/jpeg,image/png]',
		'namaFile5' 	   => 'max_size[namaFile5,1024]|is_image[namaFile5]|mime_in[namaFile5,image/jpg,image/jpeg,image/png]',
		'soal_2' 		   => 'trim',
		'jawaban_1'   	   => 'required|trim',
		'jawaban_2'   	   => 'required|trim',
		'jawaban_3'   	   => 'required|trim',
		'jawaban_4'   	   => 'required|trim',
		'jawaban_5'    	   => 'required|trim',
		'opsi'             => 'required|trim',
	];

	public $soal_errors =
	[
		'id_kelompok_soal' => ['required' => 'pilih opsi dalam daftar'],
		'id_mata_uji' 	   => ['required' => 'pilih opsi dalam daftar'],
		'soal_1'           => ['required' => 'harap isi bidang ini'],
		'namaFile' 	       => ['max_size' => 'ukuran file terlalu besar', 'is_image' => 'mungkin file yang diunggah bukan foto', 'mime_in' => 'eksensi file tidak diijinkan'],
		'namaFile1'	       => ['max_size' => 'ukuran file terlalu besar', 'is_image' => 'mungkin file yang diunggah bukan foto', 'mime_in' => 'eksensi file tidak diijinkan'],
		'namaFile2'	       => ['max_size' => 'ukuran file terlalu besar', 'is_image' => 'mungkin file yang diunggah bukan foto', 'mime_in' => 'eksensi file tidak diijinkan'],
		'namaFile3'	       => ['max_size' => 'ukuran file terlalu besar', 'is_image' => 'mungkin file yang diunggah bukan foto', 'mime_in' => 'eksensi file tidak diijinkan'],
		'namaFile4'	       => ['max_size' => 'ukuran file terlalu besar', 'is_image' => 'mungkin file yang diunggah bukan foto', 'mime_in' => 'eksensi file tidak diijinkan'],
		'namaFile5'	       => ['max_size' => 'ukuran file terlalu besar', 'is_image' => 'mungkin file yang diunggah bukan foto', 'mime_in' => 'eksensi file tidak diijinkan'],
		'jawaban_1'        => ['required' => 'harap isi bidang ini'],
		'jawaban_2'        => ['required' => 'harap isi bidang ini'],
		'jawaban_3'        => ['required' => 'harap isi bidang ini'],
		'jawaban_4'        => ['required' => 'harap isi bidang ini'],
		'jawaban_5'        => ['required' => 'harap isi bidang ini'],
		'opsi'             => ['required' => 'pilih salah satu opsi'],
	];


	/**
	 * RUANGAN SESI RULES
	 **/

	public $ruses =
	[
		'id_ruangan'       => 'required|trim',
		'id_kelompok_soal' => 'required|trim',
		'id_sesi'      	   => 'required|trim',
		'id_pengawas'  	   => 'required|trim',
		'id_teknisi'   	   => 'required|trim',
	];

	public $ruses_errors =
	[
		'id_ruangan'  	   => ['required' => 'pilih opsi dalam daftar'],
		'id_kelompok_soal' => ['required' => 'pilih opsi dalam daftar'],
		'id_sesi' 	       => ['required' => 'pilih opsi dalam daftar'],
		'id_pengawas' 	   => ['required' => 'pilih opsi dalam daftar'],
		'id_teknisi'  	   => ['required' => 'pilih opsi dalam daftar'],
	];

	/**
	 * IMPORT RULES
	 **/

	public $import =
	[
		'namaFile' 	    => 'uploaded[namaFile]|ext_in[namaFile,xls,xlsx]'
	];

	public $import_errors =
	[
		'namaFile' 	    => ['uploaded' => 'harap unggah file', 'ext_in' => 'eksensi file tidak diijinkan']
	];

	/**
	 * KOMPONEN RULES
	 **/

	public $setquestion =
	[
		'id_kelompok_soal' => 'required|trim',
		'id_mata_uji'      => 'required|trim',
	];

	public $setquestion_errors =
	[
		'id_kelompok_soal' => ['required' => 'pilih opsi dalam daftar'],
		'id_mata_uji'      => ['required' => 'pilih opsi dalam daftar'],
	];


	/**
	 * PESERTA RULES
	 **/
	public $peserta =
	[
		'nik_peserta'     => 'required|trim|min_length[16]',
		'no_pendaftaran'  => 'required|trim|min_length[9]',
		'nisn_peserta'    => 'required|trim',
		'nama_peserta'    => 'required|trim',
		'jk_peserta'      => 'required',
		'id_poltek1'   	  => 'required',
		'id_prodi1'    	  => 'required',
		'no_telp_peserta' => 'required|trim',
	];

	public $peserta_errors =
	[
		'nik_peserta'     => ['required' => 'harap isi bidang ini', 'min_length' => 'minimal 16 karakter'],
		'no_pendaftaran'  => ['required' => 'harap isi bidang ini', 'min_length' => 'minimal 9 karakter'],
		'nisn_peserta'    => ['required' => 'harap isi bidang ini'],
		'nama_peserta'    => ['required' => 'harap isi bidang ini'],
		'jk_peserta'      => ['required' => 'pilih salah satu opsi'],
		'id_poltek1'      => ['required' => 'pilih opsi dalam daftar'],
		'id_prodi1'       => ['required' => 'pilih opsi dalam daftar'],
		'no_telp_peserta' => ['required' => 'harap isi bidang ini'],
	];

	/**
	 * KOMPONEN RULES
	 **/

	public $upruses =
	[
		'mulai1'   => 'required|trim|min_length[2]|max_length[2]|integer',
		'mulai2'   => 'required|trim|min_length[2]|max_length[2]|integer',
		'selesai1' => 'required|trim|min_length[2]|max_length[2]|integer',
		'selesai2' => 'required|trim|min_length[2]|max_length[2]|integer',
	];

	public $upruses_errors =
	[
		'mulai1'   => ['required' => 'harap isi bidang ini', 'min_length' => 'minimal 2 karakter', 'min_length' => 'maximal 2 karakter', 'integer' => 'harap isi dengan angka'],
		'mulai2'   => ['required' => 'harap isi bidang ini', 'min_length' => 'minimal 2 karakter', 'min_length' => 'maximal 2 karakter', 'integer' => 'harap isi dengan angka'],
		'selesai1' => ['required' => 'harap isi bidang ini', 'min_length' => 'minimal 2 karakter', 'min_length' => 'maximal 2 karakter', 'integer' => 'harap isi dengan angka'],
		'selesai2' => ['required' => 'harap isi bidang ini', 'min_length' => 'minimal 2 karakter', 'min_length' => 'maximal 2 karakter', 'integer' => 'harap isi dengan angka'],
	];

	public $ruangpeserta =
	[
		'jumlah_peserta'   => 'required|trim|integer',
	];

	public $ruangpeserta_errors =
	[
		'jumlah_peserta'   => ['required' => 'harap isi bidang ini', 'integer' => 'harap isi dengan angka'],
	];

	public $token =
	[
		'pin_sesi'   => 'required|trim|integer|min_length[6]|max_length[6]',
	];

	public $token_errors =
	[
		'pin_sesi'   => ['required' => 'harap isi bidang ini', 'integer' => 'harap isi dengan angka', 'min_length' => 'minimal 6 karakter', 'min_length' => 'maximal 6 karakter'],
	];

	public $reset =
	[
		'reset-kp'   => 'required',
	];

	public $reset_errors =
	[
		'reset-kp'   => ['required' => 'harap centang kotak ini jika ingin melanjutkan'],
	];
}
