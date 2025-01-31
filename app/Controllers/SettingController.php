<?php

namespace App\Controllers;

use App\Models\SettingModel;

class SettingController extends BaseController
{
    public function index()
    {
        $setting = new SettingModel();
        $data['setting'] = $setting->asObject()->find(1);
        return view('setting/index', $data);
    }

    public function save()
    {
        $setting = new SettingModel();
        $post = $this->request->getPost();
        $data = [
            "about_content" => $post['about_content'],
            "footer_content" => $post['footer_content']
        ];

        $setting->where('id', 1)->set($data)->update();

        return redirect()->to('admin/setting')->withInput()->with('success_message', 'data berhasil diubah.');
    }
}
