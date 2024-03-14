<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

        <!-- /.search form -->
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu">
            <li class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }} treeview">
                <a href="{{ url('/backend/dashboard') }}">
                    <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                </a>
            </li>

            {{-- 1=PowerAdmin, 2=NewsAdmin, 3=AdvAdmin, 4=CatAdmin, 5=BN News Admin, 6=EN News Admin--}}
            @if(auth()->user()->role == 1 || auth()->user()->role == 2 || auth()->user()->role == 4 || auth()->user()->role == 5)
                <li class="{{ request()->routeIs('bn-contents.*')
                                || request()->routeIs('bn-breaking-news.*')
                                || request()->routeIs('bn-videos.*')
                                || request()->routeIs('bn-video-position.*')
                                || request()->routeIs('bn-content-position.*')
                                || request()->routeIs('elections.*') ? 'active' : '' }} treeview">
                    <a href="#">
                        <i class="fa fa-file-o"></i> <span>Bangla News</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        <li class="{{ request()->routeIs('bn-contents.create') ? 'active' : '' }}">
                            <a href="{{ route('bn-contents.create') }}"><i class="fa fa-plus-square"></i> Add news</a>
                        </li>
                        <li class="{{ request()->routeIs('bn-contents.index') ? 'active' : '' }}">
                            <a href="{{ route('bn-contents.index') }}"><i class="fa fa-file-o"></i> News list</a></li>
                        <li class="{{ request()->routeIs('bn-breaking-news.*') ? 'active' : '' }}">
                            <a href="{{ route('bn-breaking-news.index') }}"><i class="fa fa-file-o"></i> Breaking
                                News</a>
                        </li>
                        <li class="{{ request()->routeIs('bn-content-position.*') ? 'active' : '' }}">
                            <a href="{{ route('bn-content-position.index') }}"><i class="fa fa-file-o"></i> News
                                position</a>
                        </li>
                        <li class="{{ request()->routeIs('bn-videos.*') ? 'active' : '' }}">
                            <a href="{{ route('bn-videos.index') }}"><i class="fa fa-file-o"></i> Videos</a>
                        </li>
                        <li class="{{ request()->routeIs('bn-video-position.*') ? 'active' : '' }}">
                            <a href="{{ route('bn-video-position.index') }}"><i class="fa fa-file-o"></i> Video
                                Position</a>
                        </li>
                        <li class="{{ request()->routeIs('elections.index') ? 'active' : '' }}">
                            <a href="{{ route('elections.index') }}"><i class="fa fa-file-o"></i> Elections</a>
                        </li>
                    </ul>
                </li>
            @endif

            {{-- 1=PowerAdmin, 2=NewsAdmin, 3=AdvAdmin, 4=CatAdmin, 5=BN News Admin, 6=EN News Admin--}}
            @if(auth()->user()->role == 1 || auth()->user()->role == 2 || auth()->user()->role == 6)
                <li class="{{ request()->routeIs('en-contents.*')
                                || request()->routeIs('en-breaking-news.*')
                                || request()->routeIs('en-videos.*')
                                || request()->routeIs('en-video-position.*')
                                || request()->routeIs('en-content-position.*')
                                || request()->routeIs('elections.*') ? 'active' : '' }} treeview">
                    <a href="#">
                        <i class="fa fa-file-text-o"></i> <span>English News</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        <li class="{{ request()->routeIs('en-contents.create') ? 'active' : '' }}">
                            <a href="{{ route('en-contents.create') }}"><i class="fa fa-plus-square"></i> Add English News</a>
                        </li>
                        <li class="{{ request()->routeIs('en-contents.index') ? 'active' : '' }}">
                            <a href="{{ route('en-contents.index') }}"><i class="fa fa-file-o"></i> English News list</a>
                        </li>
                        <li class="{{ request()->routeIs('en-content-position.*') ? 'active' : '' }}">
                            <a href="{{ route('en-content-position.index') }}"><i class="fa fa-file-o"></i> English News position</a>
                        </li>
                        <li class="{{ request()->routeIs('en-breaking-news.*') ? 'active' : '' }}">
                            <a href="{{ route('en-breaking-news.index') }}"><i class="fa fa-file-o"></i> English Breaking News</a>
                        </li>
                        <li class="{{ request()->routeIs('en-videos.*') ? 'active' : '' }}">
                            <a href="{{ route('en-videos.index') }}"><i class="fa fa-file-o"></i> English Videos</a>
                        </li>
                        <li class="{{ request()->routeIs('en-video-position.*') ? 'active' : '' }}">
                            <a href="{{ route('en-video-position.index') }}"><i class="fa fa-file-o"></i> English Video
                                Position</a>
                        </li>
                    </ul>
                </li>
            @endif

            {{-- 1=PowerAdmin, 2=NewsAdmin, 3=AdvAdmin, 4=CatAdmin, 5=BN News Admin, 6=EN News Admin--}}
            @if(auth()->user()->role == 1 || auth()->user()->role == 2 || auth()->user()->role == 4 || auth()->user()->role == 5 || auth()->user()->role == 6)
                <li class="{{ request()->routeIs('manual-photos.*') ? 'active' : '' }} treeview">
                    <a href="#">
                        <i class="fa fa-picture-o"></i> <span>Media Libary</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        <li class="{{ request()->routeIs('manual-photos.create') ? 'active' : null }}">
                            <a href="{{ route('manual-photos.create') }}"><i class="fa fa-plus-square"></i> Add New Photo</a>
                        </li>
                        <li class="{{ request()->routeIs('manual-photos.index') ? 'active' : null }}">
                            <a href="{{ route('manual-photos.index') }}"><i class="fa fa-file-o"></i> Photo list</a>
                        </li>
                    </ul>
                </li>
                <li class="{{ request()->routeIs('manual-docs.*') ? 'active' : '' }} treeview">
                    <a href="#">
                        <i class="fa fa-folder-open-o"></i> <span>Documents</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        <li class="{{ request()->routeIs('manual-docs.create') ? 'active' : null }}">
                            <a href="{{ route('manual-docs.create') }}"><i class="fa fa-plus-square"></i> Add New Document</a>
                        </li>
                        <li class="{{ request()->routeIs('manual-docs.index') ? 'active' : null }}">
                            <a href="{{ route('manual-docs.index') }}"><i class="fa fa-file-o"></i> Documents list</a>
                        </li>
                    </ul>
                </li>
            @endif
            {{-- 1=PowerAdmin, 2=NewsAdmin, 3=AdvAdmin, 4=CatAdmin, 5=BN News Admin, 6=EN News Admin--}}
            @if(auth()->user()->role == 1 || auth()->user()->role == 2 || auth()->user()->role == 5)
                <li class="{{ request()->routeIs('photo-albums.*')
                             || request()->routeIs('photo-album-positions.*') ? 'active' : '' }} treeview">
                    <a href="#">
                        <i class="fa fa-photo"></i> <span>Photo</span>
                        <span class="pull-right-container">
                      <i class="fa fa-angle-left pull-right"></i>
                    </span>
                    </a>
                    <ul class="treeview-menu">
                        <li class="{{ request()->routeIs('photo-albums.create') ? 'active' : null }}">
                            <a href="{{ route('photo-albums.create') }}"><i class="fa fa-plus-square"></i> Add Photo Album</a>
                        </li>
                        <li class="{{ request()->routeIs('photo-albums.index') ? 'active' : null }}">
                            <a href="{{ route('photo-albums.index') }}"><i class="fa fa-file-o"></i> Photo Album list</a>
                        </li>
                        <li class="{{ request()->routeIs('photo-album-positions.*') ? 'active' : null }}">
                            <a href="{{ route('photo-album-positions.index') }}"><i class="fa fa-file-o"></i> Album Position</a>
                        </li>
                    </ul>
                </li>
            @endif

            {{-- 1=PowerAdmin, 2=NewsAdmin, 3=AdvAdmin, 4=CatAdmin, 5=BN News Admin, 6=EN News Admin--}}
            @if(auth()->user()->role == 1 || auth()->user()->role == 3 || auth()->id() == 11)
                <li class="{{ request()->routeIs('bn-ads.*') || request()->routeIs('bn-mobile-ads.*') ? 'active' : '' }} treeview">
                    <a href="#">
                        <i class="fa fa-image"></i> <span>Ad Management</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        <li class="{{ request()->routeIs('bn-ads.*') ? 'active' : null }}">
                            <a href="{{ route('bn-ads.index') }}"><i class="fa fa-dollar"></i> Desktop Ads</a>
                        </li>
                        <li class="{{ request()->routeIs('bn-mobile-ads.*') ? 'active' : null }}">
                            <a href="{{ route('bn-mobile-ads.index') }}"><i class="fa fa-dollar"></i> Mobile Ads</a>
                        </li>
                    </ul>
                </li>
            @endif

            {{-- 1=PowerAdmin, 2=NewsAdmin, 3=AdvAdmin, 4=CatAdmin, 5=BN News Admin, 6=EN News Admin--}}
            @if(auth()->user()->role == 1 || auth()->user()->role == 2)
                <li class="{{ request()->routeIs('epapers.*') || request()->routeIs('magazines.*') ? 'active' : '' }} treeview">
                    <a href="#">
                        <i class="fa fa-image"></i> <span>E-paper & Magazine</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        <li class="{{ request()->routeIs('epapers.*') ? 'active' : null }}">
                            <a href="{{ route('epapers.index') }}"><i class="fa fa-image"></i> E-Paper List</a>
                        </li>
                        <li class="{{ request()->routeIs('magazines.*') ? 'active' : null }}">
                            <a href="{{ route('magazines.index') }}"><i class="fa fa-image"></i> Magazine List</a>
                        </li>
                    </ul>
                </li>
            @endif

            {{-- 1=PowerAdmin, 2=NewsAdmin, 3=AdvAdmin, 4=CatAdmin, 5=BN News Admin, 6=EN News Admin--}}
            @if(auth()->user()->role == 1 || auth()->id() == 11)
                <li class="{{ request()->routeIs('bn-polls.*') ? 'active' : '' }} treeview">
                    <a href="#">
                        <i class="fa fa-bar-chart"></i> <span>Online Poll</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        <li class="{{ request()->routeIs('bn-polls.*') ? 'active' : null }}">
                            <a href="{{ route('bn-polls.index') }}"><i class="fa fa-pie-chart"></i> Bn Polls</a>
                        </li>
                    </ul>
                </li>
            @endif

            {{-- 1=PowerAdmin, 2=NewsAdmin, 3=AdvAdmin, 4=CatAdmin, 5=BN News Admin, 6=EN News Admin--}}
            @if(auth()->user()->role == 1 || auth()->user()->role == 2 || auth()->user()->role == 5)
                <li class="{{ request()->routeIs('bn-tags.*')
                                || request()->routeIs('bn-authors.*')
                                || request()->routeIs('bn-categories.*')
                                || request()->routeIs('bn-subcategories.*')
                                || request()->routeIs('bn-video-categories.*')
                                || request()->routeIs('countries.*')
                                || request()->routeIs('divisions.*')
                                || request()->routeIs('districts.*')
                                || request()->routeIs('upozillas.*')
                                || request()->routeIs('bn-site-settings.*') ? 'active' : '' }} treeview">
                    <a href="#">
                        <i class="fa fa-cogs"></i> <span>Bn Settings</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        <li class="{{ request()->routeIs('bn-tags.*') ? 'active' : null }}">
                            <a href="{{ route('bn-tags.index') }}"><i class="fa fa-tag"></i> Bn Tag</a>
                        </li>
                        <li class="{{ request()->routeIs('bn-authors.*') ? 'active' : null }}">
                            <a href="{{ route('bn-authors.index') }}"><i class="fa fa-file-o"></i> Bn Author</a>
                        </li>
                        @if(auth()->user()->role == 1)
                            <li class="{{ request()->routeIs('bn-categories.*') ? 'active' : null }}">
                                <a href="{{ route('bn-categories.index') }}"><i class="fa fa-plus-square"></i> Bn Category</a>
                            </li>
                            <li class="{{ request()->routeIs('bn-subcategories.*') ? 'active' : null }}">
                                <a href="{{ route('bn-subcategories.index') }}"><i class="fa fa-file-o"></i> Bn Subcategory</a>
                            </li>
                            <li class="{{ request()->routeIs('bn-video-categories.*') ? 'active' : null }}">
                                <a href="{{ route('bn-video-categories.index') }}"><i class="fa fa-plus-square"></i> Bn Video Category</a>
                            </li>
                            <li class="{{ request()->routeIs('countries.*') ? 'active' : null }}">
                                <a href="{{ route('countries.index') }}"><i class="fa fa-plus-square"></i> Country</a>
                            </li>
                            <li class="{{ request()->routeIs('divisions.*') ? 'active' : null }}">
                                <a href="{{ route('divisions.index') }}"><i class="fa fa-file-o"></i> Division list</a>
                            </li>
                            <li class="{{ request()->routeIs('districts.*') ? 'active' : null }}">
                                <a href="{{ route('districts.index') }}"><i class="fa fa-file-o"></i> District list</a>
                            </li>
                            <li class="{{ request()->routeIs('upozillas.*') ? 'active' : null }}">
                                <a href="{{ route('upozillas.index') }}"><i class="fa fa-file-o"></i> Upozilla list</a>
                            </li>
                            <li class="{{ request()->routeIs('bn-site-settings.*') ? 'active' : null }}">
                                <a href="{{ route('bn-site-settings.index') }}"><i class="fa fa-file-o"></i> Bn Site Settings</a>
                            </li>
                        @endif
                    </ul>
                </li>
                <li class="{{ request()->routeIs('en-tags.*')
                                || request()->routeIs('en-authors.*')
                                || request()->routeIs('en-categories.*')
                                || request()->routeIs('en-subcategories.*')
                                || request()->routeIs('en-video-categories.*')
                                || request()->routeIs('en-site-settings.*') ? 'active' : '' }} treeview">
                    <a href="#">
                        <i class="fa fa-cogs"></i> <span>En Settings</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        <li class="{{ request()->routeIs('en-tags.*') ? 'active' : null }}">
                            <a href="{{ route('en-tags.index') }}"><i class="fa fa-tag"></i> En Tag</a>
                        </li>
                        <li class="{{ request()->routeIs('en-authors.*') ? 'active' : null }}">
                            <a href="{{ route('en-authors.index') }}"><i class="fa fa-file-o"></i> En Author</a>
                        </li>
                        @if(auth()->user()->role == 1)
                            <li class="{{ request()->routeIs('en-categories.*') ? 'active' : null }}">
                                <a href="{{ route('en-categories.index') }}"><i class="fa fa-plus-square"></i> En Category</a>
                            </li>
                            <li class="{{ request()->routeIs('en-subcategories.*') ? 'active' : null }}">
                                <a href="{{ route('en-subcategories.index') }}"><i class="fa fa-file-o"></i> En Subcategory</a>
                            </li>
                            <li class="{{ request()->routeIs('en-video-categories.*') ? 'active' : null }}">
                                <a href="{{ route('en-video-categories.index') }}"><i class="fa fa-plus-square"></i> En Video Category</a>
                            </li>
                            <li class="{{ request()->routeIs('en-site-settings.*') ? 'active' : null }}">
                                <a href="{{ route('en-site-settings.index') }}"><i class="fa fa-file-o"></i> En Site Settings</a>
                            </li>
                        @endif
                    </ul>
                </li>
                {{--<li class="treeview">
                    <a href="#">
                        <i class="fa fa-cogs"></i> <span>Photo Settings</span>
                        <span class="pull-right-container">
                          <i class="fa fa-angle-left pull-right"></i>
                        </span>
                      </a>
                    <ul class="treeview-menu">
                          <li><a href="{{ route('photo-categories.index') }}"><i class="fa fa-dollar"></i> Photo Category</a></li>
                    </ul>
                </li>--}}

                @if(auth()->user()->role == 1)
                    <li class="{{ request()->routeIs('users.*')
                                || request()->routeIs('mis-users.*') ? 'active' : '' }} treeview">
                        <a href="#">
                            <i class="fa fa-users"></i> <span>Users</span>
                            <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                  </span>
                        </a>
                        <ul class="treeview-menu">
                            {{--<li><a href="{{ route('authors') }}"><i class="fa fa-plus-square"></i> Author</a></li>--}}
                            <li class="{{ request()->routeIs('mis-users.*') ? 'active' : null }}">
                                <a href="{{ route('mis-users.index') }}"><i class="fa fa-file-o"></i> MIS user</a>
                            </li>
                            <li class="{{ request()->routeIs('users.*') ? 'active' : null }}">
                                <a href="{{ route('users.index') }}"><i class="fa fa-plus-square"></i> User</a>
                            </li>
                        </ul>
                    </li>
                @endif
            @endif
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>
