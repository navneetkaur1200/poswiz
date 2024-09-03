<!-- ========== Left Sidebar Start ========== -->
<div class="vertical-menu">

    <div data-simplebar class="h-100">

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">


                @if(Auth::user()->role == "1")

                <li id="dashboard" class="">
                    <a href="{{route('admin.dashboard')}}" class="waves-effect">
                        <i class="ti ti-layout-dashboard"></i>
                        <span key="t-dashboards">Dashboard</span>
                    </a>
                </li>
                <li id="myprofile" class="">
                    <a href="{{route('admin.profile')}}" class="waves-effect">
                        <i class="bx bx-user-pin"></i>
                        <span key="t-dashboards">Profile</span>
                    </a>
                </li>
                <li id="user">
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="bx bx-user"></i>
                         <span key="t-contacts">Subscribers</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false" id="user_sub">
                        <li id="create"><a href="{{route('admin.subscriber.new_user')}}" key="t-user-grid">Create New</a></li>
                        <li id="manage"><a href="{{route('admin.subscriber.manage')}}" key="t-user-list">Manage</a></li>
                        
                    </ul>
                </li>
                <li id="log" class="">
                    <a href="{{route('admin.log.manage')}}" class="waves-effect">
                        <i class="bx bx-pie-chart"></i>
                        <span key="t-dashboards">Logs</span>
                    </a>
                </li>
                <li id="setting" class="">
                    <a href="{{route('admin.setting.common')}}" class="waves-effect">
                        <i class="bx bx-cog"></i>
                        <span key="t-dashboards">Settings</span>
                    </a>
                </li>
            @endif
            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>
<!-- Left Sidebar End -->
