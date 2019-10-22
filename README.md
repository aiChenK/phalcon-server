# phalcon-server
> 以phalcon框架作为服务代码模板，包含api模块及cli模块，controller仅作预留
> api模块接口有版本划分，支持restful
> cli模块用于命令行，可用于处理耗时任务，定时任务等

## 依赖
- PHP 7.2+
- composer

## 使用
- 下载完成后需运行 `composer install`
- 修改web.ini文件中配置，配置可以从$di中获取
- `app\helpers\BaseModel` 中包含了 `beforeCreate|beforeUpdate|beforeDelete|softDelete`等事件，需修改对应字段
- 项目没有视图层，需设置services_web中view，设置config中cache路径并增加cache目录

## 验证
- 网页访问：`curl http://xxxx/api/v1/test`
- 命令行(项目根目录)：`php run`

## 更新
**v1.1.1** 2019-10-22
- 修复异常捕捉方法code问题
- 去除异常捕捉时自动回滚（未使用数据库时有额外开销）

**v1.1.0** 2019-10-18
- 更改BaseApi获取依赖注入方式