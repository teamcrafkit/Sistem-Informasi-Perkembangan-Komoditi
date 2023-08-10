<?php

use Illuminate\Support\Facades\Auth;


function _noTransaksi($count)
{
    $lastNoUrut = $count + 1;
    return str_pad($lastNoUrut, 4, '0', STR_PAD_LEFT);
}
function _monthRomawi()
{
    $bulan = now()->month;
    switch ($bulan) {
        case 1:
            $number = "I";
            break;
        case 2:
            $number = "II";
            break;
        case 3:
            $number = "III";
            break;
        case 4:
            $number = "IV";
            break;
        case 5:
            $number = "V";
            break;
        case 6:
            $number = "VI";
            break;
        case 7:
            $number = "VII";
            break;
        case 8:
            $number = "VIII";
            break;
        case 9:
            $number = "IX";
            break;
        case 10:
            $number = "X";
            break;
        case 11:
            $number = "XI";
            break;
        case 12:
            $number = "XII";
            break;

        default:
            $number = "XIII";
            break;
    }
    return $number;
}

function _deletePath($path)
{
    if (is_dir($path) === true) {
        $files = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($path), RecursiveIteratorIterator::CHILD_FIRST);

        foreach ($files as $file) {
            if (in_array($file->getBasename(), array('.', '..')) !== true) {
                if ($file->isDir() === true) {
                    rmdir($file->getPathName());
                } else if (($file->isFile() === true) || ($file->isLink() === true)) {
                    unlink($file->getPathname());
                }
            }
        }

        return rmdir($path);
    } else if ((is_file($path) === true) || (is_link($path) === true)) {
        return unlink($path);
    }

    return false;
}
function uploadGambar($property, $image_old = '')
{
    if ($image_old != "") {
        if (file_exists(storage_path('app/public/' . $property['path'] . $image_old)) == TRUE) {
            unlink(storage_path('app/public/' . $property['path'] . $image_old));
        }
    }
    switch ($property['mimetype']) {
        case 'image/jpeg':
            $image_create_func = 'imagecreatefromjpeg';
            $image_save_func   = 'imagejpeg';
            break;
        case 'image/jpg':
            $image_create_func = 'imagecreatefromjpeg';
            $image_save_func   = 'imagejpeg';
            break;
        case 'image/png':
            $image_create_func = 'imagecreatefrompng';
            $image_save_func   = 'imagepng';
            break;
    }
    $original     = $image_create_func($property['path_uploaded']);
    $src_width    = imageSX($original);
    $src_height   = imageSY($original);
    $resized      = imagecreatetruecolor($property['width'], $property['height']);
    imagecopyresampled($resized, $original, 0, 0, 0, 0, $property['width'], $property['height'], $src_width, $src_height);
    $image_save_func($resized, storage_path('app/public/' . $property['path'] . $property['name']));
}

function _unlinkFile($vdir_file, $file_name)
{
    if (file_exists($vdir_file . $file_name) == TRUE) {
        unlink($vdir_file . $file_name);
    }
}
function _encdec($action, $string)
{
    $output         = false;
    $encrypt_method = "AES-256-CBC";
    $secret_key     = '_[@r3zky92]';
    $secret_iv         = '@_[@r3zky92]';
    $key             = hash('sha256', $secret_key);
    $iv             = substr(hash('sha256', $secret_iv), 0, 16);
    if ($action == 'enc') {
        $output = openssl_encrypt($string, $encrypt_method, $key, 0, $iv);
        $output = base64_encode($output);
    } elseif ($action == 'dec') {
        $output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
    }
    return $output;
}

