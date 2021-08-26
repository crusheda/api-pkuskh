<!-- LEFT SIDEBAR -->
<div id="sidebar-nav" class="sidebar">
    <div class="sidebar-scroll">
        <nav>
            <ul class="nav">
                <li><a href="{{ route('farmasi.dashboard') }}" class="{{ (request()->is('farmasi/dashboard*')) ? 'active' : '' }}"><i class="lnr lnr-home"></i> <span>Dashboard</span></a></li>
                <li>
                    <a href="#subPages" data-toggle="collapse" class="
                                                {{ (request()->is('farmasi/lisinopril*')) ? 'active' : 'collapsed' }}
                                                {{ (request()->is('farmasi/tanapres*')) ? 'active' : 'collapsed' }}
                                                {{ (request()->is('farmasi/captopril*')) ? 'active' : 'collapsed' }}">
                        <i class="lnr lnr-cart"></i> <span>Penjualan Obat</span>
                        <i class="icon-submenu lnr lnr-chevron-left"></i>
                    </a>
                    <div id="subPages" class="
                                                {{ (request()->is('farmasi/lisinopril*')) ? 'collapse in' : 'collapse' }}
                                                {{ (request()->is('farmasi/tanapres*')) ? 'collapse in' : 'collapse' }}
                                                {{ (request()->is('farmasi/captopril*')) ? 'collapse in' : 'collapse' }}">
                        <ul class="nav">
                            <li><a href="{{ route('farmasi.lisinopril') }}" class="{{ (request()->is('farmasi/lisinopril*')) ? 'active' : '' }}">Lisinopril</a></li>
                            <li><a href="{{ route('farmasi.tanapres') }}" class="{{ (request()->is('farmasi/tanapres*')) ? 'active' : '' }}">Tanapres</a></li>
                            <li><a href="{{ route('farmasi.captopril') }}" class="{{ (request()->is('farmasi/captopril*')) ? 'active' : '' }}">Captopril</a></li>
                        </ul>
                    </div>
                </li>
                {{--  <li><a href="#" class=""><i class="lnr lnr-chart-bars"></i> <span>Setoran Distributor</span></a></li>  --}}
            </ul>
        </nav>
    </div>
</div>
<!-- END LEFT SIDEBAR -->
