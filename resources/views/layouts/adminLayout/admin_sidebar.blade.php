        <!-- ============================================================== -->
        <!-- Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <aside class="left-sidebar" data-sidebarbg="skin5">
          <!-- Sidebar scroll-->
          <div class="scroll-sidebar">
              <!-- Sidebar navigation-->
              <nav class="sidebar-nav">
                  <ul id="sidebarnav" class="p-t-30">
                      <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ url('admin') }}" aria-expanded="false" id="sidebar_menu_dashboard"><i class="mdi mdi-view-dashboard"></i><span class="hide-menu">Dashboard</span></a></li>

                      <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ url('marka') }}" aria-expanded="false" id="sidebar_menu_makra"><i class="mdi mdi-chart-bar"></i><span class="hide-menu">Markalar</span></a></li>
                      <!-- <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ url('category') }}" aria-expanded="false"><i class="mdi mdi-chart-bubble"></i><span class="hide-menu">Kategoriler</span></a></li> -->
                      <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ url('admin/filter') }}" aria-expanded="false" id="sidebar_menu_filter"><i class="mdi mdi-chart-bubble"></i><span class="hide-menu">Filterler</span></a></li>
                      <!-- <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ url('portfolio') }}" aria-expanded="false" id="sidebar_menu_portfolio"><i class="mdi mdi-border-inside"></i><span class="hide-menu">İşlerimiz</span></a></li> -->
                      <!-- <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ url('admin/index_gallery') }}" aria-expanded="false" id="sidebar_menu_gallery"><i class="mdi mdi-blur-linear"></i><span class="hide-menu">Galeriler</span></a></li> -->
                      <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ url('contenthead') }}" aria-expanded="false" id="sidebar_menu_contenthead"><i class="mdi mdi-relative-scale"></i><span class="hide-menu">Site ana içerikleri</span></a></li>
                      <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ url('contentitem') }}" aria-expanded="false" id="sidebar_menu_contentitem"><i class="mdi mdi-view-list"></i><span class="hide-menu">Site öğeleri içeriği</span></a></li>

                      <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="fas fa-cog"></i><span class="hide-menu">Sistem ayarları </span></a>
                          <ul aria-expanded="false" class="collapse  first-level">
                              <li class="sidebar-item"><a href="{{ url('admin/contenttype') }}" class="sidebar-link"><i class="mdi mdi-bulletin-board"></i><span class="hide-menu">İçerik türü</span></a></li>
                              <li class="sidebar-item"><a href="{{ url('admin/configtype') }}"  class="sidebar-link"><i class="fas fa-qrcode"></i><span class="hide-menu"> Ayar türleri </span></a></li>
                              <li class="sidebar-item"><a href="{{ url('admin/config') }}"      class="sidebar-link"><i class="fas fa-qrcode"></i><span class="hide-menu"> Ayarlar </span></a></li>
                          </ul>
                      </li>

                      <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ url('admin/footer') }}" aria-expanded="false" id="sidebar_menu_contentitem"><i class="mdi mdi-view-list"></i><span class="hide-menu">Sayfa altbilgisi</span></a></li>

                      <!-- <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="pages-buttons.html" aria-expanded="false"><i class="mdi mdi-relative-scale"></i><span class="hide-menu">Buttons</span></a></li>
                      <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-face"></i><span class="hide-menu">Icons </span></a>
                          <ul aria-expanded="false" class="collapse  first-level">
                              <li class="sidebar-item"><a href="icon-material.html" class="sidebar-link"><i class="mdi mdi-emoticon"></i><span class="hide-menu"> Material Icons </span></a></li>
                              <li class="sidebar-item"><a href="icon-fontawesome.html" class="sidebar-link"><i class="mdi mdi-emoticon-cool"></i><span class="hide-menu"> Font Awesome Icons </span></a></li>
                          </ul>
                      </li>
                      <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="pages-elements.html" aria-expanded="false"><i class="mdi mdi-pencil"></i><span class="hide-menu">Elements</span></a></li>
                      <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-move-resize-variant"></i><span class="hide-menu">Addons </span></a>
                          <ul aria-expanded="false" class="collapse  first-level">
                              <li class="sidebar-item"><a href="index2.html" class="sidebar-link"><i class="mdi mdi-view-dashboard"></i><span class="hide-menu"> Dashboard-2 </span></a></li>
                              <li class="sidebar-item"><a href="pages-gallery.html" class="sidebar-link"><i class="mdi mdi-multiplication-box"></i><span class="hide-menu"> Gallery </span></a></li>
                              <li class="sidebar-item"><a href="pages-calendar.html" class="sidebar-link"><i class="mdi mdi-calendar-check"></i><span class="hide-menu"> Calendar </span></a></li>
                              <li class="sidebar-item"><a href="pages-invoice.html" class="sidebar-link"><i class="mdi mdi-bulletin-board"></i><span class="hide-menu"> Invoice </span></a></li>
                              <li class="sidebar-item"><a href="pages-chat.html" class="sidebar-link"><i class="mdi mdi-message-outline"></i><span class="hide-menu"> Chat Option </span></a></li>
                          </ul>
                      </li>
                      <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-account-key"></i><span class="hide-menu">Authentication </span></a>
                          <ul aria-expanded="false" class="collapse  first-level">
                              <li class="sidebar-item"><a href="authentication-login.html" class="sidebar-link"><i class="mdi mdi-all-inclusive"></i><span class="hide-menu"> Login </span></a></li>
                              <li class="sidebar-item"><a href="authentication-register.html" class="sidebar-link"><i class="mdi mdi-all-inclusive"></i><span class="hide-menu"> Register </span></a></li>
                          </ul>
                      </li>
                      <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-alert"></i><span class="hide-menu">Errors </span></a>
                          <ul aria-expanded="false" class="collapse  first-level">
                              <li class="sidebar-item"><a href="error-403.html" class="sidebar-link"><i class="mdi mdi-alert-octagon"></i><span class="hide-menu"> Error 403 </span></a></li>
                              <li class="sidebar-item"><a href="error-404.html" class="sidebar-link"><i class="mdi mdi-alert-octagon"></i><span class="hide-menu"> Error 404 </span></a></li>
                              <li class="sidebar-item"><a href="error-405.html" class="sidebar-link"><i class="mdi mdi-alert-octagon"></i><span class="hide-menu"> Error 405 </span></a></li>
                              <li class="sidebar-item"><a href="error-500.html" class="sidebar-link"><i class="mdi mdi-alert-octagon"></i><span class="hide-menu"> Error 500 </span></a></li>
                          </ul>
                      </li> -->
                  </ul>
              </nav>
              <!-- End Sidebar navigation -->
          </div>
          <!-- End Sidebar scroll-->
      </aside>
      <!-- ============================================================== -->
      <!-- End Left Sidebar - style you can find in sidebar.scss  -->
      <!-- ============================================================== -->
