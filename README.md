# phalcon-server
> - 以phalcon框架作为服务代码模板，包含api模块及cli模块，controller仅作预留
> - api模块接口有版本划分，支持restful
> - cli模块用于命令行，可用于处理耗时任务，定时任务等
> - 使用composer替代框架autoload

## 依赖
- PHP 7.2+
- composer

## 使用
- 下载完成后需运行 `composer install`
- 修改`web.ini`或`app/config/config.php`文件配置（web.ini中内容会覆盖后者）
- 项目没有视图层，需设置services_web中view，设置config中cache路径并增加cache目录
- api模块下需指定版本`v([0-9]+)`，支持版本下增加文件夹（表示module），路由为`/api/:version/[:module/]/:controller/:action`
- api模块下action支持指定`method`，如`index->indexPost`，访问路径为`curl -X POST /api/v1/index/index`（`curl -X GET /api/v1/index/indexPost`也有效）

## 验证
- 网页访问：`curl http://xxxx/api/v1/test`
- 命令行(项目根目录)：`php run`

## 更新
**v2.0.0** 2020-04-28
- 删除`BaseModel|Tool`等公共类
- 去除`app\helpers\Exception\*`异常类
- 去除框架loader方式，使用composer自动加载
- 去除全局变量`PROJECT_NAME|MODE_NAME`
- `api`模块增加目录结构，可按照模块增加文件夹（原有方式兼容，新方式优先，详见示例）
- `BaseApi`直接继承`BaseController`
- `BaseApi`类增加前置方法`_initialize`
- `BaseApi`类增加`apiRouter`成员变量，可获取最终运行类及方法名
- `BaseApi`类中`checkMethod`去除异常，返回bool
- `config.php`中增加`exceptionHandle`参数，用于捕捉异常类
- `helpers`目录移动到`common`下
- 更改控制器类返回方法出入参
- 去除`PROJECT_NAME|MODE_NAME`等全局变量

**v1.1.2** 2020-03-30
- 依赖注入直接引入`Injectable`

**v1.1.1** 2019-10-22
- 修复异常捕捉方法code问题
- 去除异常捕捉时自动回滚（未使用数据库时有额外开销）

**v1.1.0** 2019-10-18
- 更改BaseApi获取依赖注入方式