<div class="app-sidebar sidebar-shadow">
    <div class="app-header__logo">
        <div class="logo-src"></div>
        <div class="header__pane ml-auto">
            <div>
                <button type="button" class="hamburger close-sidebar-btn hamburger--elastic" data-class="closed-sidebar">
                    <span class="hamburger-box">
                        <span class="hamburger-inner"></span>
                    </span>
                </button>
            </div>
        </div>
    </div>
    <div class="app-header__mobile-menu">
        <div>
            <button type="button" class="hamburger hamburger--elastic mobile-toggle-nav">
                <span class="hamburger-box">
                    <span class="hamburger-inner"></span>
                </span>
            </button>
        </div>
    </div>
    <div class="app-header__menu">
        <span>
            <button type="button" class="btn-icon btn-icon-only btn btn-primary btn-sm mobile-toggle-header-nav">
                <span class="btn-icon-wrapper">
                    <i class="fa fa-ellipsis-v fa-w-6"></i>
                </span>
            </button>
        </span>
    </div>    
    <div class="scrollbar-sidebar">
        <div class="app-sidebar__inner">
            <ul class="vertical-nav-menu">
                <li class="app-sidebar__heading">Dashboards</li>
                @can('View Dashboard')
                <li class="{{ (request()->is(['dashboard'])) ? 'mm-active' : '' }}">
                    <a href="{{ route('dashboard') }}" class="{{ (request()->is(['dashboard'])) ? 'mm-active' : '' }}">
                        <i class="metismenu-icon pe-7s-graph2"></i>
                        Dashboard
                    </a>
                </li>
                @endcan
                <li class="app-sidebar__heading">Transactions</li>
                @can('View Client')
                <li class="{{ (request()->is(['client', 'client/new'])) ? 'mm-active' : '' }}">
                    <a href="{{ route('client') }}" class="{{ (request()->is(['client', 'client/new'])) ? 'mm-active' : '' }}">
                        <i class="metismenu-icon pe-7s-users"></i>
                        Client
                    </a>
                </li>
                @endcan
                <li class="{{ (request()->segment(2)==='fsmr') ? 'mm-active' : '' }}">
                    <a href="#">
                        <i class="metismenu-icon pe-7s-safe"></i>
                        Fire Safety
                        <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                    </a>
                    <ul>
                        @can('New FSMR Application')
                        <li>
                            <a href="{{ route('transaction-fsmr-application') }}" class="{{ (request()->segment(3)==='application') ? 'mm-active' : '' }}">
                                <i class="metismenu-icon"></i>
                                New Application
                            </a>
                        </li>
                        @endcan
                        @can('My FSMR Applications')
                        <li>
                            <a href="{{ route('transaction-fsmr-my-applications') }}"  class="{{ (request()->segment(3)==='myapplications') ? 'mm-active' : '' }}">
                                <i class="metismenu-icon"></i>
                                My FSMR Applications
                            </a>
                        </li>
                        @endcan
                        @can('List of FSMRs')
                        <li>
                            <a href="{{ route('transaction-fsmr-list') }}"  class="{{ (request()->segment(3)==='list' || request()->segment(3)==='view') ? 'mm-active' : '' }}">
                                <i class="metismenu-icon"></i>
                                List
                            </a>
                        </li>
                        @endcan
                    </ul>
                </li>
                <li>
                    <a href="#">
                        <i class="metismenu-icon pe-7s-note2"></i>
                        Quotation
                        <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                    </a>
                    <ul>
                        <li>
                            <a href="elements-buttons-standard.html">
                                <i class="metismenu-icon"></i>
                                List
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="{{ (in_array(request()->segment(2), ['delivery', 'sales', 'inventory'])) ? 'mm-active' : '' }}">
                    <a href="#">
                        <i class="metismenu-icon pe-7s-note2"></i>
                        Sales & Inventory
                        <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                    </a>
                    <ul>
                        <li>
                            <a href="{{ route('transaction-delivery') }}" class="{{ (request()->segment(2)==='delivery' && blank(request()->segment(3))) ? 'mm-active' : '' }}">
                                <i class="metismenu-icon"></i>
                                Delivery Entry
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('transaction-delivery-list') }}" class="{{ (request()->segment(2)==='delivery' && request()->segment(3)==='list') ? 'mm-active' : '' }}">
                                <i class="metismenu-icon"></i>
                                Delivery List
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('transaction-sales-entry') }}"  class="{{ (request()->segment(2)==='sales' && blank(request()->segment(3))) ? 'mm-active' : '' }}">
                                <i class="metismenu-icon"></i>
                                Sales Entry
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('transaction-sales-list') }}"  class="{{ (request()->segment(2)==='sales' && request()->segment(3)==='list') ? 'mm-active' : '' }}">
                                <i class="metismenu-icon"></i>
                                Sales List
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('transaction-inventory') }}"  class="{{ (request()->segment(2)==='inventory') ? 'mm-active' : '' }}">
                                <i class="metismenu-icon"></i>
                                Inventory
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="app-sidebar__heading">Maintenance</li>
                <li class="{{ (request()->segment(1)==='setup') ? 'mm-active' : '' }}">
                    <a href="#">
                        <i class="metismenu-icon pe-7s-pendrive"></i>
                        Data Setup
                        <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                    </a>
                    <ul>
                        @can('Attachment Types Manager')
                        <li>
                            <a href="{{ route('attachment') }}" class="{{ (request()->segment(2)==='attachment') ? 'mm-active' : '' }}">
                                <i class="metismenu-icon">
                                </i>Attachment Types
                            </a>
                        </li>
                        @endcan
                        @can('FSMR Contents Manager')
                        <li>
                            <a href="{{ route('content') }}" class="{{ (request()->segment(2)==='fsmr-content') ? 'mm-active' : '' }}">
                                <i class="metismenu-icon">
                                </i>FSMR Contents
                            </a>
                        </li>
                        @endcan
                        @can('Fire Detection Alarm System Manager')
                        <li>
                            <a href="{{ route('fdas') }}" class="{{ (request()->segment(2)==='fdas') ? 'mm-active' : '' }}">
                                <i class="metismenu-icon">
                                </i>FDAS
                            </a>
                        </li>
                        @endcan
                        @can('Question Checklist Manager')
                        <li>
                            <a href="{{ route('questions') }}" class="{{ (request()->segment(2)==='questions') ? 'mm-active' : '' }}">
                                <i class="metismenu-icon">
                                </i>Questions Checklist
                            </a>
                        </li>
                        @endcan
                        @can('Signatories Manager')
                        <li>
                            <a href="{{ route('signatories') }}" class="{{ (request()->segment(2)==='signatories') ? 'mm-active' : '' }}">
                                <i class="metismenu-icon">
                                </i>Signatories
                            </a>
                        </li>
                        @endcan
                    </ul>
                </li>
                <li class="{{ (request()->is(['roles', 'user'])) ? 'mm-active' : '' }}">
                    <a href="#">
                    
                        <i class="metismenu-icon pe-7s-way"></i>
                        Accessibility
                        <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                    </a>
                    <ul>
                        @can('Roles and Permission Manager')
                        <li>
                            <a href="{{ route('roles') }}" class="{{ (request()->is(['roles'])) ? 'mm-active' : '' }}">
                                <i class="metismenu-icon"></i>
                                Roles and Permission
                            </a>
                        </li>
                        @endcan
                        @can('User Accounts Manager')
                        <li>
                            <a href="{{ route('user') }}" class="{{ (request()->is(['user'])) ? 'mm-active' : '' }}">
                                <i class="metismenu-icon">
                                </i>User Accounts
                            </a>
                        </li>
                        @endcan
                    </ul>
                </li>
                <li class="{{ (request()->segment(1)==='settings') ? 'mm-active' : '' }}">
                    <a href="#">
                        <i class="metismenu-icon pe-7s-settings"></i>
                        Settings
                        <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                    </a>
                    <ul>
                        @can('Defaults')
                        <li>
                            <a href="{{ route('settings-defaults') }}" class="{{ (request()->segment(2)==='defaults') ? 'mm-active' : '' }}">
                                <i class="metismenu-icon">
                                </i>System Defaults
                            </a>
                        </li>
                        @endcan
                        @can('Database Backup')
                        <li>
                            <a href="#">
                                <i class="metismenu-icon">
                                </i>Back-up Database
                            </a>
                        </li>
                        @endcan
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</div>    
