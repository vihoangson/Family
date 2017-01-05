# ============ ============  ============  ============ 
# 	Create folder
	mkdir asset/images/
	mkdir asset/images/thumb
	mkdir asset/images/trash
	mkdir asset/file_upload/
	mkdir asset/img_slide/
	chmod 777 asset/tmp

# ============ ============  ============  ============ 
# Run Composer
	composer install

# ============ ============  ============  ============ 
# Go to asset folder
	cd asset/
	bower install

# ============ ============  ============  ============ 
# Create db
	cd ..
	cd application/models
	mkdir db
	# If file don't exist
	if [ ! -f db/family ]; then
		cp db.sample/family db/
	fi

# ============ ============  ============  ============ 
# Create config file
	cd ../..
	# If file don't exist
	if [ ! -f application/config/family/config.php ]; then
		cp application/config/family/config.sample.php application/config/family/config.php
	fi
#
#  ============ ============  ============  ============

#  ============ ============  ============  ============
# Update Doctrine
php application/doctrine.php orm:schema-tool:update --force

#  ============ ============  ============  ============
# Testing
phpunit