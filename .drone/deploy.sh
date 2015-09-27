#!/bin/bash
rsync -avp src/* core@povosisolados.hacklab.com.br:/srv/www
chmod -R o+w src/wp-content/uploads
