<?php
/**
 * Created by PhpStorm.
 * User: Ale
 * Date: 29/12/2016
 * Time: 11:19
 */

namespace Auth\Storage;
use Zend\Authentication\Storage\Session as SessionStorage;

class AuthStorage extends SessionStorage
{
    protected $session;

    /**
     * @param int $rememberMe
     * @param int $time
     */
    public function setRememberMe($rememberMe = 0, $time = 1209600) {
        if ($rememberMe == 1) {
            $this->session->getManager()->rememberMe($time);
        }
    }

    /**
     * Encerra a sessão
     */
    public function forgetMe() {
        $this->session->getManager()->forgetMe();
    }

    /**
     * @return O Id Da Sessão
     */
    public function getSessionId()
    {
        return $this->session->getManager()->getId();
    }
}