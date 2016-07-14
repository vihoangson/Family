mkdir asset/images/
mkdir asset/file_upload/
composer install
cd asset/
bower install
cd application/models
mkdir db
cp db.sample/family db/
