{{-- <!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <title>Kamu Mendapatkan Plafon Kredit dari ACC!</title>
</head>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>


<body>
    <div class="center panel panel-default" style=" width:800px;">
    <div class="panel-header" style="height:115px; background:#081e33;">
      <br><img src="{{ asset('assets/Pictures/logo_acccash_text.png') }}" style="width:250px; height:75px !important; ;" alt="" class="center"><br><br>
    </div>
        <div class="panel-body">
            <h3>Hai, {{ $data_mail["NAME"] }}</h3>
            <img src="{{ asset('assets/Pictures/Ilustrasi_acccash-02.jpg') }}" class="center" style="height:300px;"alt=""><br><br>
            <p>Selamat!</p>
            <p>Kamu mendapatkan plafon sebesar {{$data_mail["PLAFOND"]}} yang dapat kamu cairkan melalui
                aplikasi acc.one.<br>
                Yuk download aplikasinya sekarang dan lihat plafon Kamu.</p>
         
                <a class="center" href="https://www.acc.co.id/acccash"><img src="{{ asset('assets/Pictures/Picture2.png') }}" style="width:200px; height:30px" alt="" class="center"></a>    
                <div class="tengah">
                <a href="https://play.google.com/store/apps/details?id=com.outsystemsenterprise.prod8.ACCOne"><img src="{{ asset('assets/Pictures/downloadplaystore.png') }}" style="width:120px; height:50px" alt=""></a>
                <a href="https://apps.apple.com/us/app/acc-one/id1453382506"><img src="{{ asset('assets/Pictures/downloadappstore.png  ') }}" style="width:120px; height:50px " alt="" ></a>  
                </div>
            </div>
            <div class="panel-footer"> 
                <h4 class="bold">Punya Pertanyaan? Kamu Dapat Hubungi </h4><br>
                <div class="row">
                    <div class="col-sm-3">
                        <p class="bold">Whatsapp Yuna</p>
                        <div class="row">
                            <div class="col-sm-1">
                            <p><img src="{{ asset('assets/Pictures/Picture6.jpg') }}" style="width:20px; height:20px !important;" alt=""></p>
                            </div>
                            <div class="col-sm-10">
                                <p>0811-1-500-599</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <p  class="bold">Kontak Center ACC</p>
                        <div class="row">
                            <div class="col-sm-1">
                                <p><img src="{{ asset('assets/Pictures/Picture7.jpg') }}" style="width:20px; height:20px !important;" alt=""></p>
                            </div>
                            <div class="col-sm-10">
                                <p>1500599</p>
                            </div>
                        </div>
                    </div>
                </div><br>
                <p>This email is intended solely for the recipient specified in the message. This system-generate email,<strong> Please do not reply</strong>.</p>
                <a class="center" href="#"><img src="{{ asset('assets/Pictures/Picture5.png') }}" alt="" ></a><br>
            </div>
        </div>
    </body>
    </html> --}}

    <!DOCTYPE html>
<html>
<head>
    <style>
        @import url('https://fonts.googleapis.com/css?family=Source+Sans+Pro&display=swap');
        
        p,h3{
          font-family: 'Source Sans Pro', sans-serif;
        }
      </style>  
    <title>Kamu Mendapatkan Plafon Kredit dari ACC!</title>
</head>
    
<body>
    <div  style=" width:800px; border-radius: 25px; border:1px solid;  border-spacing: 0px; color: #081e33; margin: 0 auto;">
        <div style="height:115px; border-top-left-radius :25px;border-top-right-radius :25px; background:#081e33;">
        <br><img src="{{ asset('assets/Pictures/logo_acccash_text.png') }}" style="width:250px; height:75px !important; display: block; margin-left: auto; margin-right: auto;" alt="" ><br><br>
        </div>
        <div style="margin:20px">
            <h3>Hai, {{ $data_mail["NAME"] }}</h3>
            <div style="text-align:center;">
                <img src="{{ asset('assets/Pictures/Ilustrasi_acccash-02.jpg') }}" style="height:300px; "alt=""><br><br>
            </div>
            <p>Selamat!</p>
            <p>Kamu mendapatkan plafon sebesar {{$data_mail["PLAFOND"]}} yang dapat kamu cairkan melalui
                aplikasi acc.one.<br>
                Yuk download aplikasinya sekarang dan lihat plafon Kamu.</p>
         
            <a href="https://www.acc.co.id/acccash"><img src="{{ asset('assets/Pictures/Picture2.png')}}" style="width:200px; height:25px !important; display: block; margin:0 auto;"></a>    
          <div style="display:block; margin: 10px 0; text-align:center; position:relative;">
            <a style="margin :5px;" href="https://play.google.com/store/apps/details?id=com.outsystemsenterprise.prod8.ACCOne"><img src="{{ asset('assets/Pictures/downloadplaystore.png') }}" style="width:120px; height:50px;"></a>
            <a style="margin :5px;" href="https://apps.apple.com/us/app/acc-one/id1453382506"><img src="{{ asset('assets/Pictures/downloadappstore.png') }}" style="width:120px; height:50px;"></a>  
          </div>
        </div>
            <a href="#"><img src="{{asset('assets/Pictures/Picture5.png')}}" alt="" style="width:800px; display:block; border-bottom-left-radius :25px;border-bottom-right-radius :25px; position:relative; " ></a>
    </div>
</body>
</html>