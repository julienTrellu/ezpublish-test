<?php
//
// Definition of eZStepSecurity class
//
// Created on: <13-Aug-2003 10:42:32 kk>
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

/*! \file ezstep_security.php
*/
//include_once( 'kernel/setup/steps/ezstep_installer.php');
require_once( "kernel/common/i18n.php" );

/*!
  \class eZStepSecurity ezstep_security.php
  \brief The class eZStepSecurity does

*/

class eZStepSecurity extends eZStepInstaller
{
    /*!
     Constructor
    */
    function eZStepSecurity( $tpl, $http, $ini, &$persistenceList )
    {
        $this->eZStepInstaller( $tpl, $http, $ini, $persistenceList,
                                'security', 'Security' );
    }

    /*!
     \reimp
    */
    function processPostData()
    {
        return true; // Always continue
    }

    /*!
     \reimp
     */
    function init()
    {
        if ( $this->hasKickstartData() )
        {
            $data = $this->kickstartData();

            return $this->kickstartContinueNextStep();
        }

        if ( file_exists( '.htaccess' ) )
        {
            return true;
        }
        //include_once( 'lib/ezutils/classes/ezsys.php' );
        return eZSys::indexFileName() == '' ; // If in virtual host mode, continue (return true)
    }

    /*!
     \reimp
    */
    function display()
    {
        $this->Tpl->setVariable( 'setup_previous_step', 'Security' );
        $this->Tpl->setVariable( 'setup_next_step', 'Registration' );

        $this->Tpl->setVariable( 'path', realpath( '.' ) );

        // Return template and data to be shown
        $result = array();
        // Display template
        $result['content'] = $this->Tpl->fetch( 'design:setup/init/security.tpl' );
        $result['path'] = array( array( 'text' => ezi18n( 'design/standard/setup/init',
                                                          'Securing site' ),
                                        'url' => false ) );
        return $result;
    }
}

?>
