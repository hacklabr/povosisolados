#!/bin/bash
rsync -azp src/* core@povosisolados.hacklab.com.br:/srv/www
chmod -R -v og+w src/wp-content/uploads
