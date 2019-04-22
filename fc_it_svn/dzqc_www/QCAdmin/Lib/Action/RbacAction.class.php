<?php

class RbacAction extends CommonAction{
	//添加角色页面
	public function addRole(){
		$this->display('saveRole');
	}
	//修改角色页面
	public function updateRole(){
		//根据id 得到角色信息
		$rid = I('get.rid','','int');
		$roleModel = D('AdminRole');
		$info = $roleModel->q_get($rid);
		$this->assign('info',$info);
		$this->display('saveRole');
	}
	//保存角色处理表单
	public function saveRoleHandle(){
		$data = I('post.');
		$id = $data['id'];
		$roleModel = D('AdminRole');
		if (empty($data['name'])){
			return $this->error('角色名不能为空');
		}
		if ($id){
			//修改角色
			$res = $roleModel->q_save($data,$id);
			if($res){
				return $this->q_success('修改角色成功',U('Rbac/roleList'),0);
			}else{
				return $this->q_error('修改角色失败',U('Rbac/roleList'),0);
			}
		}else{
			//添加角色
			$res = $roleModel->q_add($data);
			if($res){
				return $this->q_success('添加角色成功',U('Rbac/roleList'),0);
			}else{
				return $this->q_error('添加角色失败',U('Rbac/addRole'),0);
			}
		}

	}
	//角色管理列表
	public function roleList(){
		$roleModel = D('AdminRole');
		$role = $roleModel->q_getList('','id',1);
		//$this->q_pageList($this->role);
		$this->assign('role',$role);
		$this->display();
	}
	//删除角色
	public function deleteRole(){
		$id = I('get.id','','int');
		$r = D('AdminRoleUser')->where('role_id='.$id)->find();
		if ($r){
			return $this->error('改角色已经分配权限，不允许删除！',U('Rbac/roleList'));
		}else{
			$res = D('AdminAccess')->where('role_id='.$id)->delete();  //首先删除access表中数据
			if ($res){
				$roleModel = D('AdminRole');
				$ret = $roleModel->q_delete($id);
				if($ret){
					return $this->q_success('删除角色成功',U('Rbac/roleList'),0);
				}else{
					return $this->q_error('删除角色失败',U('Rbac/roleList'),0);
				}
			}else{
				return $this->q_error('删除角色失败',U('Rbac/roleList'),0);
			}
		}
	}
	/*************************************************************************/
	//添加节点页面
	public function addNode(){
		$nodeModel = D('AdminNode');
		$node = $nodeModel->q_gets('','level!=3');
		//echo $nodeModel->getLastSql();
		$this->assign('node',$node);
		$this->display('saveNode');
	}

