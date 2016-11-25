<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

abstract class BaseController extends Controller
{
    protected $data = null;

    public function __construct()
    {
        $this->data = [
            'title' => 'Mỹ Phẩm Đẹp Rạng Ngời'
        ];
    }
}
