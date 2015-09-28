#!/bin/bash
rsync -azp src/* core@povosisolados.hacklab.com.br:/srv/www
ssh core@povosisolados.hacklab.com.br chmod -R og+w /srv/www/wp-content/uploads || echo ok
