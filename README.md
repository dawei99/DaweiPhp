
#### nginx重写配置

    location / {
    
       if (!-e $request_filename){
         rewrite ^/(.*) /index.php?d=$1 last;
         #break;
       }
    }