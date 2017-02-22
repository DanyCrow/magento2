<?php
/**
 * Parameter to uses for Soap and Rest call.
 * Go in the Magento BackOffice to generate a soap token (in system > integration)
 *
 * @author    Laurent Minguet <lamin@smile.fr>
 * @copyright 2016 Smile
 */
$params = [
    'main_url' => 'http://magento2.loc/',
    'rest_account' => [
        'username' => 'admin',
        'password' => 'magent0',
    ],
    'soap_token' => '9m0kbni3inan035s9t8gcvuflyuo5th6',
    'exception_on_error' => false,
];
