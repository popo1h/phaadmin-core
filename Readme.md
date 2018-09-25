## Action ##
模板:

    /**
     * @action-title title
     * @access-auth auth_name
     * @access-auth-class \namespace\auth_class_name
     * @access-auth-auto-by-action true
     * @require-auth auth_name1
     * @require-auth auth_name2
     * @require-auth-class \namespace\auth_name3_class_name
     * @doc-enable true
     * @doc-title doc_title
     * @doc-type post
     * @doc-param name=param_name type=string desc=description required=true in=formData
     * @doc-return path=data.list[] name=data_name desc=description
     * @doc-tag test
     * @doc-delete true
     */
    class ActionClass extends \Popo1h\PhaadminCore\Action
    {
        public static function getName()
        {
            return action_name;
        }
        
        public function doAction()
        {
            //TODO do action
            $postParamA = $this->request->getPostDataByName('a');
            
            return (new \Popo1h\PhaadminCore\Response\CommonResponse('content:' . $postParamA);
        }
    }

comment参数:

| comment-name | description |
|--------------|-------------|
| action-title | action的标题 |
| access-auth  | 访问action前需验证的权限名称, null为不验证 (access-auth类指定一种)(优先级1) |
| access-auth-class | 访问action前需验证的权限完整类名称, null为不验证 (access-auth类指定一种)(优先级2) |
| access-auth-auto-by-action | 值为true, 访问action前需验证的权限根据action自动生成 (access-auth类指定一种)(优先级3) |
| require-auth | 可配置多条, action使用到的额外权限 (doAction中使用checkAuth方法判断用户是否有该权限 |
| require-auth-class | 可配置多条, action使用到的额外权限完整类名称 (doAction中使用checkAuth方法判断用户是否有该权限 |
| doc-enable | 值为true, 生成接口文档 |
| doc-title | 接口标题, 不填则使用action-title |
| doc-type | 接口类型(生成文档用), post或get |
| doc-param | 接口参数信息(生成文档用), 配置为name=value的形式, 空格隔开 |
| doc-return | 接口返回信息(生成文档用), 配置为name=value的形式, 空格隔开 |
| doc-tag | 接口标签 |
| doc-delete | 值为true, 接口加删除线 |

doc-param配置参数:

| name | description |
|------|-------------|
| name | 参数名称(必填) |
| type | 参数类型, [integer, string, number, file:文件对象] |
| desc | 参数简介 |
| required | 是否必填, [true, false] |
| in   | 参数请求方式, 固定值formData, [formData:表单项] |

doc-return配置参数:

| name | description |
|------|-------------|
| path | 结果路径, 用.分隔, 其中[]结尾代表对应字段为数组格式, 如data.list[].obj代表的是{ data: { list: [ { obj: {这个位置} } ] } |
| name | 参数名称(必填) |
| type | 参数类型, [integer, string, number, object, array] |
| desc | 参数简介 |
