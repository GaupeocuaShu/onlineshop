<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="index.html">Stisla</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="index.html">St</a>
        </div>
        <ul class="sidebar-menu">
            <li class="menu-header">Dashboard</li>
            <li class="dropdown ">
                <a href="#" class="nav-link has-dropdown"><i class="fas fa-fire"></i><span>Dashboard</span></a>
                <ul class="dropdown-menu">
                    <li class=><a class="nav-link" href="index-0.html">General Dashboard</a></li>
                    <li><a class="nav-link" href="index.html">Ecommerce Dashboard</a></li>
                </ul>
            </li>
            <li class="dropdown {{ setActive(['admin.slider.*', 'admin.brand.*', 'admin.category.*']) }}">
                <a href="#" class="nav-link has-dropdown"><i class="fas fa-fire"></i><span>Website
                        Management</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ setActive(['admin.slider.index', 'admin.slider.create']) }}"><a class="nav-link"
                            href="{{ route('admin.slider.index') }}">Slider</a></li>
                    <li class="{{ setActive(['admin.brand.index', 'admin.brand.create']) }}"><a class="nav-link"
                            href="{{ route('admin.brand.index') }}">Brand</a></li>
                    <li class="{{ setActive(['admin.category.index', 'admin.category.create']) }}"><a class="nav-link"
                            href="{{ route('admin.category.index') }}">Category</a></li>
                </ul>
            </li>
            <li class="dropdown {{ setActive(['admin.user.*']) }}">
                <a href="#" class="nav-link has-dropdown"><i class="fas fa-fire"></i><span>Member
                        Management</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ setActive(['admin.user.index']) }}"><a class="nav-link"
                            href="{{ route('admin.user.index') }}">User</a></li>
                </ul>
            </li>

        </ul>

    </aside>
</div>
