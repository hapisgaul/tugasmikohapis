<?php
//Masukan libary DomPDF
require_once'vendor/autoload.php';
use Dompdf\Dompdf;
use Dompdf\Options;

//Instansiasi objek DomPDF
if($_SERVER['REQUEST_METHOD'] === 'POST'){
    //Ambil data dari form html
    $nama           =htmlspecialchars($_POST['nama']);
    $nis            =htmlspecialchars($_POST['nis']);
    $kelas          =htmlspecialchars($_POST['kelas']);
    $alasan         =htmlspecialchars($_POST['alasan']);
    $tanggal        =date('d F Y',strtotime($_POST['tanggal']));
    $tanggal2       =date('d F Y',strtotime($_POST['tanggal2']));
    $keterangan     =htmlspecialchars($_POST['keterangan']);
    $tgl_sekarang   = date('d F Y');

    //template halaman surat
$html='
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak Surat</title>
    <style>
        body{
            font-family:"Times New Roman";
            font-size: 12pt;
            margin: 20px;
        }
        .kop{
            font-family:"century gothic";
            text-align: center;
            border-bottom: 3px double #000 ;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }
        .kop h2{
            margin: 0;
            font-size: 16pt;
            text-transform: uppercase;
        }
        .kop p{
            margin: 2px;
            font-size: 10pt;
        }
        .title{
            text-align: center;
            font-weight: bold;
            text-decoration: underline;
            margin-bottom: 25px;
        }
        .content{
            line-height: 1.6;
            text-align: justify;
        }
        .table-data{
            margin:15px 0 15px 30px;
            width: 100%;
        }
        .table-data td{
            padding: 4px;
            vertical-align: top;
        }
        .ttd-container{
            width: 100%;
            margin-top: 50px;
        }
        .ttd-box{
            float: right;
            width: 200px;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="kop">
        <h2>SMK TEXMACO SEMARANG</h2>
        <p>Jalan Raya Mangkang Km 16 Semarang  50155 | Telp :(024) 8661966 / (024) 8661967</p>
    </div>

    <div class="title">SURAT IZIN MENINGGALKAN KELAS</div>
    <div class="content">
        <p>Yang bertanda tangan di bawah ini :</p>
        <table class="table-data">
            <tr>
                <td width="130">Nama</td>
                <td width="15">:</td>
                <td><b>'.$nama.'</b></td>
            </tr>
            <tr>
                <td width="130">NIS</td>
                <td width="15">:</td>
                <td>'.$nis.'</td>
            </tr>
            <tr>
                <td>Kelas</td>
                <td>:</td>
                <td>'.$kelas.'</td>
            </tr>
        </table>

        <p></p>Dengan ini mengajukan izin untuk meninggalkan kelas pada tanggal <b>'.$tanggal.'</b> sampai dengan tanggal <b>'.$tanggal2.'</b> dikarenakan <b>'.$alasan.'</b>.</p>
        ' .($keterangan ?'<p>Detail Keterangan  :  '.$keterangan.'</p>' : '').'
        <p>Demikian surat pengajuan izin ini saya buat dengan sebenar-benarnya, atas perhatian dan kebijaksanaannya saya ucapkan terima kasih.</p>
    </div>
    <div class="ttd-container">
        <div class="ttd-box">
            <p>Semarang, '.$tgl_sekarang.'</p>
            <p>Hormat Saya</p>
            <br><br><br>
            <p><b>'.$nama.'</b></p>
        </div>
    </div>
</body>
</html>
';


    //Instansiasi objek DomPDF
    $dompdf = new Dompdf();
    $dompdf->loadHtml($html);
    $dompdf->setPaper('A4', 'portrait');
    $dompdf->render();
    $dompdf->stream('surat-izin.pdf', array("Attachment" => false));
}

?>