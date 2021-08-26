<!-- LEFT SIDEBAR -->
<div id="sidebar-nav" class="sidebar">
    <div class="sidebar-scroll">
        <nav>
            <ul class="nav">
                <li><a href="{{ route('rm.dashboard') }}" class="{{ (request()->is('rm/dashboard*')) ? 'active' : '' }}"><i class="lnr lnr-home"></i> <span>Dashboard</span></a></li>
                <li>
                    <a href="#subPages" data-toggle="collapse" class="
                                                {{ (request()->is('rm/rekapusia*')) ? 'active' : 'collapsed' }}
                                                {{ (request()->is('rm/rekapagama*')) ? 'active' : 'collapsed' }}">
                        <i class="lnr lnr-chart-bars"></i> <span>Rekap Pasien</span>
                        <i class="icon-submenu lnr lnr-chevron-left"></i>
                    </a>
                    <div id="subPages" class="
                                                {{ (request()->is('rm/rekapusia*')) ? 'collapse in' : 'collapse' }}
                                                {{ (request()->is('rm/rekapagama*')) ? 'collapse in' : 'collapse' }}">
                        <ul class="nav">
                            <li><a href="{{ route('rm.rekapusia') }}" class="{{ (request()->is('rm/rekapusia*')) ? 'active' : '' }}">Rekap Usia</a></li>
                            <li><a href="#" class="">Rekap Agama</a></li>
                        </ul>
                    </div>
                </li>
            </ul>
        </nav>
    </div>
</div>
<!-- END LEFT SIDEBAR -->
