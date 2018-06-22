<?php
namespace Admin\Controller;
use Think\Controller;
class SystemsController extends CommonController{
    public function set_up(){
        $con = file_get_contents('Public/Admin/data/admin_config.php');
        $cons = substr($con, 6);
        preg_match_all('/\/\/[\s\S]*?\/\/\}/i', $cons, $match);
        foreach ($match[0] as $v) {
            $str = substr($v, 0, -3);
            $row[] = $str;
        }
        foreach ($row as $k => $val) {
            $evals = "return array(
			$val
			);";
            $rows[$k][] = eval($evals);
            preg_match_all('/(?<=\/\/)[\s\S]*?(?=\n)/i', $val, $match);
            $match[0][0] = substr($match[0][0], 0, -2);
        }
        $this->assign('rows',$rows[0][0]);
        $this->view();
    }

    /**
     * 各种后台开关
     */
    public function if_log(){
       if(!empty($_POST)){
            $states = $_POST['state'];//开启的状态
            $statesname = $_POST['statename'];//需开启的名称
            $con = file_get_contents('Public/Admin/data/admin_config.php');
            $cons = substr($con, 6);
            preg_match_all('/\/\/[\s\S]*?\/\/\}/i', $cons, $match);
            foreach ($match[0] as $v) {
                $str = substr($v, 0, -3);
                $row[] = $str;
            }
            foreach ($row as $k => $val) {
                $evals = "return array(
			$val
			);";
                $rows[$k][] = eval($evals);
                preg_match_all('/(?<=\/\/)[\s\S]*?(?=\n)/i', $val, $match);
                $match[0][0] = substr($match[0][0], 0, -2);
            }
            $rows[0][0][$statesname] = $states;
            foreach($rows[0][0] as $key=>$val){
                $str=$key."'=>'";
                $con=preg_replace("/(?<=$str).*?(?=')/i",$val,$con);
            }
            $con=file_put_contents("Public/Admin/data/admin_config.php",$con);
            echo 1;
       }else{
            echo 0;
       }
    }

    /**
     * 查看各种开关的开启状态
     */
    public function now_log_state(){
        $con = file_get_contents('Public/Admin/data/admin_config.php');
        $cons = substr($con, 6);
        preg_match_all('/\/\/[\s\S]*?\/\/\}/i', $cons, $match);
        foreach ($match[0] as $v) {
            $str = substr($v, 0, -3);
            $row[] = $str;
        }
        foreach ($row as $k => $val) {
            $evals = "return array(
			$val
			);";
            $rows[$k][] = eval($evals);
            preg_match_all('/(?<=\/\/)[\s\S]*?(?=\n)/i', $val, $match);
            $match[0][0] = substr($match[0][0], 0, -2);
        }
        $this->ajaxReturn($rows[0][0]);
    }

    /**
     * 加载日志
     */
    public function proview_logs(){
        $this->view();
    }

    /**
     * 读取日志文件
     */
    public function read_log(){

            $file = fopen("./public/log/txlog/admin_logs.txt", "r");
            $user=array();
            $i=0;
            //输出文本中所有的行，直到文件结束为止。
            while(! feof($file))
            {
                $user[$i]= fgets($file);//fgets()函数从文件指针中读取一行
                $i++;
            }
            fclose($file);
            $user=array_filter($user);
            $data = array();
           foreach ($user as $k=>$v){
               $data[$k] =  json_decode($v);
           }
          exit(json_encode(array('code'=>0,'msg'=>'SUCCESS','data'=>$data)));

    }

}

?>