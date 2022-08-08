
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http//www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php $CI =& get_instance(); ?>
<html xmlns="http//www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="<?php echo base_url(); ?>css/bootstrap.min.css" rel="stylesheet" type="text/css" />
<title>&nbsp;SISTEM INFORMASI PENDIDIKAN [ HOMESCHOOLING KAK SETO ]</title>
</head>
<body>
<table border="0" cellpadding="10" cellspacing="5" width="780" align="center">
	<tr>
		<td align="left" valign="top" colspan="2">

	&nbsp;<table border="0" cellpadding="0" cellspacing="0" width="100%">
	<tr>
		<td valign="top" align='center'>
			<font size="2"><strong>PKBM KAK SETO <br /> PROGRAM HOMESCHOOLING</strong></font><br />
			<img src="<?php echo base_url(); ?>images/logoks.jpg" height="60">
			<br/>Belajar Lebih Cerdas Kreatif Dan Ceria
			<br />Jln. Taman Makam Bahagia ABRI No. 3A Parigi Lama Bintaro Sektor 9, Tangerang Selatan 15400 Indonesia
			<br>Telp. (021) 7451183 , 082817031183&nbsp;&nbsp;Fax. (021) 7451184&nbsp;&nbsp;Email: info@hsks.sch.id&nbsp;&nbsp;Website: www.hsks.sch.id&nbsp;&nbsp;			</strong>
		</td>
	</tr>
	<tr>
		<td colspan="2"><hr width="100%" /></td>
	</tr>
</table>
<center>
  <font size="4"><strong>SANDI DIGITAL UNTUK IDENTIFIKASI KARYAWAN (SDK)<br/></font>
  <font size="3">Nomor : 005/HSKS-SEd/SDM/VIII/2016</strong></font><br />
 </center>
 <br />
<br />
<p align="justify">
Kepada Yth.<br />
<table width="100%">
	<tr>
		<th width="100">Nama</th><th width="20">:</th><th><?php echo $isi->nama ?></th>
	</tr>
	<tr>
		<th>NIK</th><th>:</th><th><?php echo $isi->nip ?></th>
	</tr>
</table>
<br/><br/>
Berikut adalah Sandi Digital Untuk Identifikasi Karyawan (SDK), yang akan anda pergunakan selama bekerja di <i>“Homeschooling Kak Seto”</i>.
<br/><br/>
<center>
	<table width="300">
		<tr>
			<th>Nama Pengguna</th><th width="20">:</th><th><?php echo $isi->nip?></th>
		</tr>
		<tr>
			<th>Peran</th><th width="20">:</th><th><?php echo $CI->dbx->role_show($isi->role_id,0) ?></th>
		</tr>
		<tr>
			<th>Kata Sandi</th><th>:</th><th><?php echo $this->session->userdata('passtext')?></th>
		</tr>
	</table>
</center>
<ol align="justify" style="padding: 15px;">
	<li>Nama pengguna ini digunakan untuk mengakses Sistem Informasi “Homeschooling Kak Seto” (SIHSKS), sistem ini digunakan untuk segala informasi yang berhubungan dengan HSKS.</li>
	<li>Nama pengguna anda juga dapat digunakan untuk mengakses data siswa pada Sistem Informasi Pendidikan (SIP) sesuai dengan jabatan pengguna.</li>
	<li>SIHSKS ini dapat diakses melalui link <b><i>"<?php echo site_url() ?>"</i></b> dengan menggunakan <i>Browser</i> (Contoh: <i><b>Opera,Chrome, Firefox</b></i>).</li>
	<li>Nama pengguna ini juga digunakan sebagai Universal ID untuk mengakses Sistem Integrasi lainnya di HSKS (Contohnya: berbagi dokumen pada Server, Login Komputer, dll).</li>
	<li>Setiap karyawan wajib mengubah kata sandi yang telah diberikan dengan kata sandi yang baru setelah Login melalui menu “Ganti kata sandi” pada SIHSKS. (<b><i>"<?php echo site_url() ?>/ganti_password"</i></b>).</li>
	<li>Apabila data ini hilang atau lupa kata sandi, dapat mengajukan kembali permohonan kata sandi kepada Staf Admin SDM.</li>
	<li>SDK ini merupakan data rahasia karyawan, segala resiko atas kerahasiaan data ini menjadi tanggung jawab karyawan, untuk itu diharapkan tidak memberitahukannya kepada pihak yang tidak berwenang.</li>
</ol>
Informasi lebih lanjut terkait Sistem Infromasi HSKS dapat menghubungi kontak dibawah ini:
<center>
	<table width="90%">
		<tr>
			<th align="left"><?php echo $isipeg->panggilan." (".$isipeg->nip.")"; ?></th><th>:</th><th align="left"><?php echo $isipeg->handphone; ?></th>
		</tr>
		<tr>
			<th width="200" align="left">Kak Ilyas (112012121043)</th><th width="20">:</th><th align="left">081295700809</th>
		</tr>
	</table>
</center>
</p>
<table width="100%" border="0">
	<tr align="right"><td>
		<table width="250" border="0">
			<tr align="center">
				<td>Tangerang Selatan, <?php echo $CI->p_c->tgl_indo(date('Y-m-d'));?></td>
			</tr>
			<tr>
				<td><br/><br/><br/><br/>
			</tr>
			<!--
			<tr align="center">
				<td><b>Adi Kurnia, M.Si </b></td>
			</tr>
		-->
			<tr align="center"><b>
				<td><b>Manajer SDM</b></td>
			</tr>
		</table>
	</td></tr>
</table>
</body>
<script language="javascript">
	window.print();
</script>
</html>
