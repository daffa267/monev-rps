<?php

namespace App\Controllers;

use App\Models\UnsurModel;
use Myth\Auth\Models\UserModel;
use App\Models\UserDetailsModel;
use App\Models\FakultasModel;
use App\Models\AuthGroupsModel;
use App\Models\JurusanModel;
use App\Models\AuthGroupsUsersModel;
use Myth\Auth\Entities\User;

class AdminController extends BaseController
{
    protected $unsur;
    protected $user;
    protected $userdetail;
    protected $fakultas;
    protected $auth;
    protected $auths;
    protected $authgroup;
    protected $jurusan;

    public function __construct()
    {
        $this->unsur = new UnsurModel();
        $this->user = new UserModel();
        $this->userdetail = new UserDetailsModel();
        $this->fakultas = new FakultasModel();
        $this->auth = new User();
        $this->auths = new AuthGroupsModel();
        $this->authgroup = new AuthGroupsUsersModel();
        $this->jurusan = new JurusanModel();
    }

    public function index(): string
    {
        return view('admin-db/admin');
    }

    public function akun(): string
    {
        $data['users'] = $this->user->getUserWithRole();
        return view('admin-db/akun', $data);
    }

    public function rps()
    {
        $data['unsur_rps'] = $this->unsur->findAll();
        return view('admin-db/rps', $data);
    }

    // CREATE
    public function tambah()
    {
        $fakultas = $this->fakultas->findAll();
        $jurusan = $this->jurusan->findAll();
        $roles = $this->auths->findAll();

        return view('admin-db/tambah', [
            'fakultas' => $fakultas,
            'jurusan' => $jurusan,
            'roles' => $roles,
        ]);
    }

    // CREATE
    public function adduser()
    {
        if (!$this->validate([
            'username' => 'required',
            'email' => 'required|valid_email',
            'password' => 'required|min_length[8]',
            'nama' => 'required',
            'nidn' => 'required',
            'fakultas_id' => 'required',
            'jurusan_id' => 'required',
            'role_id' => 'required',
        ])) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $dataUser = new User();
        $dataUser->username = $this->request->getPost('username');
        $dataUser->email = $this->request->getPost('email');
        $dataUser->setPassword($this->request->getPost('password'));
        $dataUser->active = 1;

        if ($this->user->save($dataUser)) {
            $userId = $this->user->getInsertID();

            $dataUserDetails = [
                'user_id' => $userId,
                'nama' => $this->request->getPost('nama'),
                'nidn' => $this->request->getPost('nidn'),
                'fakultas_id' => $this->request->getPost('fakultas_id'),
                'jurusan_id' => $this->request->getPost('jurusan_id'),
            ];

            if ($this->userdetail->save($dataUserDetails)) {
                $roleId = $this->request->getPost('role_id');
                $dataAuthGroup = [
                    'user_id' => $userId,
                    'group_id' => $roleId,
                ];

                if ($this->authgroup->save($dataAuthGroup)) {
                    return redirect()->to('/akun')->with('message', 'Pengguna berhasil ditambahkan');
                } else {
                    return redirect()->back()->withInput()->with('errors', 'Gagal menambahkan pengguna ke grup');
                }
            } else {
                return redirect()->back()->withInput()->with('errors', 'Gagal menambahkan detail pengguna');
            }
        } else {
            return redirect()->back()->withInput()->with('errors', 'Gagal menambahkan pengguna');
        }
    }

    // CREATE
    public function tambahrp(): string
    {
        return view('admin-db/tambahrp');
    }

    public function addrp()
    {
        $data = [
            'unsur' => $this->request->getPost('unsur'),
            'keterangan' => $this->request->getPost('keterangan')
        ];
        if ($this->validate([
            'unsur' => 'required'
        ])) {
            $this->unsur->save($data);
            return redirect()->to('/rps')->with('message', 'Data berhasil disimpan');
        } else {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }
    }

    // UPDATE
    public function edit($id = null)
    {
        $user = $this->user->find($id);
        if (!$user) {
            return redirect()->back()->with('errors', 'Pengguna tidak ditemukan');
        }

        $userDetail = $this->userdetail->where('user_id', $id)->first();
        if (!$userDetail) {
            return redirect()->back()->with('errors', 'Detail pengguna tidak ditemukan');
        }

        $data = [
            'user' => $user,
            'userdetail' => $userDetail,
            'fakultas' => $this->fakultas->findAll(),
            'jurusan' => $this->jurusan->findAll(),
            'roles' => $this->auths->findAll()
        ];

        return view('admin-db/edit', $data);
    }

    public function updateUser($id = null)
    {
        if (!$this->validate([
            'username' => 'required',
            'email' => 'required|valid_email',
            'nama' => 'required',
            'nidn' => 'required',
            'fakultas_id' => 'required',
            'jurusan_id' => 'required',
            'role_id' => 'required',
        ])) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $dataUser = [
            'username' => $this->request->getPost('username'),
            'email' => $this->request->getPost('email'),
        ];

        $this->user->update($id, $dataUser);

        $dataUserDetail = [
            'nama' => $this->request->getPost('nama'),
            'nidn' => $this->request->getPost('nidn'),
            'fakultas_id' => $this->request->getPost('fakultas_id'),
            'jurusan_id' => $this->request->getPost('jurusan_id'),
        ];

        $this->userdetail->where('user_id', $id)->set($dataUserDetail)->update();

        $roleId = $this->request->getPost('role_id');
        $this->authgroup->where('user_id', $id)->set(['group_id' => $roleId])->update();

        return redirect()->to('/akun')->with('message', 'Pengguna berhasil diperbarui');
    }

    // DELETE
    public function deleteuser($id = null)
    {
        $this->user->where('id', $id)->delete();
        return redirect()->to('/akun')->with('message', 'Data berhasil dihapus');
    }

    public function editrp($id = null)
    {
        $data['unsurs'] = $this->unsur->where('id_unsur', $id)->first();
        if (!$data['unsurs']) {
            return redirect()->back()->with('errors', 'Unsur tidak ditemukan');
        }
        return view('admin-db/editrp', $data);
    }

    public function updaterp($id = null)
    {
        $data = [
            'unsur' => $this->request->getPost('unsur'),
            'keterangan' => $this->request->getPost('keterangan')
        ];
        if ($this->validate([
            'unsur' => 'required'

        ])) {
            $this->unsur->update($id, $data);
            return redirect()->to('/rps')->with('message', 'Data berhasil diperbaharui');
        } else {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }
    }

    public function deleterp($id = null)
    {
        $this->unsur->where('id_unsur', $id)->delete();
        return redirect()->to('/rps')->with('message', 'Data berhasil dihapus');
    }

    public function profil(): string
    {
        return view('admin-db/profil');
    }

    public function notif(): string
    {
        return view('admin-db/notif');
    }
}
