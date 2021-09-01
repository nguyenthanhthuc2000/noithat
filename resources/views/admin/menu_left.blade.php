    <nav id="sidebar" class="sidebar">
      <div class="sidebar-content js-simplebar">
        <a class="sidebar-brand" href="{{route('admin.index')}}">
          <span class="align-middle">AdminKit</span>
        </a>

        <ul class="sidebar-nav">
          
          <li class="sidebar-item active">
            <a class="sidebar-link" href="{{route('admin.index')}}">
              <i class="align-middle" data-feather="sliders"></i> <span class="align-middle">Dashboard</span>
            </a>
          </li>
        @hasanyrole('admin|censor|product-manager')
            <li class="sidebar-header">
              Sản phẩm
            </li>
            <li class="sidebar-item">
            <a class="sidebar-link" href="{{route('product-manager.index')}}">
                <i class="align-middle" data-feather="sliders"></i> <span class="align-middle">Danh sách sản phẩm</span>
              </a>
            </li>
            @hasanyrole('admin')
            <li class="sidebar-item">
              <a class="sidebar-link" href="{{route('brand-manager.index')}}">
                <i class="align-middle" data-feather="user"></i> <span class="align-middle">Thương hiệu</span>
              </a>
            </li>

            <li class="sidebar-item">
              <a class="sidebar-link" href="{{route('category-manager.index')}}">
                <i class="align-middle" data-feather="settings"></i> <span class="align-middle">Danh mục cấp 1</span>
              </a>
            </li>

            <li class="sidebar-item">
              <a class="sidebar-link" href="{{route('item-manager.index')}}">
                <i class="align-middle" data-feather="credit-card"></i> <span class="align-middle">Danh mục cấp 2</span>
              </a>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link" href="{{route('tag-product-manager.index')}}">
                <i class="align-middle" data-feather="credit-card"></i> <span class="align-middle">Tag sản phẩm</span>
              </a>
            </li>
            @endhasanyrole
        @endhasanyrole
        @hasanyrole('admin|censor|order-manager')
        <li class="sidebar-header">
          Đơn hàng
        </li>
        <li class="sidebar-item">
        <a class="sidebar-link" href="{{route('order-manager.index')}}">
            <i class="align-middle" data-feather="sliders"></i> <span class="align-middle">Đơn hàng</span>
          </a>
        </li>
        @role('admin')
          <li class="sidebar-item">
            <a class="sidebar-link" href="{{route('coupon-manager.index')}}">
              <i class="align-middle" data-feather="user"></i> <span class="align-middle">Mã giảm giá</span>
            </a>
          </li>
        @endrole
        @endhasanyrole
        @hasanyrole('admin|photo-seo-manager|articles-manager|censor')
        <li class="sidebar-header">
          Danh mục
        </li>
          @hasanyrole('admin|articles-manager|censor')
            <li class="sidebar-item">
              <a href="#bv" data-toggle="collapse" class="sidebar-link collapsed">
                  <i class="align-middle" data-feather="briefcase"></i> <span class="align-middle">Bài viết</span>
              </a>
              <ul id="bv" class="sidebar-dropdown list-unstyled collapse " data-parent="#sidebar">
                <li class="sidebar-item"><a class="sidebar-link" href="{{route('blog-manager.list_post','service')}}">Dịch vụ</a></li>
                <li class="sidebar-item"><a class="sidebar-link" href="{{route('blog-manager.intro')}}">Giới thiệu</a></li>
                <li class="sidebar-item"><a class="sidebar-link" href="{{route('blog-manager.list_post','recruiment')}}">Tuyển dụng</a></li>
                <li class="sidebar-item"><a class="sidebar-link" href="{{route('blog-manager.list_post','policy')}}">Chính sách</a></li>
                <li class="sidebar-item"><a class="sidebar-link" href="{{route('blog-manager.list_post','blog')}}">Bài viết</a></li>
              </ul>
            </li>
          @endhasanyrole
          @hasanyrole('admin|photo-seo-manager|censor')
          <li class="sidebar-item">
            <a href="#ha" data-toggle="collapse" class="sidebar-link collapsed">
                <i class="align-middle" data-feather="briefcase"></i> <span class="align-middle">Hình ảnh</span>
            </a>
            <ul id="ha" class="sidebar-dropdown list-unstyled collapse " data-parent="#sidebar">
              <li class="sidebar-item"><a class="sidebar-link" href="{{route('photo-manager.photo','logoheader')}}">Logo header</a></li>
              <li class="sidebar-item"><a class="sidebar-link" href="{{route('photo-manager.photo','logofooter')}}">Logo footer</a></li>
              <li class="sidebar-item"><a class="sidebar-link" href="{{route('photo-manager.photo','banner')}}">Banner</a></li>
              <li class="sidebar-item"><a class="sidebar-link" href="{{route('photo-manager.photo','favicon')}}">Favicon</a></li>
              <li class="sidebar-item"><a class="sidebar-link" href="{{route('photo-manager.listphoto','slider')}}">Silder</a></li>
              <li class="sidebar-item"><a class="sidebar-link" href="{{route('photo-manager.listphoto','criteria')}}">Tiêu chí</a></li>
              <li class="sidebar-item"><a class="sidebar-link" href="{{route('photo-manager.listphoto','partner')}}">Đối tác</a></li>
              <li class="sidebar-item"><a class="sidebar-link" href="{{route('photo-manager.listphoto','album')}}">Album</a></li>
            </ul>
          </li>
          <li class="sidebar-item">
            <a href="#dm" data-toggle="collapse" class="sidebar-link collapsed">
                <i class="align-middle" data-feather="briefcase"></i> <span class="align-middle">Seo</span>
            </a>
            <ul id="dm" class="sidebar-dropdown list-unstyled collapse " data-parent="#sidebar">
              <li class="sidebar-item"><a class="sidebar-link" href="{{route('admin.index')}}">Danh mục sản phẩm</a></li>
              <li class="sidebar-item"><a class="sidebar-link" href="{{route('admin.index')}}">Thương hiệu</a></li>
              <li class="sidebar-item"><a class="sidebar-link" href="{{route('admin.index')}}">Sản phẩm</a></li>
              <li class="sidebar-item"><a class="sidebar-link" href="{{route('admin.index')}}">Bài viết</a></li>
            </ul>
          </li>
           @endhasanyrole
        @endhasanyrole
            <li class="sidebar-header">
              Khách hàng
            </li>
            <li class="sidebar-item">
            <a class="sidebar-link" href="{{route('contact-manager.index')}}">
                <i class="align-middle" data-feather="sliders"></i> <span class="align-middle">Liên hệ </span>
              </a>
            </li>
            <li class="sidebar-header">
             Setting
            @role('admin')
            <li class="sidebar-item">
            <a class="sidebar-link" href="{{route('user-manager.index')}}">
                <i class="align-middle" data-feather="sliders"></i> <span class="align-middle">Quản lí mod</span>
              </a>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link" href="{{route('roles-manager.index')}}">
                <i class="align-middle" data-feather="user"></i> <span class="align-middle">Danh sách nhóm vai trò</span>
              </a>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link" href="{{route('setting-manager.index')}}">
                <i class="align-middle" data-feather="user"></i> <span class="align-middle">Cài đặt chung</span>
              </a>
            </li>
            <li class="sidebar-item">
              <a href="#tb" data-toggle="collapse" class="sidebar-link collapsed">
                  <i class="align-middle" data-feather="briefcase"></i> <span class="align-middle">Thông báo</span>
              </a>
              <ul id="tb" class="sidebar-dropdown list-unstyled collapse " data-parent="#sidebar">
                <li class="sidebar-item"><a class="sidebar-link" href="{{route('notification-manager.index','mod')}}">Thông báo cho mod</a></li>
                <li class="sidebar-item"><a class="sidebar-link" href="{{route('notification-manager.index','nguoi-dung')}}">Thông báo cho người dùng</a></li>
              </ul>
          @endrole

            </li>
             <li class="sidebar-item">
              <a class="sidebar-link" href="{{route('admin.show',Auth::user()->phone)}}">
                <i class="align-middle" data-feather="sliders"></i> <span class="align-middle">Thông tin</span>
              </a>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link" href="{{route('admin.logout')}}">
                <i class="align-middle" data-feather="sliders"></i> <span class="align-middle">Đăng xuất</span>
              </a>
            </li>



         <!--  <?php $menus = config('admin.menu');?>
           <?php $i=0; ?>
          @foreach($menus as $key => $menu)
            <?php $i++; ?>
            <li class="sidebar-header">
              {{$menu['name']}}
            </li>
            @isset($menu['cap1'])
              <?php $j=0; ?>
              @foreach($menu['cap1'] as $key => $cap1)
                <?php $j++; ?>
                <li class="sidebar-item">
                  <a href="@isset($cap1['cap2']) #cap{{$i}}{{$j}} @endisset @isset($cap1['route']) {{route($cap1['route'])}} @endisset" <?php if(isset($cap1['cap2'])) echo'data-toggle="collapse"';?> class="sidebar-link collapsed">
                    <i class="align-middle" data-feather="{{$cap1['icon']}}"></i>
                    <span class="align-middle">
                    {{$cap1['name']}}</span>
                  </a>
                  @isset($cap1['cap2'])
                    <ul id="cap{{$i}}{{$j}}" class="sidebar-dropdown list-unstyled collapse " data-parent="#sidebar">
                      @foreach($cap1['cap2'] as $key => $cap2)
                      <li class="sidebar-item"><a class="sidebar-link" href="@if(isset($cap2['type'])) {{route($cap2['route'],$cap2['type'])}}  @else {{route($cap2['route'])}} @endif">{{$cap2['name']}}</a></li>
                      @endforeach
                    </ul>
                  @endisset
                </li>
              @endforeach
            @endisset
          @endforeach -->

        </ul>
        <div class="sidebar-cta">
          <div class="sidebar-cta-content">
            <strong class="d-inline-block mb-2">Upgrade to Pro</strong>
            <div class="mb-3 text-sm">
              Are you looking for more components?
            </div>
            <a href="https://www.facebook.com/thuc.nguyenthanh.thuc2402/" target="_blank" class="btn btn-outline-primary btn-block">Upgrade</a>
          </div>
        </div>
      </div>
    </nav>