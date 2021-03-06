<?php
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

class ezodfInfo
{
    static function info()
    {
        return array( 'Name' => 'eZ OpenOffice.org extension',
                      'Version' => '2.2.4',
                      'Copyright' => 'Copyright (C) 1999-' . date( 'Y' ) . ' eZ Systems AS',
                      'License' => 'GNU General Public License v2.0',
                      'Includes the following third-party software' => array( 'Name' => 'PhpConcept Library - Zip Module',
                                                                              'Version' => '2.4',
                                                                              'License' => 'GNU/LGPL - Vincent Blavet - November 2004',
                                                                              'For more information' => 'http://www.phpconcept.net' )
                      );
    }
}
?>
