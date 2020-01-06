<!DOCTYPE html>
<html>
<head>
    <title>Test Send Mail</title>
</head>
<body>
    {{-- @dd($data_mail); --}}
    <h1>Hai {{ $data_mail["EMAIL"] }}</h1>
    <p>Pengajuan Kamu sebesar {{$data_mail["DISBURSEMENT"]}} dari No Kontrak {{$data_mail["NO_AGGR"]}} telah disetujui. Kamu akan segera kami hubungi untuk tanda tangan kontrak.</p>
   
    <p>Thank you</p>
</body>
</html>