<?php
//
// Created on: <22-Sen-2004 13:19:58 vs>
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

$Module = $Params['Module'];
$NodeID = $Params['NodeID'];

$curNode = eZContentObjectTreeNode::fetch( $NodeID );
if ( !$curNode )
    return $Module->handleError( eZError::KERNEL_NOT_AVAILABLE, 'kernel' );

if ( !$curNode->attribute( 'can_hide' ) )
    return $Module->handleError( eZError::KERNEL_ACCESS_DENIED, 'kernel' );

if ( $curNode->attribute( 'is_hidden' ) )
    eZContentObjectTreeNode::unhideSubTree( $curNode );
else
    eZContentObjectTreeNode::hideSubTree( $curNode );


//include_once( 'kernel/classes/ezredirectmanager.php' );
$hasRedirect = eZRedirectManager::redirectTo( $Module, false );
if ( !$hasRedirect )
{
    // redirect to the parent node
    if( ( $parentNodeID = $curNode->attribute( 'parent_node_id' ) ) == 1 )
        $redirectNodeID = $NodeID;
    else
        $redirectNodeID = $parentNodeID;
    return $Module->redirectToView( 'view', array( 'full', $redirectNodeID ) );
}

?>
