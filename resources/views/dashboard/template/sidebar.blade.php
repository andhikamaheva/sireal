<!-- BEGIN SIDEBAR -->
<div class="page-sidebar-wrapper">
    <!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
    <!-- DOC: Change data-auto-speed="200" to adjust the sub menu slide up/down speed -->
    <div class="page-sidebar navbar-collapse collapse">
        <!-- BEGIN SIDEBAR MENU -->
        <!-- DOC: Apply "page-sidebar-menu-light" class right after "page-sidebar-menu" to enable light sidebar menu style(without borders) -->
        <!-- DOC: Apply "page-sidebar-menu-hover-submenu" class right after "page-sidebar-menu" to enable hoverable(hover vs accordion) sub menu mode -->
        <!-- DOC: Apply "page-sidebar-menu-closed" class right after "page-sidebar-menu" to collapse("page-sidebar-closed" class must be applied to the body element) the sidebar sub menu mode -->
        <!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
        <!-- DOC: Set data-keep-expand="true" to keep the submenues expanded -->
        <!-- DOC: Set data-auto-speed="200" to adjust the sub menu slide up/down speed -->
        <ul class="page-sidebar-menu page-sidebar-menu-light" data-keep-expanded="false" data-auto-scroll="true"
            data-slide-speed="200">
            <!-- DOC: To remove the sidebar toggler from the sidebar you just need to completely remove the below "sidebar-toggler-wrapper" LI element -->

            <!-- DOC: To remove the search box from the sidebar you just need to completely remove the below "sidebar-search-wrapper" LI element -->
            <li class="start {{ Request::is('dashboard')  ? 'active open' : '' }} ">
                <a href="{{ route('dashboard') }}">
                    <i class="icon-home"></i>
                    <span class="title">Dashboard</span>
                    @if(Request::is('dashboard'))
                        <span class="selected"></span>
                        <span class="arrow"></span>
                    @endif


                </a>
            </li>

            <li class="heading">
                <h3 class="uppercase">Oprec</h3>
            </li>
            @if(Auth::user()->can('view-batch'))
                <li class=" {{ Request::is('dashboard/batches/*') ||  Request::is('dashboard/batches') ? 'active open' : ''  }} ">
                    <a href="javascript:;">
                        <i class="fa fa-list-ol" aria-hidden="true"></i>
                        <span class="title">Manage Batches</span>
                        <span class=" {{ Request::is('dashboard/batches/*') ||  Request::is('dashboard/batches') ? 'arrow open selected' : 'arrow'  }} "></span>
                    </a>
                    <ul class="sub-menu">

                        <li class="{{ Request::is('dashboard/batches') ? 'active' : '' }}">
                            <a href="{{ route('batches.index')}}">
                                List Batches</a>
                        </li>

                        @if(Auth::user()->can('add-batch'))
                            <li class="{{ Request::is('dashboard/batches/create') ? 'active' : '' }}">
                                <a href="{{ route('batches.create')}}">
                                    Add Batche</a>
                            </li>
                        @endif

                    </ul>
                </li>
            @endif


            <li class="heading">
                <h3 class="uppercase">Master</h3>
            </li>

            @if(Auth::user()->can('view-semester'))
                <li class=" {{ Request::is('dashboard/semesters/*') ||  Request::is('dashboard/semesters') ? 'active open' : ''  }} ">
                    <a href="javascript:;">
                        <i class="fa fa-graduation-cap" aria-hidden="true"></i>
                        <span class="title">Manage Semesters</span>
                        <span class=" {{ Request::is('dashboard/semesters/*') ||  Request::is('dashboard/semesters') ? 'arrow open selected' : 'arrow'  }} "></span>
                    </a>
                    <ul class="sub-menu">

                        <li class="{{ Request::is('dashboard/semesters') ? 'active' : '' }}">
                            <a href="{{ route('semesters.index')}}">
                                List Semesters</a>
                        </li>

                        @if(Auth::user()->can('add-semester'))
                            <li class="{{ Request::is('dashboard/semesters/create') ? 'active' : '' }}">
                                <a href="{{ route('semesters.create')}}">
                                    Add Semester</a>
                            </li>
                        @endif

                    </ul>
                </li>
            @endif

            @if(Auth::user()->can('view-student'))
                <li class=" {{ Request::is('dashboard/students/*') ||  Request::is('dashboard/students') ? 'active open' : ''  }} ">
                    <a href="javascript:;">
                        <i class="fa fa-graduation-cap" aria-hidden="true"></i>
                        <span class="title">Manage Students</span>
                        <span class=" {{ Request::is('dashboard/students/*') ||  Request::is('dashboard/students') ? 'arrow open selected' : 'arrow'  }} "></span>
                    </a>
                    <ul class="sub-menu">

                        <li class="{{ Request::is('dashboard/students') ? 'active' : '' }}">
                            <a href="{{ route('students.index')}}">
                                List Students</a>
                        </li>

                        @if(Auth::user()->can('add-student'))
                            <li class="{{ Request::is('dashboard/students/create') ? 'active' : '' }}">
                                <a href="{{ route('students.create')}}">
                                    Add Student</a>
                            </li>
                        @endif

                    </ul>
                </li>
            @endif


            @if(Auth::user()->can('view-subject'))
                <li class=" {{ Request::is('dashboard/subjects/*') ||  Request::is('dashboard/subjects') ? 'active open' : ''  }} ">
                    <a href="javascript:;">
                        <i class="fa fa-flask" aria-hidden="true"></i>
                        <span class="title">Manage Subjects</span>
                        <span class=" {{ Request::is('dashboard/subjects/*') ||  Request::is('dashboard/subjects') ? 'arrow open selected' : 'arrow'  }} "></span>
                    </a>
                    <ul class="sub-menu">

                        <li class="{{ Request::is('dashboard/subjects') ? 'active' : '' }}">
                            <a href="{{ route('subjects.index')}}">
                                List Subjects</a>
                        </li>

                        @if(Auth::user()->can('add-subject'))
                            <li class="{{ Request::is('dashboard/subjects/create') ? 'active' : '' }}">
                                <a href="{{ route('subjects.create')}}">
                                    Create Subject</a>
                            </li>
                        @endif

                    </ul>
                </li>
            @endif

            @if(Auth::user()->can('view-user'))
                <li class=" {{ Request::is('dashboard/users/*') ||  Request::is('dashboard/users') || Request::is('dashboard/roles/*') ||  Request::is('dashboard/roles')  ? 'active open' : ''  }} ">
                    <a href="javascript:;">
                        <i class="icon-user"></i>
                        <span class="title">Manage Users</span>
                        <span class=" {{ Request::is('dashboard/users/*') ||  Request::is('dashboard/users') || Request::is('dashboard/roles/*') ||  Request::is('dashboard/roles')  ? 'arrow open selected' : 'arrow'  }} "></span>
                    </a>
                    <ul class="sub-menu">
                        <li class="{{ Request::is('dashboard/users') ? 'active' : '' }}">
                            <a href="{{ route('users.index')}}">
                                List Users</a>
                        </li>
                        <li class="{{ Request::is('dashboard/users/create') ? 'active' : '' }}">
                            <a href="{{ route('users.create')}}">
                                Create User</a>
                        </li>
                        @if(Auth::user()->can('view-role'))
                            <li class="{{ Request::is('dashboard/roles') ? 'active' : '' }}">
                                <a href="{{ route('roles.index')}}">
                                    Roles</a>
                            </li>
                        @endif

                    </ul>
                </li>
            @endif


            <li class="heading">
                <h3 class="uppercase">General</h3>
            </li>

            @if(Auth::user()->can(''))

            @endif
            <li class=" {{ Request::is('dashboard/settings/*') ||  Request::is('dashboard/settings')  ? 'active open' : ''  }} ">
                <a href="javascript:;">
                    <i class="fa fa-cogs" aria-hidden="true"></i>
                    <span class="title">Settings</span>
                    <span class="{{ Request::is('dashboard/settings/*') ||  Request::is('dashboard/settings')  ? 'arrow open selected' : 'arrow'  }} "></span>
                </a>
                <ul class="sub-menu">
                    <li>
                        <a href="components_pickers.html">
                            General</a>
                    </li>
                </ul>
            </li>

    </div>
    <!-- END SIDEBAR -->
