<?php
//
// Created on: <21-Nov-2002 12:36:45 amos>
//
// SOFTWARE NAME: eZ Publish
// SOFTWARE RELEASE: 4.0.7
// BUILD VERSION: 24191
// COPYRIGHT NOTICE: Copyright (C) 1999-2008 eZ Systems AS
// SOFTWARE LICENSE: GNU General Public License v2.0
// NOTICE: >
//   This program is free software; you can redistribute it and/or
//   modify it under the terms of version 2.0  of the GNU General
//   Public License as published by the Free Software Foundation.
//
//   This program is distributed in the hope that it will be useful,
//   but WITHOUT ANY WARRANTY; without even the implied warranty of
//   MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
//   GNU General Public License for more details.
//
//   You should have received a copy of version 2.0 of the GNU General
//   Public License along with this program; if not, write to the Free
//   Software Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston,
//   MA 02110-1301, USA.
//
//

/*! \file function_definition.php
*/

$FunctionList = array();
$FunctionList['sitedesign_list'] = array( 'name' => 'sitedesign_list',
                                          'operation_types' => array( 'read' ),
                                          'call_method' => array( 'include_file' => 'kernel/layout/ezlayoutfunctioncollection.php',
                                                                  'class' => 'eZLayoutFunctionCollection',
                                                                  'method' => 'fetchSitedesignList' ),
                                          'parameter_type' => 'standard',
                                          'parameters' => array( ) );

?>
