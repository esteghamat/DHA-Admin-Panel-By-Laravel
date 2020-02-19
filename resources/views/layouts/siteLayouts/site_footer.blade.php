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
                    <div class="fs-sm"><a style="text-decoration: none; color: whitesmoke;"
                            href="https://api.whatsapp.com/send?phone={{$whatsapp_link}}&text=Merhaba"> <i
                                class="fab fa-whatsapp"></i>{{isset($footer->whatsapp) ? $footer->whatsapp : '0533 613 1073666'}}</a></div>
                    <div class="fs-sm"><a style="text-decoration: none; color: whitesmoke;" href="tel:+90216327048"><i
                                class="fas fa-phone-alt"></i>{{isset($footer->phone) ? $footer->phone : '0216 32 70 48'}}</a></div>
                    <div class="fs-sm"><a style="text-decoration: none; color: whitesmoke;"
                            href="mailto:{{isset($footer->email) ? $footer->email : 'info@digitalhealtagency.com'}}"><i class="far fa-envelope"></i>
                            {{isset($footer->email) ? $footer->email : 'info@digitalhealtagency.com'}}</a></div>
                </div>
                <div class="footer-top-right">
                    <a href=""><img src="{{ asset(config('constants.frontend_address').'/dha-images/Vector Smart Object copy 5.png') }}" alt=""></a>
                </div>
            </div>
            <hr>
            <div class="footer-bottom">
                <div class="footer-bottom-left footer-bottom-items">
                    <div><i class="fas fa-map-marker-alt"></i></div>
                    <div>
                        <p class="fs-sm">
                          <?php
                            if(isset($footer->address)) 
                              { 
                                echo(nl2br($footer->address));
                              }  
                            else 
                              { 
                          ?>
                          Kosuyolu Mahallesi Ali Nazime Sk. <br>
                              No 5/A Kadıkoy/İstanbul
                          <?php } ?>    
                        </p>
                    </div>
                </div>
                <div class="footer-bottom-middle footer-bottom-items">
                    <div>
                        <h5>Sosyal Medyada Biz;</h5>
                    </div>
                    <div class="footer-icons">
                        <a href="{{isset($footer->facebook) ? $footer->facebook : ''}}"><i class="fab fa-facebook-f"></i></a>
                        <a href="{{isset($footer->twitter) ? $footer->twitter : ''}}"><i class="fab fa-twitter"></i></a>
                        <a href="{{isset($footer->instagram) ? $footer->instagram : ''}}"><i class="fab fa-instagram"></i></a>
                        <a href="{{isset($footer->linkedin) ? $footer->linkedin : ''}}"><i class="fab fa-linkedin-in"></i></a>
                        <a href="{{isset($footer->pinterest) ? $footer->pinterest : ''}}"><i class="fab fa-pinterest"></i></a>
                    </div>
                </div>
                <div class="footer-bottom-right footer-bottom-items">
                    <div class="foot-item1">
                        <p class="fs-xs">2020 © FikirBuzz Agency Tum Hakları Saklıdır.</p>
                    </div>
                    <div class="foot-item2 fs-sm">
                        <li><a href="{{isset($footer->kvkk_link) ? $footer->kvkk_link : ''}}">{{isset($footer->kvkk_title) ? $footer->kvkk_title : 'KVKK'}}</a></li>
                        <li><a href="{{isset($footer->isortaklari_link) ? $footer->isortaklari_link : ''}}">{{isset($footer->isortaklari_title) ? $footer->isortaklari_title : 'İs ortakları'}}</a></li>
                        <li><a href="{{isset($footer->partnerler_link) ? $footer->partnerler_link : ''}}">{{isset($footer->partnerler_title) ? $footer->partnerler_title : 'Partnerler'}}</a></li>
                        <li><a href="{{isset($footer->kariyer_link) ? $footer->kariyer_link : ''}}">{{isset($footer->kariyer_title) ? $footer->kariyer_title : 'Kariyer'}}</a></li>
                    </div>
                    <div class="foot-item3"><img src="{{ asset(config('constants.frontend_address').'/dha-images/Vector Smart Object2.png') }}" alt=""></div>
                </div>
            </div>
        </footer>
