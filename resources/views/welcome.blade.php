@extends('layouts.guest')

@section('main-content')
    <div class="row">
        <div class="col">
                    <section>
                        <h1 class="text-center title" style="color: #383E5E">MERIDIANO</h1>
                        <h3 class="text-center mb-4 subtitle" style="color: #383E5E">Porta i tuoi sogni in viaggio</h3>
                    </section>

                    
                    <section class="row">
                        <div class="col d-flex justify-content-center align-items-center">
                            <h3 class="text-center mb-4 subtitle" style="color: #383E5E">Viaggia facile, viaggia smart</h3>
                        </div>
                        {{-- EARTH --}}
                        <div class="col">
                            <section class="earth">
                                <div class="section-banner">
                                    <div id="star-1">
                                      <div class="curved-corner-star">
                                        <div id="curved-corner-bottomright"></div>
                                        <div id="curved-corner-bottomleft"></div>
                                      </div>
                                      <div class="curved-corner-star">
                                        <div id="curved-corner-topright"></div>
                                        <div id="curved-corner-topleft"></div>
                                      </div>
                                    </div>
                                  
                                    <div id="star-2">
                                      <div class="curved-corner-star">
                                        <div id="curved-corner-bottomright"></div>
                                        <div id="curved-corner-bottomleft"></div>
                                      </div>
                                      <div class="curved-corner-star">
                                        <div id="curved-corner-topright"></div>
                                        <div id="curved-corner-topleft"></div>
                                      </div>
                                    </div>
                                  
                                    <div id="star-3">
                                      <div class="curved-corner-star">
                                        <div id="curved-corner-bottomright"></div>
                                        <div id="curved-corner-bottomleft"></div>
                                      </div>
                                      <div class="curved-corner-star">
                                        <div id="curved-corner-topright"></div>
                                        <div id="curved-corner-topleft"></div>
                                      </div>
                                    </div>
                                  
                                    <div id="star-4">
                                      <div class="curved-corner-star">
                                        <div id="curved-corner-bottomright"></div>
                                        <div id="curved-corner-bottomleft"></div>
                                      </div>
                                      <div class="curved-corner-star">
                                        <div id="curved-corner-topright"></div>
                                        <div id="curved-corner-topleft"></div>
                                      </div>
                                    </div>
                                  
                                    <div id="star-5">
                                      <div class="curved-corner-star">
                                        <div id="curved-corner-bottomright"></div>
                                        <div id="curved-corner-bottomleft"></div>
                                      </div>
                                      <div class="curved-corner-star">
                                        <div id="curved-corner-topright"></div>
                                        <div id="curved-corner-topleft"></div>
                                      </div>
                                    </div>
                                  
                                    <div id="star-6">
                                      <div class="curved-corner-star">
                                        <div id="curved-corner-bottomright"></div>
                                        <div id="curved-corner-bottomleft"></div>
                                      </div>
                                      <div class="curved-corner-star">
                                        <div id="curved-corner-topright"></div>
                                        <div id="curved-corner-topleft"></div>
                                      </div>
                                    </div>
                                  
                                    <div id="star-7">
                                      <div class="curved-corner-star">
                                        <div id="curved-corner-bottomright"></div>
                                        <div id="curved-corner-bottomleft"></div>
                                      </div>
                                      <div class="curved-corner-star">
                                        <div id="curved-corner-topright"></div>
                                        <div id="curved-corner-topleft"></div>
                                      </div>
                                    </div>
                                </div>   
                                
                            </section> 
                        </div>
                        <div class="col d-flex justify-content-center align-items-center">
                            <h3 class="text-center mb-4 subtitle" style="color: #383E5E">Esplora oltre i confini</h3>
                        </div>
                    </section>               

                    <h3 class="text-center mb-4 subtitle" style="color: #383E5E">La tua prossima avventura inizia qui</h3>

                    <div class="row">
                        <div class="col d-flex justify-content-center gap-2">
                            <a class="btn btn-1 fs-4" href="{{ route('login') }}">Accedi</a>
                            <a class="btn btn-1 fs-4" href="{{ route('register') }}">Registrati</a>
                        </div>
                    </div>
            
        </div>
    </div>
@endsection

<style lang="scss" scoped>

.title {        
    font-size: 70px;
    letter-spacing: 20px;
    text-shadow: 0px 3px 3px rgb(0, 0, 0);
}

.subtitle {
    text-decoration: underline rgb(255, 187, 0);
}

/* EARTH */

.earth {
    display: flex;
    justify-content: center;
    margin: 80px 0;
}

.section-banner {
  height: 170px;
  width: 170px;
  position: relative;
  transition: left 0.3s linear;
  background: url("data:image/jpeg;base64,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");
  background-size: cover;
  background-position: left;
  bottom: 0px;
  border-radius: 50%;
  animation: earthRotate 30s linear 0s infinite;
  box-shadow: 0px 0 20px RGBA(255, 255, 255, 0.2), -5px 0px 8px #c3f4ff inset,
    15px 2px 25px #000 inset, -24px -2px 34px #c3f4ff99 inset,
    250px 0px 44px #00000066 inset, 150px 0px 38px #000000aa inset;
}
@keyframes earthRotate {
  0% {
    background-position: 0 0;
  }
  100% {
    background-position: 400px 0;
  }
}

.curved-corner-star {
  display: flex;
  position: relative;
}

#curved-corner-bottomleft,
#curved-corner-bottomright,
#curved-corner-topleft,
#curved-corner-topright {
  width: 4px;
  height: 5px;
  overflow: hidden;
  position: relative;
}

#curved-corner-bottomleft:before,
#curved-corner-bottomright:before,
#curved-corner-topleft:before,
#curved-corner-topright:before {
  content: "";
  display: block;
  width: 200%;
  height: 200%;
  position: absolute;
  border-radius: 50%;
}

#curved-corner-bottomleft:before {
  bottom: 0;
  left: 0;
  box-shadow: -5px 5px 0 0 white;
}

#curved-corner-bottomright:before {
  bottom: 0;
  right: 0;
  box-shadow: 5px 5px 0 0 white;
}

#curved-corner-topleft:before {
  top: 0;
  left: 0;
  box-shadow: -5px -5px 0 0 white;
}

#curved-corner-topright:before {
  top: 0;
  right: 0;
  box-shadow: 5px -5px 0 0 white;
}

@keyframes twinkling {
  0%,
  100% {
    opacity: 0.1;
  }
  50% {
    opacity: 1;
  }
}

#star-1 {
  position: absolute;
  left: -20px;
  animation: twinkling 3s infinite;
}

#star-2 {
  position: absolute;
  left: -40px;
  top: 30px;
  animation: twinkling 2s infinite;
}
#star-3 {
  position: absolute;
  left: 300px;
  top: 90px;
  animation: twinkling 4s infinite;
}
#star-4 {
  position: absolute;
  left: 200px;
  top: 200px;
  animation: twinkling 3s infinite;
}
#star-5 {
  position: absolute;
  left: 50px;
  top: 220px;
  animation: twinkling 1.5s infinite;
}

#star-6 {
  position: absolute;
  left: 250px;
  top: -50px;
  animation: twinkling 4s infinite;
}
#star-7 {
  position: absolute;
  left: 290px;
  top: 60px;
  animation: twinkling 2s infinite;
}


</style>