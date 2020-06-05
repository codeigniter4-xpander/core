<?php

namespace Xpander\Filters\Auth;

class WebAuth extends \Xpander\Filters\Auth
{
    public function before(\CodeIgniter\HTTP\RequestInterface $request, $params = null)
    {
        if (in_array('web', $params)) {
            if (in_array('outside', $params)) {
                if ($this->session->has('user')) {
                    return redirect('dashboard');
                }
            } elseif (in_array('inside', $params)) {
                if (!$this->session->has('user')) {
                    return redirect('login');
                }
            } else {
                $this->session->destroy();
                return redirect('login');
            }
        } else {
            $this->session->destroy();
            return redirect('login');
        }
    }
}
