<?php

/*-------------------------------------------*/
/*  Load modules
/*-------------------------------------------*/
if ( ! class_exists( 'Vk_Admin' ) )
{
	require_once( 'vk-admin/class-vk-admin.php' );
}

global $vk_admin_textdomain;
$vk_admin_textdomain = 'vk-link-target-controller';
