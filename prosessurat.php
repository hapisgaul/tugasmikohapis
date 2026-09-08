<? php
//masukkan library DomPDF
require_once 'vendor/autoload.php';
use DomPDF\Dompdf;
use DomPDF\Options;

//instansiasi objek DomPDF
if ($SERVER ['REQUEST_METHOD'] === 'POST'){
    //ambil data dari form html
    $nama = htmlspecialchars($_POST['nama']);
    $nis = htmlspecialchars ($_POST['nis']);
    $kelas = htmlspecialchars ($_POST['kelas']);
    $alasan = htmlspecialchars ($_POST['alasan']);
    $tgl_mulai = ('d F Y, strtotime($_POST['tgl_mulai']));
    $tgl_selesai = ('d F Y, strtotime($_POST['tgl_selesai']));
    $keterangan = htmlspecialchars ($_POST['keterangan']);
    $tgl_sekarang = date('d F Y');

 //template halaman pdf
$html = '
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Surat</title>
    <style>
        body {
            font-family: "Times New Roman";
            font-size: 12pt;
            margin: 20px;
        }
        .kop{
         font-family: "century gothic";
         text-align: center;
         border-bottom: 3px solid black;
         padding-bottom: 10px;
         margin-bottom: 20px;
         
         }
         .kop h2{
         margin: 0;
         font-size: 16pt;
         text-transform: uppercase;
         }
         .kop p{
         margin: 10pt;
         
         }
         title{
         text-align: center;
         font-weight: bold;
         text-decoration: underline;
         margin-bottom: 25px;
         
         }
         .content{
           line-height: 1.6;
           text-aligh: justify;
           
        } 
           .table-data{
            margin: 15px 0 15px 30px
            width: 100%;
           
        }
            .table-data td{
               width: 100%;
               margin-top: 50px;
               
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
        
            .


</head>
<body>
   <div class="kop">
     <h2>SMK TEXMACO SEMARANG</h2>
     <p>Jl. Raya mangkang kulon | Telp: (023) 223-8889</p>
</div>
<div class="title">SURAT IZIN MENINGGALKAN KELAS</div>

<div class="content">
<p>Yang bertanda tangan di bawah ini:</p>
<table class="table-data">
     <tr>
        <td width="130">NAMA</td>
        <td width="15">:</td>
        <td><b>' .$nama . '</b></td>
 </tr>
 <tr>
      <td with="130">NIS</td>
</tr>
<tr>
     <td>kelas</td>
     <td:</td>
     <td>' . $kelas . '</td>
    </tr>
    </table>

    <p>Bermaksud untuk mengajukan permohohonan izin meninggalkan kelas 
    pada tanggal <b>' . $tgl_mulai . '</b>
    sampai dengan <b>' . $tgl_selesal . '</b>
    dikarenakan <b>' .$alasan . '</b>
</p>
'. ($keterangan ? '<p>Detail keterangan: <b>' .$keterangn.'</b></p>' : '') . '
<p>Demikian surat izin ini saya buat.Atas perhatian dan pengertian Bapak/ibu, saya ucapkan
 terima kasih.
 </p>
</div>

<div class="ttd-container">
<div class="ttd-box">
<p>Semarang, '. $tgl_sekarang . '<br>Hormat saya,</p>
<br><br><br>
<p><b>('. $nama . ')</b></p>

</div>
</div>
</body>
</html>

// 3. konfigurasi dan Inisialisasi Dompdf
$options = new options();
$options->set('isremoteEnabled; //Memungkinkan load gambar eksternal jika ada 
$dompt = new Dompdf($options);

// 4. Render HTML ke PDF
$dompdf->loadHTML($html);
$dompdf->setpaper('A4', 'portait');
$dompdf->render();

// 5. stream PDF ke Browser
$dompdf->stream("Surat_Izin_" . str_replace(' ',
'_' $nama) . ".pdf", ["Attachment" => false]);
}
?>
';