<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <title>BAP</title>
  <style>
    body {
      font-family: 'Times New Roman', Times, serif;
      padding: 20px;
      border: 1px solid #000;
    }

    table {
      width: 100%;
      border-collapse: collapse;
    }

    th,
    td {
      border: 1px solid #000;
      padding: 5px;
    }

    th {
      text-align: center;
    }

    h4,
    h5 {
      margin: 0;
    }

    p {
      margin: 0;
      font-size: 12px;
    }

    hr {
      border: 1px solid #000;
    }
  </style>
</head>

<body>
  <table>
    <tr>
      <!-- <td style="width: 60px; vertical-align: middle;">
        <img src="/img/LOGO_UMRAH_PNG.png" alt="Logo" style="width: 150px; height: 150px;">
      </td> -->
      <td style="text-align: center;">
        <h4>KEMENTERIAN PENDIDIKAN, KEBUDAYAAN,</h4>
        <h4>RISET, DAN TEKNOLOGI</h4>
        <h4>UNIVERSITAS MARITIM RAJA ALI HAJI</h4>
        <h5 style="font-weight: bold;">FAKULTAS TEKNIK DAN TEKNOLOGI KEMARITIMAN</h5>
        <p>Jalan Politeknik Senggarang Telp. (0771) 4500097; Fax. (0771) 4500097</p>
        <p>PO.BOX 155 – Tanjungpinang 29100</p>
        <p>Website: <a href="http://fttk.umrah.ac.id/" target="_blank">http://fttk.umrah.ac.id/</a> e-mail: <a href="mailto:teknik@umrah.ac.id">teknik@umrah.ac.id</a></p>
      </td>
    </tr>
  </table>

  <hr>

  <h5 style="text-align: center; font-weight: bold;">BERITA ACARA</h5>
  <h5 style="text-align: center; font-weight: bold;">REVIEW RENCANA PEMBELAJARAN SEMESTER (RPS)</h5>

  <p>Hari/tanggal: <?= $hari[date('l', strtotime($bap['tanggal']))] ?> / <?= date('d-m-Y', strtotime($bap['tanggal'])) ?></p>
  <p>Tempat: <?= $bap['tempat'] ?></p>
  <p>Nama MK / Kode MK: <?= $mata_kuliah['nama_mk'] ?> / <?= $bap['kode_mk'] ?></p>

  <h6>Catatan review:</h6>
  <table>
    <thead>
      <tr>
        <th style="width: 5%;">No</th>
        <th>Catatan</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($review_notes as $index => $note): ?>
        <tr>
          <td><?= $index + 1 ?></td>
          <td><?= $note['catatan'] ?></td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</body>

</html>