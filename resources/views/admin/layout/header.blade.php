   <div class="app-header header-shadow">
       <div class="app-header__logo">
           <div class="logo-src"></div>
           <div class="header__pane ml-auto">
               <div>
                   <button type="button" class="hamburger close-sidebar-btn hamburger--elastic"
                       data-class="closed-sidebar">
                       <span class="hamburger-box">
                           <span class="hamburger-inner"></span>
                       </span>
                   </button>
               </div>
           </div>
       </div>
       <div class="app-header__mobile-menu">
           <div>
               <button type="button" class="hamburger hamburger--elastic mobile-toggle-nav">
                   <span class="hamburger-box">
                       <span class="hamburger-inner"></span>
                   </span>
               </button>
           </div>
       </div>
       <div class="app-header__menu">
           <span>
               <button type="button" class="btn-icon btn-icon-only btn btn-primary btn-sm mobile-toggle-header-nav">
                   <span class="btn-icon-wrapper">
                       <i class="fa fa-ellipsis-v fa-w-6"></i>
                   </span>
               </button>
           </span>
       </div>
       <div class="app-header__content">
           <div class="app-header-left">
               <div class="search-wrapper">
                   <div class="input-holder">
                       <input type="text" class="search-input" placeholder="Type to search">
                       <button class="search-icon"><span></span></button>
                   </div>
                   <button class="close"></button>
               </div>
               <ul class="header-megamenu nav">
               </ul>
           </div>
           <div class="app-header-right">

               <div class="header-btn-lg pr-0">
                   <div class="widget-content p-0">
                       <div class="widget-content-wrapper">
                           <div class="widget-content-left">
                               <div class="btn-group">
                                   <a data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="p-0 btn">
                                       <img width="42" class="rounded-circle"
                                           src="https://i.pinimg.com/736x/c6/e5/65/c6e56503cfdd87da299f72dc416023d4.jpg"
                                           alt="">
                                   </a>
                                   <div tabindex="-1" role="menu" aria-hidden="true"
                                       class="rm-pointers dropdown-menu-lg dropdown-menu dropdown-menu-right">
                                       <div class="dropdown-menu-header">
                                           <div class="dropdown-menu-header-inner bg-info">

                                               <div class="menu-header-content text-left">
                                                   <div class="widget-content p-0">
                                                       <div class="widget-content-wrapper">
                                                           <div class="widget-content-left mr-3">
                                                               <img width="42" class="rounded-circle" src=""
                                                                   alt="">
                                                           </div>
                                                           <div class="widget-content-left">
                                                               <div class="widget-heading">
                                                                   {{ Auth::guard('admin')->user()->name }}
                                                               </div>
                                                               <div class="widget-subheading opacity-8">Chúc bạn một
                                                                   ngày mới tốt lành !</div>
                                                           </div>
                                                           <div class="widget-content-right mr-2">
                                                               <button
                                                                   class="btn-pill btn-shadow btn-shine btn btn-focus">
                                                                   <a href="{{ route('admin.logout') }}">Đăng xuất</a>
                                                               </button>
                                                           </div>
                                                       </div>
                                                   </div>
                                               </div>
                                           </div>
                                       </div>
                                       <div class="scroll-area-xs" style="height: 40px;">
                                           <div class="scrollbar-container ps">
                                               <ul class="nav flex-column">
                                                   <li class="nav-item">
                                                       <a href="{{ route('admin.change_pass') }}" class="nav-link">Đổi
                                                           mật khẩu</a>
                                                   </li>
                                               </ul>
                                           </div>
                                       </div>
                                   </div>
                               </div>
                           </div>
                           <div class="widget-content-left  ml-3 header-user-info">
                               <div class="widget-heading">
                                   {{ Auth::guard('admin')->user()->name }}
                               </div>
                               <div class="widget-subheading"> Quản trị viên </div>
                           </div>
                       </div>
                   </div>
               </div>
           </div>
       </div>
   </div>
