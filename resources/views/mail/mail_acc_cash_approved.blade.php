{{-- <!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
   
    <title>Aplikasi acccash {{$data_mail["NO_AGGR"]}} Approved</title>
</head>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    
<style>
  .center {
    display: block;
    margin-left: auto;
    margin-right: auto;
  }
  .bold{
  font-weight: bold;
  }
  .tengah {
    display: flex;
    justify-content: center;
  }
  .tengah a{
       margin : 5px;
  }

</style>

<body>
    <div class="center panel panel-default" style=" width:800px; border-radius: 25px; border: 2px solid">
        <div class="panel-header" style="height:115px; background:#081e33;">
        <br><img src="{{ asset('assets/Pictures/logo_acccash_text.png') }}" style="width:300px; height:75px !important; display: block; margin-left: auto; margin-right: auto;" alt="" ><br><br>
        </div>
        <div class="panel-body">

            <h3>Hai, {{ $data_mail["NAME"] }}</h3>
            <p>Selamat!</p>
            <p>Pengajuan Kamu saat ini Approve dan akan dilanjutkan ke proses selanjutnya.<br>
                Tim kami dari Cabang ACC {{ $data_mail["CABANG"] }} akan menghubungi Kamu untuk tanda
                tangan kontrak.<br>
                Terima kasih telah melakukan pengajuan melalui acc.one!<br>
                Kami tunggu pengajuan Kamu selanjutnya.</p>

          <a class="center" href="https://www.acc.co.id/acccash"><img src="{{ asset('assets/Pictures/Picture2.png') }}" style="width:210px; height:30px !important; display: block; margin-left: auto; margin-right: auto;" alt="" class="center"></a>    
          <div class="tengah">
          <a href="https://play.google.com/store/apps/details?id=com.outsystemsenterprise.prod8.ACCOne"><img src="{{ asset('assets/Pictures/downloadplaystore.png') }}" style="width:120px; height:50px; display: block; margin-left: auto; margin-right: auto;" alt=""></a>
          <a href="https://apps.apple.com/us/app/acc-one/id1453382506"><img src="{{ asset('assets/Pictures/downloadappstore.png  ') }}" style="width:120px; height:50px; display: block; margin-left: auto; margin-right: auto; " alt="" ></a>  
          </div>
          
        </div>
        <div class="panel-footer"> 
            <h4 class="bold">Punya Pertanyaan? Kamu Dapat Hubungi </h4><br>
            <div class="row">
                <div class="col-sm-3">
                    <p class="bold">Whatsapp Yuna</p>
                    <div class="row">
                      <div class="col-sm-1">
                        <p><img src="{{ asset('assets/Pictures/Picture6.png') }}" style="width:20px; height:20px !important;" alt=""></p>
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
                      	<p><img src="{{ asset('assets/Pictures/Picture7.png') }}" style="width:20px; height:20px !important;" alt=""></p>
                      </div>
                      <div class="col-sm-10">
   	                    <p>1500599</p>
                      </div>
                    </div>
                </div>
            </div><br>
            <p>This email is intended solely for the recipient specified in the message. This system-generate email,<strong> Please do not reply</strong>.</p>
            <a href="#"><img src="{{ asset('assets/Pictures/Picture5.png') }}" alt="" style="width:800px; display: block; margin-left: auto; margin-right: auto;" ></a><br>
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
	font-size: 16px;
    }
  </style>  
    <title>Aplikasi acccash {{$data_mail["NO_AGGR"]}} Approved</title>
</head>
    
<body>
    <div  style=" width:800px; border-radius: 25px; border:1px solid;  border-spacing: 0px; color: #081e33; margin: 0 auto;">
        <div style="height:115px; border-top-left-radius :25px;border-top-right-radius :25px; background:#081e33;">
        <br><img src="{{ asset('assets/Pictures/logo_acccash_text.png') }}" style="width:300px; height:75px !important; display: block; margin-left: auto; margin-right: auto;" alt="" ><br><br>
        </div>
        <div style="margin:20px">
            <h3>Hai, {{ $data_mail["NAME"] }}</h3>
            <p>Selamat!</p>
            <p>Pengajuan Kamu saat ini Approve dan akan dilanjutkan ke proses selanjutnya.<br>
                Tim kami dari Cabang ACC {{ $data_mail["CABANG"] }} akan menghubungi Kamu untuk tanda
                tangan kontrak.<br>
                Terima kasih telah melakukan pengajuan melalui acc.one!<br>
                Kami tunggu pengajuan Kamu selanjutnya.</p>

            <a href="https://www.acc.co.id/acccash"><img src="{{ asset('assets/Pictures/Picture2.png')}}" style="width:210px; height:30px !important; display: block; margin:0 auto;"></a>    
          <div style="display:block; margin: 10px 0; text-align:center; position:relative;">
            <a style="margin :5px;" href="https://play.google.com/store/apps/details?id=com.outsystemsenterprise.prod8.ACCOne"><img src="{{ asset('assets/Pictures/downloadplaystore.png') }}" style="width:120px; height:50px;"></a>
            <a style="margin :5px;" href="https://apps.apple.com/us/app/acc-one/id1453382506"><img src="{{ asset('assets/Pictures/downloadappstore.png') }}" style="width:120px; height:50px;"></a>  
          </div>
        </div>
            {{-- <a href="#"><img src="{{asset('assets/Pictures/Picture5.png')}}" alt="" style="width:800px; display:block; border-bottom-left-radius :25px;border-bottom-right-radius :25px; position:relative; " ></a> --}}
        <div style="height:250px; border-bottom-left-radius :25px;border-bottom-right-radius :25px; background:#e9e9f2; ">
        
          <h3 style=" padding:10px;"><strong>Punya Pertanyaan? Kamu Dapat Hubungi</strong></h3>
          <table style="padding:10px">
            <tr>
              <th  style=" padding:5px"> Whatsapp Yuna</th>
              <th  style=" padding:5px"> Kontak Center ACC</th>
            </tr>
            <tr>
              <td><img src="{{ asset('assets/Pictures/Picture6.png')}}" style="width:20px; height:20px !important;margin-right:5px" alt=""> 0811-1-500-599</td>
              <td><img src="{{ asset('assets/Pictures/Picture7.png')}}" style="width:20px; height:20px !important;margin-right:5px" alt=""> 1500599</td>
            </tr>
          </table>
          <p  style="padding:10px">This email is intended solely for the recipient specified in the message. This system-generate email,<strong> Please do not reply</strong>.<br></p>
        </div>
    </div>
</body>
</html>