<li class="treeview {{
            Route::is('admin.warish.*') ? 'active menu-open' : ''
             }}">
    <a href="">
        <i class="fa fa-television"></i>
        <span>
            ওয়ারিশ
        </span>
        <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
        </span>
    </a>
    <ul class="treeview-menu">
        <li class="{{ Route::is('admin.warish.index') ? 'active' : '' }}">
            <a href="{{ route('admin.warish.index') }}">
                ওয়ারিশ আবেদন
            </a>
        </li>
        <li class="{{ Route::is('admin.warish.setting') ? 'active' : '' }}">
            <a href="{{ route('admin.warish.setting') }}">
                ওয়ারিশ সেটিং
            </a>
        </li>

    </ul>
</li>