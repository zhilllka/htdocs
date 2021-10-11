<?php

namespace cp;

class route
{
    public function __construct($authKey = NULL)
    {
        $this->authKey = $authKey;
        $this->db = $GLOBALS['db'];
    }



    private function routeNow ()
    {
        $routeNow = new profile($this->authKey);
        $routeNow = $routeNow->get_info_with_db('routeNow');
        $routeNow = $routeNow['routeNow'];
        return $routeNow;
    }



    private function update_routes ($to)
    {
        $update_route_prev = $this->db->query("UPDATE users SET routePrev = '".$this->routeNow()."' WHERE authKey='".$this->authKey."'", 30);
        $update_route_now = $this->db->query("UPDATE users SET routeNow = '".$to."' WHERE authKey='".$this->authKey."'", 30);
    }



    public function go ($to = NULL)
    {
        if ($to !== NULL)
        {
            if (isset($this->authKey))
            {
                $this->update_routes($to);
                $route =  'version/'.$_SESSION['user']['authVersion'].'/system/pages/'.$to.'.php';
            }
            else
            {
                $route =  'version/stable/system/pages/'.$to.'.php';
            }
        }
        else
        {
            if (isset($this->authKey))
            {
                //$this->update_routes($to);
                $route = 'version/'.$_SESSION['user']['authVersion'].'/system/pages/'.$_SESSION['user']['routeNow'].'.php';
            }
            else
            {
                $route = 'version/stable/system/pages/sign/in.php';
            }
        }


        if (file_exists($route))
        {
            return $route;
        }
        else
        {
            $error = new error();
            $error->view('there_is_no_such_page');
            $route = $this->go();
            return $route;
        }


    }
}