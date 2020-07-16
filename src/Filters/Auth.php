<?php

namespace CI4Xpander\Filters;

class Auth implements \CodeIgniter\Filters\FilterInterface
{
    /**
     * @var \CodeIgniter\Session\Session
     */
    protected $session;

    public function __construct()
    {
        $this->session = \Config\Services::session();
    }

    public function before(\CodeIgniter\HTTP\RequestInterface $request, $params = null)
    {

    }

    public function after(\CodeIgniter\HTTP\RequestInterface $request, \CodeIgniter\HTTP\ResponseInterface $response, $params = null)
    {

    }
}