function _inputSex()
{
    $arr = array('Laki-Laki', 'Perempuan');
    for ($i = 0; $i < count($arr); $i++) {
        echo "<option value='$arr[$i]'>$arr[$i]</option>";
    }
}
function _editSex($data)
{
    $arr = array('Laki-Laki', 'Perempuan');
    for ($i = 0; $i < count($arr); $i++) {
        if ($arr[$i] == $data) {
            echo "<option arrue='$arr[$i]' selected>$arr[$i]</option>";
        } else {
            echo "<option value='$arr[$i]'>$arr[$i]</option>";
        }
    }
}
function _inputJabatan()
{
    $arr = array('Ketua', 'Sekretaris','Bendahara');
    for ($i = 0; $i < count($arr); $i++) {
        echo "<option value='$arr[$i]'>$arr[$i]</option>";
    }
}
function _editJabatan($data)
{
    $arr = array('Ketua', 'Sekretaris','Bendahara');
    for ($i = 0; $i < count($arr); $i++) {
        if ($arr[$i] == $data) {
            echo "<option arrue='$arr[$i]' selected>$arr[$i]</option>";
        } else {
            echo "<option value='$arr[$i]'>$arr[$i]</option>";
        }
    }
}
function _cutStr($text, $maxchar = 500, $end = '...')
{
    if (strlen($text) > $maxchar || $text == '') {
        $words = preg_split('/\s/', $text);
        $output = '';
        $i      = 0;
        while (1) {
            $length = strlen($output) + strlen($words[$i]);
            if ($length > $maxchar) {
                break;
            } else {
                $output .= " " . $words[$i];
                ++$i;
            }
        }
        $output .= $end;
    } else {
        $output = $text;
    }
    return $output;
}
function get_client_ip()
{
    $ipaddress = '';
    if (getenv('HTTP_CLIENT_IP'))
        $ipaddress = getenv('HTTP_CLIENT_IP');
    else if (getenv('HTTP_X_FORWARDED_FOR'))
        $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
    else if (getenv('HTTP_X_FORWARDED'))
        $ipaddress = getenv('HTTP_X_FORWARDED');
    else if (getenv('HTTP_FORWARDED_FOR'))
        $ipaddress = getenv('HTTP_FORWARDED_FOR');
    else if (getenv('HTTP_FORWARDED'))
        $ipaddress = getenv('HTTP_FORWARDED');
    else if (getenv('REMOTE_ADDR'))
        $ipaddress = getenv('REMOTE_ADDR');
    else
        $ipaddress = 'UNKNOWN';
    return $ipaddress;
}
 
function _inputStatus()
{
    $arr = array('Aktif', 'Tidak Aktif');
    $val = array(1, 0);
    for ($i = 0; $i < count($arr); $i++) {
        echo "<option value='$val[$i]'>$arr[$i]</option>";
    }
}
function _editStatus($data)
{
    $arr = array('Aktif', 'Tidak Aktif');
    $val = array(1, 0);
    for ($i = 0; $i < count($arr); $i++) {
        if ($val[$i] == $data) {
            echo "<option value='$val[$i]' selected>$arr[$i]</option>";
        } else {
            echo "<option value='$val[$i]'>$arr[$i]</option>";
        }
    }
}
function fTampilTgl($sdate, $edate)
{
    if ($sdate == $edate) {
        $tgl =  date("j M Y", strtotime($sdate));
    } elseif ($edate > $sdate) {
        if (date("Y", strtotime($sdate)) == date("Y", strtotime($edate))) {
            if (date("M Y", strtotime($sdate)) == date("M Y", strtotime($edate))) {
                if (date("j M Y", strtotime($sdate)) == date("j M Y", strtotime($edate))) {
                    if (date("j M Y H", strtotime($sdate)) == date("j M Y H", strtotime($edate))) {
                        $tgl = date("j M Y H:i", strtotime($sdate));
                    } else {
                        $tgl = date("j M Y H:i", strtotime($sdate)) . " - " . date("H:i", strtotime($edate));
                    }
                } else {
                    $tgl = date("j", strtotime($sdate)) . " - " . date("j M Y", strtotime($edate));
                }
            } else {
                $tgl = date("j M", strtotime($sdate)) . " - " . date("j M Y", strtotime($edate));
            }
        } else {
            $tgl = date("j M Y", strtotime($sdate)) . " - " . date("j M Y", strtotime($edate));
        }
    }
    return $tgl;
}
function hapus_underscore($h)
{
    $d = '-';
    $h = str_replace($d, ' ', $h);

    return ucwords($h);
}
function hapus_underscore_1($h)
{
    $d = '_';
    $h = str_replace($d, '-', $h);
    return strtolower($h);
}
function hapus_underscore_2($h)
{
    $d = '_';
    $h = str_replace($d, ' ', $h);
    return strtoupper($h);
}
function hapus_underscore_min($h)
{
    $d = '-';
    $h = str_replace($d, ' ', $h);
    $t = ucwords($h);
    $k = ' ';
    $x = str_replace($k, '-', $t);
    return $x;
}
function hapus_underscore_min1($h)
{
    $d = '-';
    $h = str_replace($d, ' ', $h);
    $t = ucwords($h);
    $k = ' ';
    $x = str_replace($k, ' ', $t);
    return $x;
}
function rupiah($angka)
{
    $rupiah = "<small>Rp.</small>" . number_format($angka, 0, ',', '.') . ",-";
    return $rupiah;
}
function rupiah1($angka)
{
    $rupiah = number_format($angka, 0, ',', '.');
    return $rupiah;
}
function rupiah2($angka)
{
    $rupiah = "Rp. " . number_format($angka, 0, ',', '.') . ",-";
    return $rupiah;
}
function rupiah3($angka)
{
    $rupiah = "Rp" . number_format($angka, 0, ',', '.');
    return $rupiah;
}
function rupiah4($angka)
{
    $rupiah = "Rp " . number_format($angka, 0, ',', '.');
    return $rupiah;
}
//Fungsi Tanggal
function tanggal($tgl)
{
    $tanggal = substr($tgl, 8, 2);
    return $tanggal;
}
function bulan($bln)
{
    $angka = (substr($bln, 5, 2)) - 1;
    $bulan = array("Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");
    return $bulan[$angka];
}
function bulan1($bln)
{
    $bulan = substr($bln, 5, 2);
    return $bulan;
}
function tahun($thn)
{
    $tahun = substr($thn, 0, 4);
    return $tahun;
}
function format_tgl1($format_tanggal)
{ //Format Tanggal Indonesia: DD MMMMMM YYYY
    $format = tanggal($format_tanggal) . " " . bulan($format_tanggal) . " " . tahun($format_tanggal);
    return $format;
}
function format_tgl2($format_tanggal)
{ //Format Tanggal Indonesia: DD-MMMMMM-YYYY
    $format = tanggal($format_tanggal) . "-" . bulan($format_tanggal) . "-" . tahun($format_tanggal);
    return $format;
}
function format_tgl3($format_tanggal)
{ //Format Tanggal Indonesia: DD-MM-YYYY
    $format = tanggal($format_tanggal) . "-" . bulan1($format_tanggal) . "-" . tahun($format_tanggal);
    return $format;
}
function format_tgl4($format_tanggal)
{ //Format Tanggal Indonesia: DD/MM/YYYY
    $format = tanggal($format_tanggal) . "/" . bulan1($format_tanggal) . "/" . tahun($format_tanggal);
    return $format;
}
function format_tgl5($format_tanggal)
{ //Format Tanggal: MM DD YYYY
    $format = bulan($format_tanggal) . " " . tanggal($format_tanggal) . ", " . tahun($format_tanggal);
    return $format;
}
function format_tgl6($format_tanggal)
{ //Format Tanggal: MM/DD/YYYY
    $format = bulan1($format_tanggal) . "/" . tanggal($format_tanggal) . "/" . tahun($format_tanggal);
    return $format;
}

