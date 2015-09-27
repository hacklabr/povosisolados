#!/bin/bash
rsync -avp src/* core@povosisolados.hacklab.com.br:/srv/www
chmod -R 777 src/wp-content/uploads
