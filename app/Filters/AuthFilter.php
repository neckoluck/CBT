<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class AuthFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
    		
        if (session()->get('log') != true) :
            if ($request->uri->getSegment(1) == 'administrator') :
                return redirect()->to('/auth/administrator');

            elseif ($request->uri->getSegment(1) == 'staf') :
                return redirect()->to('/auth/staf');
   
    		elseif ($request->uri->getSegment(1) == 'skor') :
                return redirect()->to('/skor');
    
    		elseif ($request->uri->getSegment(1) == 'rekapan-peserta') :
    		
                return redirect()->to('/rekapan-peserta');

            else :
                return redirect()->to('/auth');

            endif;

        endif;
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        if (session()->get('log') == true) :
            if (session()->get('role') == 1) :
                return redirect()->to('/administrator');

            elseif (session()->get('role') == 2) :
                return redirect()->to('/staf');

            elseif (session()->get('role') == 3) :
                return redirect()->to('/peserta');

            else :
                return redirect()->back();

            endif;

        endif;
    }
}
