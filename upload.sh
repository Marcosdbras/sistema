#!/bin/bash
echo 'copiando arquivos anexos mapos de servidor openshift para local...'

scp -r  5834494b2d5271f7fe0000cb@sistema-marcosbras.rhcloud.com:app-root/repo/erp/assets/anexos   ~/bkp/
scp -r  5834494b2d5271f7fe0000cb@sistema-marcosbras.rhcloud.com:app-root/repo/erp/assets/arquivos ~/bkp/
scp -r  5834494b2d5271f7fe0000cb@sistema-marcosbras.rhcloud.com:app-root/repo/erp/assets/uploads  ~/bkp/

echo 'realizando uploads via gitbash...'
cd ~/php-sistema
git add .
git commit -m "upload alteracao padrao"
git push origin master


echo 'retornando arquivos anexos mapos de local para servidor openshift'
scp -r  ~/bkp/anexos    5834494b2d5271f7fe0000cb@sistema-marcosbras.rhcloud.com:app-root/repo/erp/assets/   
scp -r  ~/bkp/arquivos  5834494b2d5271f7fe0000cb@sistema-marcosbras.rhcloud.com:app-root/repo/erp/assets/ 
scp -r  ~/bkp/uploads   5834494b2d5271f7fe0000cb@sistema-marcosbras.rhcloud.com:app-root/repo/erp/assets/  





