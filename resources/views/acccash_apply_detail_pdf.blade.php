<html>
<head>
	<title>Informasi Penggunaan Dana</title>
</head>
<body>
	<p><strong>Informasi</strong><strong> Penggunaan Dana</strong></p>
	<p>Dokumen ini berisi informasi penggunaan dana sesuai dengan data yang diisi oleh pelanggan:</p>
	<br/><br/>
	<table style="height: 28px; width: 450px;">
	<tbody>
	<tr>
	<td style="width: 190px;">Nomor Transaksi</td>
	<td style="width: 9px;">:</td>
	<td style="width: 250px;">{{$AccCashApplys[0]->NO_AGGR}}</td>
	</tr>
	</tbody>
	</table>
	<br/><br/>
	<table style="height: 104px; width: 450px;">
	<tbody>
	<tr style="height: 14px;">
	<td style="width: 190px; height: 14px;">Nama Pelanggan</td>
	<td style="width: 9px; height: 14px;">:</td>
	<td style="width: 250px; height: 14px;">{{$AccCashApplys[0]->NAME}}</td>
	</tr>
	<tr style="height: 14px;">
	<td style="width: 190px; height: 14px;">Tanggal</td>
	<td style="width: 9px; height: 14px;">:</td>
	<td style="width: 250px; height: 14px;">{{date('d M Y H:i:s', strtotime($AccCashApplys[0]->DT_ADDED))}}</td>
	</tr>
	<tr style="height: 14px;">
	<td style="width: 190px; height: 14px;">Nominal</td>
	<td style="width: 9px; height: 14px;">:</td>
	<td style="width: 250px; height: 14px;">Rp {{number_format($AccCashApplys[0]->DISBURSEMENT, 0, ',', '.')}}</td>
	</tr>
	<tr style="height: 14px;">
	<td style="width: 190px; height: 14px;">Tujuan Penggunaan Dana</td>
	<td style="width: 9px; height: 14px;">:</td>
	<td style="width: 250px; height: 14px;">{{$AccCashApplys[0]->TUJUAN_PENGGUNAAN}}</td>
	</tr>
	<tr style="height: 14px;">
	<td style="width: 190px; height: 14px;">Penyedia Barang/Jasa</td>
	<td style="width: 9px; height: 14px;">:</td>
	<td style="width: 250px; height: 14px;">{{$AccCashApplys[0]->PENYEDIA}}</td>
	</tr>
	</tbody>
	</table>
	<p>&nbsp;</p>
</body>
</html>
