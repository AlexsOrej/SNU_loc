<?php
require_once 'Models/Sessioncheck.php';
require_once 'Models/database.php';


class EnlacesController
{
   
    public function __CONSTRUCT()
    {
      
    }

    public function Index_enlaces()
    {
        require_once 'Views/Layout/default.php';
        require_once 'Views/Enlaces/index.php';
        require_once 'Views/Layout/foot.php';
    }
}