<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Alfakes Indonesia - Login</title>

  <!-- favicon -->
  <link rel="icon" type="image/x-icon" href="{{asset('favicon.png')}}">

  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

  <style>
    body {
        color: #000;
        overflow-x: hidden;
        height: 100%;
        background-color: #B0BEC5;
        background-repeat: no-repeat;
    }

    .card0 {
        box-shadow: 0px 4px 8px 0px #757575;
        border-radius: 0px;
    }

    .card2 {
        margin: 0px 40px;
    }

    .logo {
        width: 200px;
        height: auto;
        margin-top: 20px;
        margin-left: 35px;
    }

    .image {
        width: 360px;
        height: 280px;
    }

    .border-line {
        border-right: 1px solid #EEEEEE;
    }

    .facebook {
        background-color: #3b5998;
        color: #fff;
        font-size: 18px;
        padding-top: 5px;
        border-radius: 50%;
        width: 35px;
        height: 35px;
        cursor: pointer;
    }

    .twitter {
        background-color: #1DA1F2;
        color: #fff;
        font-size: 18px;
        padding-top: 5px;
        border-radius: 50%;
        width: 35px;
        height: 35px;
        cursor: pointer;
    }

    .linkedin {
        background-color: #2867B2;
        color: #fff;
        font-size: 18px;
        padding-top: 5px;
        border-radius: 50%;
        width: 35px;
        height: 35px;
        cursor: pointer;
    }

    .line {
        height: 1px;
        width: 45%;
        background-color: #E0E0E0;
        margin-top: 10px;
    }

    .or {
        width: 10%;
        font-weight: bold;
    }

    .text-sm {
        font-size: 14px !important;
    }

    ::placeholder {
        color: #BDBDBD;
        opacity: 1;
        font-weight: 300
    }

    :-ms-input-placeholder {
        color: #BDBDBD;
        font-weight: 300
    }

    ::-ms-input-placeholder {
        color: #BDBDBD;
        font-weight: 300
    }

    input, textarea {
        padding: 10px 12px 10px 12px;
        border: 1px solid lightgrey;
        border-radius: 2px;
        margin-bottom: 5px;
        margin-top: 2px;
        width: 100%;
        box-sizing: border-box;
        color: #2C3E50;
        font-size: 14px;
        letter-spacing: 1px;
    }

    input:focus, textarea:focus {
        -moz-box-shadow: none !important;
        -webkit-box-shadow: none !important;
        box-shadow: none !important;
        border: 1px solid #2f8aea;
        outline-width: 0;
    }

    button:focus {
        -moz-box-shadow: none !important;
        -webkit-box-shadow: none !important;
        box-shadow: none !important;
        outline-width: 0;
    }

    a {
        color: inherit;
        cursor: pointer;
    }

    .btn-blue {
        background-color: #2f8aea;
        width: 150px;
        color: #fff;
        border-radius: 2px;
    }

    .btn-blue:hover {
        background-color: #2867B2;
        cursor: pointer;
        color: #fff;
    }

    .bg-blue {
        color: #fff;
        background-color: #2f8aea;
    }

    @media screen and (max-width: 991px) {
        .logo {
            text-align: center;
        }

        .image {
            width: 300px;
            height: 220px;
        }

        .border-line {
            border-right: none;
        }

        .card2 {
            border-top: 1px solid #EEEEEE !important;
            margin: 0px 15px;
        }
    }
  </style>

</head>

<body>
  <div class="container-fluid px-1 px-md-5 px-lg-1 px-xl-5 py-5 mx-auto">
      <div class="card card0 border-0">
          <div class="row d-flex">
              <div class="col-lg-6">
                  <div class="card1 pb-5">
                      <div class="row">
                          <img src="{{ asset('/assets/frontend/img/logo_alfakes.png') }}" alt="Alfakes Indonesia" class="logo">
                      </div>
                      <div class="row px-3 justify-content-center mt-4 mb-5 border-line">
                          <img src="{{ asset('/assets/img/img-ad.png') }}" alt="Alfakes Indonesia" class="image">
                      </div>
                  </div>
              </div>
              <div class="col-lg-6">
                <form action="{{route('action.login')}}" method="post">
                  @csrf
                  
                  <div class="card2 card border-0 px-4 py-5">
                      <div class="row mb-4 px-3">
                          <h2 class="mb-0 mr-4 mt-2">Alfakes Indonesia</h2>
                          @if(session()->has('message'))
                            <div class="alert alert-danger mt-2">
                              {{ session()->get('message') }}
                            </div>
                          @endif
                      </div>
                      <div class="row px-3 mb-4">
                          <div class="line"></div>
                          <div class="line"></div>
                      </div>
                      <div class="row px-3">
                          <label class="mb-1"><h6 class="mb-0 text-sm">Email</h6></label>
                          <input class="mb-4" type="text" placeholder="Email" name="email" required>
                      </div>
                      <div class="row px-3">
                          <label class="mb-1"><h6 class="mb-0 text-sm">Password</h6></label>
                          <input class="form-password" type="password" name="password" placeholder="Enter password" required>
                      </div>
                      <div class="row px-3 mb-4">
                          <div class="custom-control custom-checkbox custom-control-inline">
                              <input id="chk1" type="checkbox" name="chk" class="custom-control-input form-checkbox"> 
                              <label for="chk1" class="custom-control-label text-sm">Show Password</label>
                          </div>
                      </div>
                      <div class="row mb-3 px-3">
                          <button type="submit" class="btn btn-blue text-center">Login</button>
                      </div>
                  </div>
                </form>
              </div>
          </div>
          <div class="bg-blue py-4">
              <div class="row px-3">
                  <small class="ml-4 ml-sm-5 mb-2">&copy; Copyright {{date('Y')}} | All Rights Reserved by <a href="{{ route('home.index') }}" target="_blank">Alfakes Indonesia</a></small>
              </div>
          </div>
      </div>
  </div>
  
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

  <script type="text/javascript">
    $(document).ready(function(){		
      $('.form-checkbox').click(function(){
        if($(this).is(':checked')){
          $('.form-password').attr('type','text');
        } else {
          $('.form-password').attr('type','password');
        }
      });
    });
  </script>
</body>
</html>