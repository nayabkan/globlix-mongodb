<!-- Page Sidebar Start-->
<div class="sidebar-wrapper">
          <div>
            <div class="logo-wrapper"><a href="{{ url('/') }}">
              <img class="img-fluid for-light" src="{{ url('/') }}/admin/assets/images/logo/globlix.png" alt="Admin">
              <img class="img-fluid for-dark" src="{{ url('/') }}/admin/assets/images/logo/logo_dark.png" alt="Admin">
            </a>
              <div class="back-btn"><i class="fa fa-angle-left"></i></div>
              <div class="toggle-sidebar"><i class="status_toggle middle sidebar-toggle" data-feather="grid"> </i></div>
            </div>
            <div class="logo-icon-wrapper"><a href="{{ url('/') }}"><img class="img-fluid" src="{{ url('/') }}/admin/assets/images/logo/logo-icon.png" alt=""></a></div>
            <nav class="sidebar-main">
              <div class="left-arrow" id="left-arrow"><i data-feather="arrow-left"></i></div>
              <div id="sidebar-menu">
               <ul class="sidebar-links" id="simple-bar">
                  <li class="back-btn"><a href="{{ url('/') }}"><img class="img-fluid" src="{{ url('/') }}/admin/assets/images/logo/logo-icon.png" alt=""></a>
                    <div class="mobile-back text-end"><span>Back</span><i class="fa fa-angle-right ps-2" aria-hidden="true"></i></div>
                  </li>

                  <li class="sidebar-main-title">
                    <div>
                      <h6 class="lan-1">General</h6>
                      <p class="lan-10">Dashboards,settings & banners.</p>
                    </div>
                  </li>
                  <li class="sidebar-list">
                    <a class="sidebar-link sidebar-title link-nav" href="#"><i data-feather="home"> </i><span>Dashboard</span></a>
                  </li>
                  <li class="sidebar-list">
                    <a class="sidebar-link sidebar-title link-nav" href="#"><i data-feather="image"> </i><span>Banners</span></a>
                  </li>
                  <li class="sidebar-list">
                    <a class="sidebar-link sidebar-title link-nav" href="{{route('filemanager')}}"><i data-feather="file"> </i><span>File Manager</span></a>
                  </li>
                  <li class="sidebar-list">
                    <a class="sidebar-link sidebar-title link-nav" href="#"><i data-feather="settings"> </i><span>Settings</span></a>
                  </li>
                  <li class="sidebar-list">
                    <a class="sidebar-link sidebar-title link-nav" href="{{route('inquary.index')}}"><i data-feather="message-circle"> </i><span>Inquiries</span></a>
                  </li>
                  <li class="sidebar-list">
                    <a class="sidebar-link sidebar-title link-nav" href="{{route('trades.index')}}"><i data-feather="layers"> </i><span>Trades</span></a>
                  </li>

                  <li class="sidebar-main-title">
                    <div>
                      <h6 class="lan-15">Ecommerce</h6>
                      <p class="lan-16">products, category,brands,attributes</p>
                    </div>
                  </li>
                  <li class="sidebar-list">
                    <a class="sidebar-link sidebar-title" href="javascript:void(0)"><i data-feather="shopping-bag"></i><span>Products</span></a>
                    <ul class="sidebar-submenu">
                      <li><a href="{{route('products')}}">Products</a></li>
                      <li><a href="{{route('addproduct')}}">Add Product</a></li>
                    </ul>
                  </li>
                  <li class="sidebar-list">
                    <a class="sidebar-link sidebar-title" href="javascript:void(0)"><i data-feather="tag"></i><span>Categories</span></a>
                    <ul class="sidebar-submenu">
                      <li><a href="{{route('category.index')}}">Categories</a></li>
                      <li><a href="{{route('category.create')}}">Add Category</a></li>
                    </ul>
                  </li>
                  <li class="sidebar-list">
                    <a class="sidebar-link sidebar-title" href="javascript:void(0)"><i data-feather="shield"></i><span>Brands</span></a>
                    <ul class="sidebar-submenu">
                      <li><a href="{{route('brands.index')}}">Brands</a></li>
                      <li><a href="{{route('brands.create')}}">Add Brand</a></li>
                    </ul>
                  </li>
                  <li class="sidebar-list">
                    <a class="sidebar-link sidebar-title" href="javascript:void(0)"><i data-feather="shield"></i><span>Countries</span></a>
                    <ul class="sidebar-submenu">
                      <li><a href="{{route('countries.index')}}">Countries</a></li>
                      <!-- <li><a href="#">Add Country</a></li> -->
                    </ul>
                  </li>

                  <li class="sidebar-list">
                    <a class="sidebar-link sidebar-title" href="javascript:void(0)"><i data-feather="shield"></i><span>Auctions</span></a>
                    <ul class="sidebar-submenu">
                      <li><a href="{{route('auctions')}}">Auctions</a></li>
                      <li><a href="{{ route('addauction') }}">Add Auction</a></li>
                    </ul>
                  </li>

                  <li class="sidebar-list">
                    <a class="sidebar-link sidebar-title" href="javascript:void(0)"><i data-feather="shield"></i><span>Auctions Bids</span></a>
                    <ul class="sidebar-submenu">
                      <li><a href="{{route('bids')}}">Auction Bids</a></li>
                    </ul>
                  </li>
                  
                  <li class="sidebar-main-title">
                    <div>
                      <h6 class="lan-25">Applications</h6>
                      <p class="lan-26">extras, others, users, new</p>
                    </div>
                  </li>
                  <li class="sidebar-list"><a class="sidebar-link sidebar-title" href="javascript:void(0)"><i data-feather="users"></i><span>Users</span></a>
                    <ul class="sidebar-submenu">
                      <li><a href="{{route('allusers')}}">All Users</a></li>
                      <!-- <li><a href="#">Users Edit</a></li>
                      <li><a href="#">Users Cards</a></li> -->
                    </ul>
                  </li>
                  <li class="sidebar-list"><a class="sidebar-link sidebar-title" href="javascript:void(0)"><i data-feather="users"></i><span>Vendors</span></a>
                    <ul class="sidebar-submenu">
                      <li><a href="{{route('vendors')}}">Vendors</a></li>
                      <!-- <li><a href="#">Users Cards</a></li> -->
                    </ul>
                  </li>
                  <li class="sidebar-list">
                    <a class="sidebar-link sidebar-title" href="javascript:void(0)"><i data-feather="box"></i><span>Others</span></a>
                    <ul class="sidebar-submenu">
                      <li><a href="#">Project List</a></li>
                      <li><a href="#">Create new</a></li>
                    </ul>
                  </li>

                </ul>

            </div>
              <div class="right-arrow" id="right-arrow"><i data-feather="arrow-right"></i></div>
            </nav>
          </div>
        </div>
        <!-- Page Sidebar Ends -->