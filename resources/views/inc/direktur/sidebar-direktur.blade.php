<!-- LEFT SIDEBAR -->
<div id="sidebar-nav" class="sidebar">
    <div class="sidebar-scroll">
        <nav>
            <ul class="nav">
                <li><a href="{{ route('direktur.dashboard') }}" class="{{ (request()->is('direktur/dashboard*')) ? 'active' : '' }}"><i class="lnr lnr-home"></i> <span>Dashboard</span></a></li>
                <li>
                    <a href="#subPages" data-toggle="collapse" class="
                                                {{ (request()->is('direktur/rekapharian*')) ? 'active' : 'collapsed' }}
                                                {{ (request()->is('direktur/rekapbulanan*')) ? 'active' : 'collapsed' }}
                                                {{ (request()->is('direktur/rekaptahunan*')) ? 'active' : 'collapsed' }}">
                        <i class="lnr lnr-chart-bars"></i> <span>Kunjungan Pasien</span>
                        <i class="icon-submenu lnr lnr-chevron-left"></i>
                    </a>
                    <div id="subPages" class="
                                                {{ (request()->is('direktur/rekapharian*')) ? 'collapse in' : 'collapse' }}
                                                {{ (request()->is('direktur/rekapbulanan*')) ? 'collapse in' : 'collapse' }}
                                                {{ (request()->is('direktur/rekaptahunan*')) ? 'collapse in' : 'collapse' }}">
                        <ul class="nav">
                            <li><a href="{{ route('direktur.rekapharian') }}" class="{{ (request()->is('direktur/rekapharian*')) ? 'active' : '' }}">Rekap Harian</a></li>
                            <li><a href="#" class="">Rekap Bulanan</a></li>
                            <li><a href="#" class="">Rekap Tahunan</a></li>
                        </ul>
                    </div>
                </li>
                <li><a href="{{ route('direktur.kamar') }}" class="{{ (request()->is('direktur/kamar*')) ? 'active' : '' }}"><i class="lnr lnr-apartment"></i> <span>Kamar</span></a></li>
            </ul>
        </nav>
    </div>
</div>
<!-- END LEFT SIDEBAR -->
