<style>
    @import url(https://fonts.googleapis.com/css?family=Raleway:700);

*, *:before, *:after {
  box-sizing: border-box;
}
html {
    height: 100%;
}
body {
    font-family: 'Raleway', sans-serif;
    background-color: #342643;
    height: 100%;
    padding: 10px;
}

a {
  color: #EE4B5E !important;
  text-decoration:none;
}
a:hover {
  color: #FFFFFF !important;
  text-decoration:none;
}

.text-wrapper {
    height: 100%;
   display: flex;
   flex-direction: column;
   align-items: center;
   justify-content: center;
}

.title {
    font-size: 5em;
    font-weight: 700;
    color: #EE4B5E;
}

.subtitle {
    font-size: 40px;
    font-weight: 700;
    color: #1FA9D6;
}
.isi {
    font-size: 18px;
    text-align: center;
    margin:30px;
    padding:20px;
    color: white;
}
.buttons {
    margin: 30px;
        font-weight: 700;
        border: 2px solid #EE4B5E;
        text-decoration: none;
        padding: 15px;
        text-transform: uppercase;
        color: #EE4B5E;
        border-radius: 26px;
        transition: all 0.2s ease-in-out;
        display: inline-block;

        .buttons:hover {
            background-color: #EE4B5E;
            color: white;
            transition: all 0.2s ease-in-out;
        }
  }
}

</style>
<div class="text-wrapper">
    <div class="title" data-content="404">
        403 - ACCESS DENIED
    </div>

    <div class="subtitle">
        Maaf Akun Anda Telah di Banned
    </div>
    <div class="isi">
        Akun anda dibanned karena anda telah melanggar aturan website kami, untuk info lebih lanjut silahkan hubungi <a href="">administrator</a>!
         </div>

         <a class="btn btn-primary" href="{{ route('logout') }}"
                   onclick="event.preventDefault();
                                 document.getElementById('logout-form').submit();">
                    <div class="buttons">
                        Kembali
                    </div>
                </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>

</div>
