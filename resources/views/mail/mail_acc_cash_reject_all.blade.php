<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
   
    <title>Aplikasi acccash {{$data_mail["NO_AGGR"]}} Reject</title>
</head>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

<body>
    <div class="panel panel-default" style="Height:1760px ; width:880px;">
        <div class="panel-body">
            <img class="center" src="{{ asset('assets/Pictures/logo acccash text.png') }}" alt=""><br><br>

            <h3>Hai, {{ $data_mail["NAME"] }}</h3>
            <p>Maaf saat ini pengajuan Kamu Reject dan belum dapat dilanjutkan ke proses selanjutnya.<br>
                Ayo ajukan kembali pengajuan Kamu dan pastikan sudah sesuai dengan <a href="https://www.acc.co.id/acccash">syarat & ketentuan </a>yang berlaku.</p>

            <a class="center" href="https://www.acc.co.id/acccash"><img src="{{ asset('assets/Pictures/Picture2.png') }}" alt="" ></a><br>
            <a class="center" href="#"><img src="{{ asset('assets/Pictures/Picture3.png') }}" alt="" ></a><br>
        </div>
        <div class="panel-footer"> 
            {{-- <h4>Punya Pertanyaan? Kamu Dapat Hubungi </h4><br>
            <div class="row">
                <div class="col-sm-3">
                    <p>Whatsapp Yuna</p>
                    <p>0811-1-500-599</p>
                </div>
                <div class="col-sm-3">
                    <p>Kontak Center ACC</p>
                    <p>1500599</p>
                </div>
            </div><br>
            <p>This email is intended solely for the recipient specified in the message. This system-generate email, Please do not reply.</p> --}}
            <a class="center" href="#"><img src="{{ asset('assets/Pictures/Picture5.png') }}" alt="" ></a><br>
        </div>
    </div>
</body>
</html>