	//修改节点页面
	public function updateNode(){
		$id = I('get.id','','int');
		$nodeModel = D('AdminNode');
		$node = $nodeModel->q_gets('','level!=3');
		$info = $nodeModel->q_get($id);

		$this->assign('node',$node);
		$this->assign('info',$info);
		$this->display('saveNode');
	}
	//编辑节点处理表单
	public function saveNodeHandle(){
		$data = I('post.');
		$id = $data['id'];
		$nodeModel = D('AdminNode');
		if (empty($data['name'])){
			return $this->error('节点名不能为空');
		}
		if (empty($data['title'])){
			return $this->error('中文名不能为空');
		}
		if ($id){
			//修改节点
			$res = $nodeModel->q_save($data,$id);
			if($res){
				return $this->q_success('修改节点成功',U('Rbac/nodeList'),0);
			}else{
				return $this->q_error('修改节点失败',U('Rbac/nodeList'),0);
			}
		}else{
			//添加节点
			$res = $nodeModel->q_add($data);
			if($res){
				return $this->q_success('添加节点成功',U('Rbac/nodeList'),0);
			}else{
				return $this->q_error('添加节点失败',U('Rbac/addNode'),0);
			}
		}

	}
	//节点管理列表
	public function nodeList(){
		//import('ORG.Util.Tree');
		$node = D('AdminNode')->order('sort')->select();
		//$this->node = Tree::create($node);
		//var_dump($this->node);
		$node = Common::create($node);
		$this->assign('node',$node);
		$this->display();
	}
	//删除节点
	public function deleteNode(){
		$nodeModel = D('AdminNode');
		$id = I('get.id','','int');
		$info = $nodeModel->q_get('','pid='.$id);  //查询是否含有子节点
		if ($info){
			return $this->error('您请求删除的节点存在子节点，不允许删除！');
		}else{
			$res = $nodeModel->q_delete($id);
			if($res){
				return $this->q_success('删除节点成功',U('Rbac/nodeList'),0);
			}else{
				return $this->q_error('删除节点失败',U('Rbac/nodeList'),0);
			}
		}
	}
	/*****************************************************************/
	//添加用户
	public function addUser(){
		$roleModel = D('AdminRole');
		$role = $roleModel->q_gets('','status=1');
		$this->assign('role',$role);
		$this->display('saveUser');
	}
	//修改用户
	public function updateUser(){
		$id = I('get.id','','int');
		$info = D('AdminRoleUser')->q_gets('','user_id='.$id);
		//echo D('AdminRoleUser')->getLastSql();
		$user = D('AdminUser')->where('id='.$id)->find();
		$roleModel = D('AdminRole');
		$role = $roleModel->q_gets('','status=1');

		$this->assign('id',$id);
		$this->assign('info',$info);
		$this->assign('user',$user);
		$this->assign('role',$role);
		$this->display('saveUser');
	}
	//编辑管理员处理表单
	public function saveUserHandle(){
//		$id = I('post.user_id','','int');
//		$data['username'] = I('post.username');
//		$data['password'] = I('post.password','','md5');
//		$data['repassword'] = I('post.repassword','','md5');
//		$data['state'] = I('post.state');
//		$arr_role['role_id'] = I('post.role_id');

		$data = I('post.');  //得到提交的原始数据
		
		$role_userModel = D('AdminRoleUser');
		$userModel = D('AdminUser');

		if (empty($data['username'])){
			return $this->error('用户名不能为空');
		}
		if (empty($data['password'])){
			return $this->error('密码不能为空');
		}
		if ($data['password']!=$data['repassword']){
			return $this->error('2次密码输入不一致');
		}

		$id = I('post.user_id','','int');
		$data['password'] = I('post.password','','md5'); //加密密码
		$arr_role['role_id'] = I('post.role_id');
		//var_dump($data);var_dump($arr_role);exit;
		if ($id){
			//修改管理员
			$user_res = $userModel->q_save($data,$id); //修改dzqc_admin_user表
			//echo $userModel->getLastSql();exit;
			//修改dzqc_admin_role_user表
			$role_userModel->q_delete('','user_id='.$id);  //1：删除dzqc_admin_role_user表的数据
				
			$role['user_id'] = $id;
			foreach ($arr_role['role_id'] as $v){
				//print_r($v);
				$role['role_id']=$v;
				$role_res = $role_userModel->add($role);  //重新添加用户角色
				//echo $role_userModel->getLastSql();die;
			}
				
			if ($role_res || $user_res){
				return $this->q_success('修改成功',U('Rbac/userList'),0);
			}else{
				return $this->q_error('修改失败',U('Rbac/userList'),0);
			}
		}else{
			//添加管理员
				
			$data['addtime'] = time();
			$data['loginip'] = get_client_ip();
			$uid = $userModel->add($data);
				
			if($uid){
				//用户添加成功后添加用户角色表
				$role['user_id'] = $uid;
				foreach ($arr_role['role_id'] as $v){
					$role['role_id']=$v;
					$role_userModel->add($role); //添加用户角色
					//echo $role_userModel->getLastSql();die;
				}
				return $this->q_success('添加成功',U('Rbac/userList'),0);
			}else{
				return $this->q_error('添加失败',U('Rbac/addUser'),0);
			}
		}

	}
	//用户管理列表
	public function userList(){
		$userModel = D('AdminUser');
		$roleModel = D('AdminRole');
		$role_userModel = D('AdminRoleUser');
		$user = $userModel->select();
		foreach ($user as $key=>$val){
			//多表查询该用户的角色id、name
			$info = $role_userModel->table('dzqc_admin_role_user u')->join('dzqc_admin_role r ON u.role_id=r.id')->field('r.id,r.name')->where('u.user_id='.$val['id'])->select();
			$role_name = '';
			foreach ($info as $row){
				$role_name .= ','.$row['name'];
				$role_name = trim($role_name,',');
			}
			$user[$key]['row'] = $role_name;
		}

		$this->assign('user',$user);
		$this->display();
	}

	//删除用户
	public function deleteUser(){
		$id = I('get.id','','int');

		$res = D('AdminRoleUser')->q_delete('','user_id='.$id);  //首先删除role_user表中数据
		if ($res){
			$ret = D('AdminUser')->q_delete($id); //在删除user表中数据
			if ($ret){
				return $this->q_success('删除用户成功',U('Rbac/userList'),0);
			}else{
				return $this->q_error('删除用户失败',U('Rbac/userList'),0);
			}
		}else{
			return $this->q_error('删除用户失败',U('Rbac/userList'),0);
		}


	}
	/**************************************************************/
	//配置权限
	public function access(){
		$rid = I('get.rid','',int);
		$nodeModel = D('AdminNode');
		//import('ORG.Util.Tree');
		$node = $nodeModel->order('sort')->select();
		//$node = Tree::create($node);
		$node = Common::create($node);
		$data = array();
		$access = D('AdminAccess');
		foreach($node as $k=>$v){
			$count = $access->where('role_id='.$rid.' and node_id='.$v['id'])->count();
			//echo $access->getLastSql();
			if($count){
				$v['access']=1;
			}else{
				$v['access']=0;
			}
			$data[]=$v;
				
		}
		$nodeList = $data;
		//var_dump($data);
		$rid = $rid;
		$roleModel = D('AdminRole');
		$name = $roleModel->getFieldById($rid,'name');

		$this->assign('nodeList',$data);
		$this->assign('rid',$rid);
		$this->assign('name',$name);
		$this->display();
	}
	//分配权限
	public function accessHandle(){
		$rid = I('rid','','int');
		$access = D('AdminAccess');
		$access->where('role_id='.$rid)->delete();  //清空当前角色的所有权限
		//var_dump($_POST);
		if (isset($_POST['access'])){
			//			var_dump($_POST['access']);
			$data = array();
			foreach ($_POST['access'] as $val){
				$tmp = explode('_', $val);
				$data[]= array(
					'role_id' => $rid,
					'node_id' => $tmp[0],
					'level'   => $tmp[1]
				);
			}
			if ($access->addAll($data)){
				return $this->success('添加成功',U('Rbac/roleList'));
			}else{
				return $this->error('添加失败');
			}
		}else{
			return $this->error('修改失败');
		}
	}

}
