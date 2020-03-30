#### nginx重写配置

    location / {
       if (!-e $request_filename){
         rewrite ^/(.*) /index.php?d=$1 last;
         #break;
       }
    }
    
#### 目录结构
    
    common/                   公共目录
        |- config/            配置目录
    controllers/              控制器目录
    core/                     核心目录
        |- components/        系统组件目录
            |- constraints    组件约束目录
    views/                    试图目录
    web/                      网站入口目录
    