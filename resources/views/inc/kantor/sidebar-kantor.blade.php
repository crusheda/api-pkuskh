<!-- LEFT SIDEBAR -->
<div id="sidebar-nav" class="sidebar">
    <div class="sidebar-scroll">
        <nav>
            <ul class="nav">
                <li><a href="{{ route('kantor.dashboard') }}" class="{{ (request()->is('kantor/dashboard*')) ? 'active' : '' }}"><i class="lnr lnr-home"></i> <span>Dashboard</span></a></li>
                <li><a href="{{ route('rapat.index') }}" class="{{ (request()->is('kantor/rapat*')) ? 'active' : '' }}"><i class="lnr lnr-laptop-phone"></i> <span>Agenda Rapat</span></a></li>
            </ul>
        </nav>
    </div>
</div>
<!-- END LEFT SIDEBAR -->
