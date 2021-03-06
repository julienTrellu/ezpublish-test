<?php
//
// Created on: <22-Aug-2002 16:38:41 sp>
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

/*! \file view.php
*/

//include_once( 'kernel/classes/ezmodulemanager.php' );
//include_once( 'kernel/classes/ezrole.php' );
//include_once( 'kernel/classes/ezsearch.php' );
//include_once( 'kernel/classes/ezcontentbrowse.php' );
//include_once( 'lib/ezutils/classes/ezhttptool.php' );
//include_once( 'lib/ezutils/classes/ezhttppersistence.php' );
//include_once( 'lib/ezutils/classes/ezmodule.php' );
//include_once( 'kernel/classes/ezcontentobjecttreenode.php' );

require_once( 'kernel/common/template.php' );

$http = eZHTTPTool::instance();
$Module = $Params['Module'];
$roleID = $Params['RoleID'];

$role = eZRole::fetch( $roleID );

if ( !$role )
{
    $Module->redirectTo( '/role/list/' );
    return;
}

// Redirect to role edit
if ( $http->hasPostVariable( 'EditRoleButton' ) )
{
    $Module->redirectTo( '/role/edit/' . $roleID );
    return;
}

// Redirect to content node browse in the user tree
if ( $http->hasPostVariable( 'AssignRoleButton' ) )
{
    //include_once( 'kernel/classes/ezcontentbrowse.php' );
    eZContentBrowse::browse( array( 'action_name' => 'AssignRole',
                                    'from_page' => '/role/assign/' . $roleID,
                                    'cancel_page' => '/role/view/'. $roleID ),
                             $Module );

    return;
}
else if ( $http->hasPostVariable( 'AssignRoleLimitedButton' ) )
{
    $Module->redirectTo( '/role/assign/' . $roleID . '/' . $http->postVariable( 'AssignRoleType' ) );
    return;
}

// Assign the role for a user or group
if ( $Module->isCurrentAction( 'AssignRole' ) )
{
    $selectedObjectIDArray = eZContentBrowse::result( 'AssignRole' );

    $assignedUserIDArray = $role->fetchUserID();

    $db = eZDB::instance();
    $db->begin();
    foreach ( $selectedObjectIDArray as $objectID )
    {
        if ( !in_array(  $objectID, $assignedUserIDArray ) )
        {
            $role->assignToUser( $objectID );
        }
    }
    /* Clean up policy cache */
    //include_once( 'kernel/classes/datatypes/ezuser/ezuser.php' );
    eZUser::cleanupCache();

    // Clear role caches.
    eZRole::expireCache();

    // Clear all content cache.
    //include_once( 'kernel/classes/ezcontentcachemanager.php' );
    eZContentCacheManager::clearAllContentCache();

    $db->commit();
}

// Remove the role assignment
if ( $http->hasPostVariable( 'RemoveRoleAssignmentButton' ) )
{
    $idArray = $http->postVariable( "IDArray" );

    $db = eZDB::instance();
    $db->begin();
    foreach ( $idArray as $id )
    {
        $role->removeUserAssignmentByID( $id );
    }
    /* Clean up policy cache */
    //include_once( 'kernel/classes/datatypes/ezuser/ezuser.php' );
    eZUser::cleanupCache();

    // Clear role caches.
    eZRole::expireCache();

    // Clear all content cache.
    //include_once( 'kernel/classes/ezcontentcachemanager.php' );
    eZContentCacheManager::clearAllContentCache();

    $db->commit();
}

$tpl = templateInit();

$userArray = $role->fetchUserByRole();

$policies = $role->attribute( 'policies' );
$tpl->setVariable( 'policies', $policies );
$tpl->setVariable( 'module', $Module );
$tpl->setVariable( 'role', $role );

$tpl->setVariable( 'user_array', $userArray );

$Module->setTitle( 'View role - ' . $role->attribute( 'name' ) );

$Result = array();
$Result['content'] = $tpl->fetch( 'design:role/view.tpl' );
$Result['path'] = array( array( 'text' => 'Role',
                                'url' => 'role/list' ),
                         array( 'text' => $role->attribute( 'name' ),
                                'url' => false ) );

?>