function is_url_exist($url)
{
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_NOBODY, true);
    curl_exec($ch);
    $code = curl_getinfo($ch, CURLINFO_HTTP_CODE);

    if ($code == 200) {
        $status = true;
    } else {
        $status = false;
    }
    curl_close($ch);
    return $status;
}

function _is_url_exist($url)
{
    $options['http'] = array(
        'method'         => "HEAD",
        'ignore_errors' => 1,
        'max_redirects' => 0,
    );
    $options['ssl'] =  array(
        "verify_peer"        => FALSE,
        "verify_peer_name"    => FALSE,
    );
    $body = file_get_contents($url, FALSE, stream_context_create($options));
    sscanf($http_response_header[0], 'HTTP/%*d.%*d %d', $code);
    return $code === 200;
}

function input_bulan()
{
    $bulan = array("Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");
    $number = array('01', '02', '03', '04', '05', '06', '07', '08', '09', '10', '11', '12');
    for ($i = 0; $i < 12; $i++) {
        echo "<option value='$number[$i]'>$bulan[$i]</option>";
    }
}
function edit_bulan($bulan)
{
    $bln = array("Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");
    $number = array('01', '02', '03', '04', '05', '06', '07', '08', '09', '10', '11', '12');
    for ($i = 0; $i < 12; $i++) {
        if ($number[$i] == $bulan) {
            echo "<option value='$number[$i]' selected>$bln[$i]</option>";
        } else {
            echo "<option value='$number[$i]'>$bln[$i]</option>";
        }
    }
}
function _bulanNo($bulan)
{
    switch ($bulan) {
        case '01':
            $bulan = "Januari";
            break;
        case '02':
            $bulan = "Februari";
            break;
        case '03':
            $bulan = "Maret";
            break;
        case '04':
            $bulan = "April";
            break;
        case '05':
            $bulan = "Mei";
            break;
        case '06':
            $bulan = "Juni";
            break;
        case '07':
            $bulan = "Juli";
            break;
        case '08':
            $bulan = "Agustus";
            break;
        case '09':
            $bulan = "September";
            break;
        case '10':
            $bulan = "Oktober";
            break;
        case '11':
            $bulan = "November";
            break;
        case '12':
            $bulan = "Desember";
            break;
    }
    return $bulan;
}
function input_tahun()
{
    $thn = date("Y");
    for ($i = $thn; $i >= 2017; $i--) {
        echo "<option value='$i'>$i</option>";
    }
}
function edit_tahun($tahun)
{
    $thn = date("Y");
    for ($i = $thn; $i >= 2017; $i--) {
        if ($i == $tahun) {
            echo "<option value='$i' selected>$i</option>";
        } else {
            echo "<option value='$i'>$i</option>";
        }
    }
}
