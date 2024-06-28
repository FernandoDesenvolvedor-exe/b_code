<header class="topbar" data-navbarbg="skin5">
    <nav class="navbar top-navbar navbar-expand-md navbar-dark">
        <div class="navbar-header" data-logobg="skin5">
            <!-- This is for the sidebar toggle which is visible on mobile only -->
            <a class="nav-toggler waves-effect waves-light d-block d-md-none" href="javascript:void(0)"><i class="ti-menu ti-close"></i></a>
            <!-- ============================================================== -->
            <!-- Logo -->
            <!-- ============================================================== -->
            <a class="navbar-brand" href="producao">
                <!-- Logo icon -->
                <b class="logo-icon p-l-10">
                    <!--You can put here icon as well // <i class="wi wi-sunset"></i> //-->
                    <!-- Dark Logo icon -->
                    <img src="assets/images/logoLabPlasticos_menuSideBar.png" alt="homepage" class="light-logo" style="margin-left:0px" />
                
                </b>
                <!--End Logo icon -->
                <!-- Logo text -->
                                                
                <span class="logo-text">
                    <h3>LabPlásticos</h3>                               
                </span>
            </a>
            <a class="topbartoggler d-block d-md-none waves-effect waves-light" href="javascript:void(0)" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><i class="ti-more"></i></a>
        </div>
        <div class="navbar-collapse collapse" id="navbarSupportedContent"  data-navbarbg="skin5">
            <ul class="navbar-nav float-left mr-auto">
                <li class="nav-item d-none d-md-block"><a class="nav-link sidebartoggler waves-effect waves-light" href="javascript:void(0)" data-sidebartype="mini-sidebar"><i class="mdi mdi-menu font-24"></i></a></li>                                            
                
            </ul>
            <ul class="navbar-nav float-right">
                
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-muted waves-effect waves-dark pro-pic" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="assets/images/users/1.jpg" alt="user" class="rounded-circle" width="31"></a>
                    <div class="dropdown-menu dropdown-menu-right user-dd animated">
                        <a class="dropdown-item" href="perfil"><i class="ti-user m-r-5 m-l-5"></i>Perfil</a>
                        <?php if($_SESSION['tipo'] == 1){?>
                            <a class="dropdown-item" href="usuarios"><i class="ti-wallet m-r-5 m-l-5"></i>Usuários</a>
                        <?php }?>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="php/logout"><i class="fa fa-power-off m-r-5 m-l-5"></i>Logout</a>
                        <div class="dropdown-divider"></div>
                        <div class="p-l-30 p-10"><a href="javascript:void(0)" class="btn btn-sm btn-success btn-rounded">View Profile</a></div>
                    </div>
                </li>
                <!-- ============================================================== -->
                <!-- User profile and search -->
                <!-- ============================================================== -->
            </ul>
        </div>
    </nav>
</header>
<aside class="left-sidebar" data-sidebarbg="skin5">
    <!-- Sidebar scroll-->
    <div class="scroll-sidebar">
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav">
            <ul id="sidebarnav" class="p-t-30">                
                <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-factory"></i><span class="hide-menu"> Produção </span></a>
                    <ul aria-expanded="false" class="collapse  first-level">
                        <li class="sidebar-item"><a href="producao" class="sidebar-link"><i class="mdi mdi-receipt"></i><span class="hide-menu"> Pedidos </span></a></li>
                        <li class="sidebar-item"><a href="produtos" class="sidebar-link"><i class="mdi mdi-note-plus"></i><span class="hide-menu"> Produtos </span></a></li>                                          
                        <?php if ($_SESSION['tipo'] == 1){?>  
                            <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="relatorios" aria-expanded="false"><i class="fab fa-wpforms"></i><span class="hide-menu">Relatórios</span></a></li>                      
                        <?php }?>       
                    </ul>                        
                </li>  
                <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="fas fa-warehouse"></i><span class="hide-menu">Estoque</span></a>
                    <ul aria-expanded="false" class="collapse  first-level">
                        <li class="sidebar-item"><a href="materiaPrima" class="sidebar-link"><i class="mdi mdi-note-outline"></i><span class="hide-menu"> Matéria Prima </span></a></li>
                        <li class="sidebar-item"><a href="pigmentos" class="sidebar-link"><i class="mdi mdi-note-plus"></i><span class="hide-menu"> Pigmentos </span></a></li>
                        <li class="sidebar-item"><a href="fornecedores" class="sidebar-link"><i class="mdi mdi-note-outline"></i><span class="hide-menu"> Fornecedores </span></a></li>
                    </ul>                        
                </li>                                                                                                                                   <!-- fas fa-clipboard-list -->
            </ul>
        </nav>
        <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
</aside>