#!/bin/bash
# bin/remote-setup.sh
# Run this via: ssh godaddy-hailerz 'bash -s' < bin/remote-setup.sh

echo "Running Remote Environment Setup..."

# Safety: Ensure we are in the right place
if [ ! -f "artisan" ]; then
    echo "Error: Artisan not found. Make sure you are in the ~/hailerz directory."
    exit 1
fi

# 1. Fix Symlinks
echo "Linking storage..."
php artisan storage:link --force

echo "Creating tiwa_link symlink for domain mapping..."
ln -sf /home/apa780681/hailerz/public /home/apa780681/public_html/tiwa_link

# 2. Standardize Permissions
# Files 644, Directories 755 is the GoDaddy 'Sweet Spot'
echo "Resetting file and folder permissions..."
find . -type f -exec chmod 644 {} \;
find . -type d -exec chmod 755 {} \;

# 3. Laravel Specific Writable Folders
# These must be 775 for the web server (Apache/Litespeed) to write logs/cache
echo "Opening storage and cache for writes..."
chmod -R 775 storage bootstrap/cache

echo "Server environment is now optimized for GoDaddy."
