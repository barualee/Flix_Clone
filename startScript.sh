#!/bin/bash
/opt/lampp/lampp start
sleep 5
/opt/lampp/bin/mysql -u root < /opt/lampp/htdocs/higherflix/higherflix.sql