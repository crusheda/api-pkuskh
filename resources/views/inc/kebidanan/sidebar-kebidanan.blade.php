<!-- LEFT SIDEBAR -->
<div id="sidebar-nav" class="sidebar">
    <div class="sidebar-scroll">
        <nav>
            <ul class="nav">
                <li><a href="{{ route('kebidanan.dashboard') }}" class="{{ (request()->is('kebidanan/dashboard*')) ? 'active' : '' }}"><i class="lnr lnr-home"></i> <span>Dashboard</span></a></li>
                {{--  <li>
                    <a href="#subPages" data-toggle="collapse" class="
                                                {{ (request()->is('kebidanan/lisinopril*')) ? 'active' : 'collapsed' }}
                                                {{ (request()->is('kebidanan/tanapres*')) ? 'active' : 'collapsed' }}
                                                {{ (request()->is('kebidanan/captopril*')) ? 'active' : 'collapsed' }}">
                        <i class="lnr lnr-cart"></i> <span>Penjualan Obat</span>
                        <i class="icon-submenu lnr lnr-chevron-left"></i>
                    </a>
                    <div id="subPages" class="
                                                {{ (request()->is('kebidanan/lisinopril*')) ? 'collapse in' : 'collapse' }}
                                                {{ (request()->is('kebidanan/tanapres*')) ? 'collapse in' : 'collapse' }}
                                                {{ (request()->is('kebidanan/captopril*')) ? 'collapse in' : 'collapse' }}">
                        <ul class="nav">
                            <li><a href="{{ route('kebidanan.lisinopril') }}" class="{{ (request()->is('kebidanan/lisinopril*')) ? 'active' : '' }}">Lisinopril</a></li>
                            <li><a href="{{ route('kebidanan.tanapres') }}" class="{{ (request()->is('kebidanan/tanapres*')) ? 'active' : '' }}">Tanapres</a></li>
                            <li><a href="{{ route('kebidanan.captopril') }}" class="{{ (request()->is('kebidanan/captopril*')) ? 'active' : '' }}">Captopril</a></li>
                        </ul>
                    </div>
                </li>  --}}
                <li><a href="{{ route('kebidanan.skl') }}" class="{{ (request()->is('kebidanan/skl*')) ? 'active' : '' }}"><i class="lnr lnr-chart-bars"></i> <span>SKL</span></a></li>
            </ul>
        </nav>
    </div>
</div>
<!-- END LEFT SIDEBAR -->
