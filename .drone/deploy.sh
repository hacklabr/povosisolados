#!/bin/bash
rsync -avzp src/* core@povosisolados.hacklab.com.br:/srv/www
ssh core@povosisolados.hacklab.com.br chmod -Rv og+w /srv/www/wp-content/uploads || echo ok
