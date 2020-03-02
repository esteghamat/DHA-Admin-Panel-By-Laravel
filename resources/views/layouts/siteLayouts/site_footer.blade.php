<footer class="footer">
            <div class="footer-top">
                <div class="footer-top-left">
                    <?php
                      $whatsapp_link = '';
                      if(isset($footer->whatsapp)) 
                        { 
                          $whatsapp_link = $footer->whatsapp; 
                          $str1 = substr($whatsapp_link, 0 , 1); 
                          if($str1 == '0')
                          {
                            $whatsapp_link = ltrim($whatsapp_link,'0');
                          }  
                          $whatsapp_link = '90' . str_replace(" ","",$whatsapp_link);
                        }  
                      else 
                        { $whatsapp_link = '905336131073'; } 
                    ?>
                    <div class="fs-sm"><a style="text-decoration: none; color: whitesmoke;font-size: 16px;font-weight: 300;"
                            href="https://api.whatsapp.com/send?phone={{$whatsapp_link}}&text=Merhaba hizmet kalemleriniz ile ilgili bilgi almak istiyorum"> <i
                                class="fab fa-whatsapp"></i>{{isset($footer->whatsapp) ? $footer->whatsapp : '0533 613 1073666'}}</a></div>
                    <div class="fs-sm"><a style="text-decoration: none; color: whitesmoke;font-size: 16px;font-weight: 300;" href="tel:+902164281734"><i
                                class="fas fa-phone-alt"></i>{{isset($footer->phone) ? $footer->phone : '0216 32 70 48'}}</a></div>
                    <div class="fs-sm"><a style="text-decoration: none; color: whitesmoke;font-size: 16px;font-weight: 300;"
                            href="mailto:{{isset($footer->email) ? $footer->email : 'randevu@digitalhealthagency.com.tr'}}"><i class="far fa-envelope"></i>
                            {{isset($footer->email) ? $footer->email : 'info@digitalhealtagency.com'}}</a></div>
                    <div class="fs-sm"><a style="text-decoration: none; color: whitesmoke;font-size: 16px;font-weight: 300;"
                            href="https://www.google.com/maps/place/Fikirbuzz+Dijital+Pazarlama+ve+Reklam+Ajans%C4%B1/@41.008436,29.0365863,17z/data=!3m1!4b1!4m5!3m4!1s0x14cab81cc322d813:0x3a32083fb958bfc6!8m2!3d41.008432!4d29.038775"><i class="fas fa-map-marker-alt"></i>
                              kroki için tıklayın</a></div>

                </div>
                <div class="footer-top-right">
                   <div class="footer-bottom-middle footer-bottom-items" style="margin-right: 40px;">
                    <div>
                        <h5 style="font-weight: 300;">Sosyal Medya</h5>
                    </div>
                    <div class="footer-icons" >
                      <a href="{{isset($footer->instagram) ? $footer->instagram : ''}}"><i class="fab fa-instagram"></i></a>
                      <a href="{{isset($footer->linkedin) ? $footer->linkedin : ''}}"><i class="fab fa-linkedin-in"></i></a>
                        <a href="{{isset($footer->facebook) ? $footer->facebook : ''}}"><i class="fab fa-facebook-f"></i></a>
                         <a href="{{isset($footer->facebook) ? $footer->facebook : ''}}"><i class="fab fa-twitter"></i></a>
                        
                        
                        
                    </div>
                </div>
                </div>
            </div>
            <hr>
            <div class="footer-bottom">
                 <nav class="navigation" style="margin-top: 0px!important;">
           
            <div class="nav-links foot-link">
                <ul>
                    <li><a href="{{ url('/') }}">ANASAYFA</a></li>
                    <li><a href="{{ url('biz-kimiz') }}">BİZ KİMİZ</a></li>
                    <li><a href="{{ url('dijital-recetemiz') }}">DİJİTAL HİZMETLER</a></li>
                    <li><a href="{{ url('references') }}">TEDAVİ ETTİKLERİMİZ</a></li>
                    <li><a href="{{ url('islerimiz') }}">İŞ ÖRNEKLERİ</a></li>
                    <li><a href="{{ url('blog') }}">BLOG</a></li>
                    <li ><a href="{{ url('contact') }}" class="bordered"><i class="fas fa-stethoscope" style="font-size: 16px;"></i>  RANDEVU</a></li>
                </ul>    
             </div>
        </nav>
               <a href="https://fikirbuzz.com" style="text-align: center;"><img style="width: 30px;margin:auto!important;" src="{{ asset(Config::get('constants.frontend_address').'/dha-images/fikirbuzz.png') }}" alt="">
            </div>
        </footer>
