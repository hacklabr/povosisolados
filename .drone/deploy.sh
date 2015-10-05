#!/bin/bash
echo 'fazendo rsync dos arquivos'
rsync -avzp src/* core@povosisolados.hacklab.com.br:/srv/www
echo 'acertando as permissões' 
ssh core@povosisolados.hacklab.com.br chmod -Rv og+w /srv/www/wp-content/uploads || echo ok
