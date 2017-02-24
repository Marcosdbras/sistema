#!/bin/bash
echo 'copiando arquivos anexos mapos'

scp -r  5834494b2d5271f7fe0000cb@sistema-marcosbras.rhcloud.com:app-root/repo/erp/assets/anexos   ~/bkp/anexos
scp -r  5834494b2d5271f7fe0000cb@sistema-marcosbras.rhcloud.com:app-root/repo/erp/assets/arquivos ~/bkp/arquivos
scp -r  5834494b2d5271f7fe0000cb@sistema-marcosbras.rhcloud.com:app-root/repo/erp/assets/uploads  ~/bkp/uploads



