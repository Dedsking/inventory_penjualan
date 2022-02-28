<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link text-decoration-none">
        <img src="" alt="" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light ">Invertory Penjualan</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex ">
            <div class="image">
                {{-- <img src="#" class="img-circle elevation-2" alt="User Image"> --}}
            </div>
            <div class="info">
                <a href="#" class="d-block text-decoration-none">Dedy ruspandi</a>
            </div>
        </div>



        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
       with font-awesome or any other icon font library -->
                <li class="nav-item menu-open">
                    <a href="#" class="nav-link active">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Starter Pages
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <router-link to="data-item" class="nav-link">
                                <i class="fa-solid fa-sitemap nav-icon"></i>
                                <p>Items</p>
                            </router-link>
                        </li>
                        <li class="nav-item">
                            <router-link to="data-customer" class="nav-link">
                                <i class="fa-solid fa-users nav-icon"></i>
                                <p>Customers</p>
                            </router-link>
                        </li>
                        <li class="nav-item">
                            <router-link to="data-sales" class="nav-link">
                                <i class="fa-solid fa-shop nav-icon"></i>
                                <p>Sales</p>
                            </router-link>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
