@extends('layouts.app')
@section('content')
<div class="container">
    <!-- this function of java Script play Camera -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/html5-qrcode/2.3.8/html5-qrcode.min.js"></script>
<!-- Header --> 
<div class="container-fluid header_se" align="center" style="background-color:white">
 <div class="col-md-8">
  <div class="row">
   <div class="col">
    <div id="reader" ></div>
   </div>
   
  <div >
    <h3>Result</h3>
    <br><br>
  @if (Auth::check()) <div class="text-center"> 
        <img src="{{ Storage::url(Auth::user()->profile_image) }}" alt="Profile Image" width="150" class="w-24 h-24 rounded-circle mx-auto object-cover shadow-lg"> 
    </div> <div class="text-center space-y-2"> <p class="text-lg font-semibold">{{ Auth::user()->name }}</p>
     <p class="text-sm">{{ Auth::user()->jobTitle }}</p> 
     <p class="text-sm">{{ Auth::user()->campus }}</p>
      <p class="text-sm">{{ Auth::user()->department }}</p> </div> 
      <script>setTimeout(() => location.reload(), 5000);</script>

      @endif
  </div>
   
    
   
  </div>
 <script type="text/javascript">
     // after success to play camera Webcam Ajax paly to send data to Controller
  function onScanSuccess(data) {
    $.ajax({
      type: "POST",
      cache: false,
      url : "{{action('App\Http\Controllers\QrLoginController@checkUser')}}",
      data: {"_token": "{{ csrf_token() }}",data:data},
      success: function(data) {
        location.reload();
       if (data==1) {
        document.getElementById('result').innerHTML = '<span class="result">'+'Logged'+'</span>';
        location.reload();
      
            }
       else{
        location.reload();
       
        return confirm('There is no user with this qr code');
     
       }
      }
    })
  }
  var html5QrcodeScanner = new Html5QrcodeScanner(
    "reader", { fps: 10, qrbox: 250 });
  html5QrcodeScanner.render(onScanSuccess);
 </script>
 </div>
 </div>
</div>
<hr/>


<script type="text/javascript">
  $.ajaxSetup({
  headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
   }
  });
</script>
<style>
  body, html {
    height: 100%;
    margin-left: 100;
    padding: 0;
align: center;
}
        .result {
            background-color: green;
            color: #fff;
            padding: 20px;
        }
        .row {
            display: flex;
        }
        #reader {
            background: black;
            width: 500px;
            align: center;
         
s

        }
        button, a#reader__dashboard_section_swaplink {
            background-color: #4CAF50; /* Green */
            color: white;
            padding: 10px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: 4px 2px;
            cursor: pointer;
            border-radius: 6px;
        }
        span a {
            display: none;
        }
        #reader__camera_selection {
            background: blueviolet;
            color: aliceblue;
        }
        #reader__dashboard_section_csr span {
            color: red;
        }
    </style>
@yield('scripts')
@endsection