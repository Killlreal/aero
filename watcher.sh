dir=/usr/local/www/sites/aero.1mcg.ru/Sync
while inotifywait -qqr -e move -e create -e modify "$dir"; do
    sleep 300
    php /usr/local/www/sites/aero.1mcg.ru/parser/indexParser.php
done