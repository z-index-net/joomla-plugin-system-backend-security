<?php
/**
 * @author     mediahof, Kiel-Germany
 * @link       http://www.mediahof.de
 * @copyright  Copyright (C) 2011 - 2013 mediahof. All rights reserved.
 * @license    GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 */

defined('_JEXEC') or die;

class plgSystemBackend_security extends JPlugin {

    function __construct(&$subject, $config) {
        parent::__construct($subject, $config);
        
        $app = JFactory::getApplication();
        $session = JFactory::getSession();
        
        if(!$app->isAdmin()) { 
            return;
        }
        
        $key = $session->get('backend_security');
        
        if(empty($key)) {
            if(JFactory::getUser()->guest && $this->params->get('key') != $_SERVER['QUERY_STRING']) {
                $app->redirect(JURI::root());
            } else {
                $session->set('backend_security', 1);
        }
        }
    }
}