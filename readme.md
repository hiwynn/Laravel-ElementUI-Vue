# Laravel-ElementUI-Vue

###### 这是一个后端语言使用 Laravel，前端语言使用 Vue，UI框架使用 ElementUI 的电话查询系统。
###### 具有对电话增删改查的功能和用户管理的功能。

---

## 如何使项目在本地运行起来？
* 把项目下载至本地并配置好虚拟服务地址
* 在项目的根目录下执行 <code>npm install</code> 和 <code>composer install</code> 安装项目所需的依赖
* 在项目的根目录下执行 <code>php artisan migrate</code> 生成数据库表和字段
* 在项目的根目录下执行 <code>php artisan db:seed --class=UsersTableSeeder</code> 和 <code>php artisan db:seed --class=RolesTableSeeder</code> 生成必要的数据

这时已经有了一个超级管理员的账号：cjgly@gmail.com 密码：secret

---

## 用户角色这样设定：
* 提供用户登录、注册的接口和页面（注册的用户都是普通用户 roleId = 3 && is_active = 0）
* 用户注册之后不能直接使用，需要超级管理员激活（is_active = 1）之后才能使用
* 上面已使用 seed 为 users 表添加一条数据（超级管理员）
* 有且只有超级管理员可以进入用户管理的界面 更改其他用户的角色（role）
* role 分为三种： 
    > * 超级管理员（roleId = 1） 可以增删改查 可以进入用户管理界面编辑其他用户的角色
    > * 管理员（roleId = 2） 可以增删改查 
    > * 用户（roleId = 3） 只可以查

