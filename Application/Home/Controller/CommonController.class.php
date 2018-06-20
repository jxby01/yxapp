<?php
namespace Home\Controller;
use Think\Controller;
class CommonController extends Controller {
    public function index(){
        $this->show('欢迎','utf-8');
    }
}