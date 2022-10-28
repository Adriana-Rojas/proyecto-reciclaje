<?php
/**
 *************************************************************************
 *************************************************************************
 Creado por:                 	Juan Carlos Escobar Baquero
 Correo electrónico:          	jcescobarba@gmail.com
 Creación:                    	27/02/2018
 Modificación:                	2019/11/06
 Propósito:						Página Web.
 *************************************************************************
 *************************************************************************
 ******************** BOGOTÁ COLOMBIA 2018 *******************************
 */
defined('BASEPATH') OR exit('No direct script access allowed');
?>

           				<!-- ============================================================== -->
                        <!-- User Profile -->
                        <!-- ============================================================== -->
                        <li class="nav-item dropdown u-pro">
                            <a class="nav-link dropdown-toggle waves-effect waves-dark profile-pic" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <img src="<?= base_url()?>assets/images/avatar.png" alt="user" class="">  
                            	<span class="hidden-md-down"><?= $NOMBRES." ".$APELLIDOS?> &nbsp;<i class="fa fa-angle-down"></i></span> </a>
                            <div class="dropdown-menu dropdown-menu-right animated flipInY">
                                <!-- text-->
                                <a href="<?= base_url()?>SystemUserDefine/profile/" class="dropdown-item"><i class="fa fa-user"></i> Perfil</a>
                                <!-- text-->
                                <!-- <a href="javascript:void(0)" class="dropdown-item"><i class="ti-wallet"></i> My Balance</a>-->
                                <!-- text-->
                                <!--<a href="javascript:void(0)" class="dropdown-item"><i class="ti-email"></i> Inbox</a>-->
                                <!-- text-->
                                <!--<div class="dropdown-divider"></div>-->
                                <!-- text-->
                                <!--<a href="javascript:void(0)" class="dropdown-item"><i class="ti-settings"></i> Account Setting</a>-->
                                <!-- text-->
                                <div class="dropdown-divider"></div>
                                <!-- text-->
                                <a href="<?= base_url()?>Login/logOut" class="dropdown-item"><i class="fa fa-power-off"></i> Logout</a>
                                <!-- text-->
                            </div>
                        </li>
                        <!-- ============================================================== -->
                        <!-- End User Profile -->
                        <!-- ============================================================== -->
                        <li class="nav-item right-side-toggle"> <a class="nav-link  waves-effect waves-light" href="<?= base_url()?>Login/logOut"><i class="fa fa-power-off"></i></a></li>
                    </ul>
                </div>
            </nav>
        </header>
        <!-- ============================================================== -->
        <!-- End Topbar header -->
        <!-- ============================================================== -->