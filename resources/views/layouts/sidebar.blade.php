<nav id="sidebar" class="sidebar-wrapper">

    <!-- Sidebar profile starts -->
    <div class="sidebar-profile">
        <img src="{{ asset('assets/images/logo.jpg') }}" class="profile-user mb-3" alt="Admin Dashboard">
        <div class="text-center">
            <h6 class="profile-name m-0 text-nowrap text-truncate">
                ISBN/BENI
            </h6>
        </div>
    </div>
    <!-- Sidebar profile ends -->
    <div class="sidebarMenuScroll">
        <!-- Sidebar menu starts -->
        <ul class="sidebar-menu">
            <li class="active current-page">
                <a href="{{ route('dashBoard.index') }}">
                    <i class="bi bi-pie-chart"></i>
                    <span class="menu-text">Acceuil</span>
                </a>
            </li>
            <li>
                <a href="{{ route('etudiant.index') }}">
                    <i class="bi bi-person-plus-fill"></i>
                    <span class="menu-text">Etudiant</span>
                </a>
            </li>
            <li>
                <a href="{{ route('inscription.index') }}">
                    <i class="fs-3 bi bi-layers"></i>
                    <span class="menu-text">Inscription</span>
                </a>
            </li>

            <li class="treeview">
                <a href="#!">
                    <i class="bi bi-cash"></i>
                    <span class="menu-text">Comptabilite</span>
                </a>
                <ul class="treeview-menu">
                    <li>
                        <a href="{{ route('payements.index') }}">Payement</a>
                    </li>
                    <li>
                        <a href="{{ route('type.index') }}">Type des frais</a>
                    </li>
                    <li>
                        <a href="{{ route('modalite.index') }}">Modalité Payement</a>
                    </li>
                </ul>
            </li>
            <li class="treeview">
                <a href="#!">
                    <i class="bi bi-gear"></i>
                    <span class="menu-text">Paramèttre</span>
                </a>
                <ul class="treeview-menu">
                    <li>
                        <a href="{{ route('promotion.index') }}">Promotion</a>
                    </li>
                    <li>
                        <a href="{{ route('option.index') }}">Option</a>
                    </li>
                    <li>
                        <a href="{{ route('annee.index') }}">Année Académique</a>
                    </li>
                    <li>
                        <a href="{{ route('user.index') }}">Utilisateurs</a>
                    </li>

                </ul>
            </li>
            <li>
                <a href="{{ route('rapport.selection') }}">
                    <i class="fs-3 bi bi-bookmarks-fill"></i>
                    <span class="menu-text">Rapports</span>
                </a>
            </li>
            <li>
                <a href="{{ route('logout') }}">
                    <i class="fs-3 bi bi-arrow-left-circle"></i>
                    <span class="menu-text">Déconnexion</span>
                </a>
            </li>
        </ul>
    </div>
</nav>
