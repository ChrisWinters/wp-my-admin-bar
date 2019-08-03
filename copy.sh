#!/bin/bash

# sudo chmod 755 copy.sh
# Set SLUG, MOVE_TO_PATH, & LOCAL_SOURCE
# Adjusted --exclude attributes as needed
# To run, type: ./copy.sh

# Copy Plugin Files To Wordpress
SLUG="wp-my-admin-bar"
MOVE_TO_PATH="/var/www/html/testing.localhost/wp-content/plugins/"
LOCAL_SOURCE="/home/gingerbot/Public/cw/$SLUG"

clear
printf "FROM: $LOCAL_SOURCE\n"
printf "TO: $MOVE_TO_PATH\n"

rsync -av --progress $LOCAL_SOURCE $MOVE_TO_PATH --exclude wp-my-admin-bar.zip --exclude .git --exclude .gitignore --exclude .gitattributes --exclude copy.sh --exclude README.md --exclude CHANGELOG.md --exclude package.json --exclude package-lock.json --exclude updates.json --exclude svn --exclude assets/css/bootstrap4 --exclude assets/css/scss --exclude assets/svn --exclude assets/psds --exclude gulpfile.js --exclude node_modules
