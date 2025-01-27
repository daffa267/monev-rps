<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class RoleRedirect implements FilterInterface
{
    /**
     * Do whatever processing this filter needs to do.
     * By default it should not return anything during
     * normal execution. However, when an abnormal state
     * is found, it should return an instance of
     * CodeIgniter\HTTP\Response. If it does, script
     * execution will end and that Response will be
     * sent back to the client, allowing for error pages,
     * redirects, etc.
     *
     * @param RequestInterface $request
     * @param array|null       $arguments
     *
     * @return RequestInterface|ResponseInterface|string|void
     */
    public function before(RequestInterface $request, $arguments = null)
    {
        $auth = service('authentication');

        // Cek apakah pengguna sudah login
        if ($auth->check()) {
            $user = $auth->user();
            $role = $user->getRoles()[0] ?? ''; // Dapatkan peran utama

            // Arahkan berdasarkan role
            if ($role === 'dosen') {
                return redirect()->to('/dosen');
            } elseif ($role === 'gpm') {
                return redirect()->to('/gpm');
            } elseif ($role === 'admin') {
                return redirect()->to('/admin');
            } elseif ($role === 'kajur') {
                return redirect()->to('/kajur');
            }
        }
    }

    /**
     * Allows After filters to inspect and modify the response
     * object as needed. This method does not allow any way
     * to stop execution of other after filters, short of
     * throwing an Exception or Error.
     *
     * @param RequestInterface  $request
     * @param ResponseInterface $response
     * @param array|null        $arguments
     *
     * @return ResponseInterface|void
     */
    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        //
    }
}
