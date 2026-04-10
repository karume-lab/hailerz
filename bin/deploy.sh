#!/bin/bash
# bin/deploy.sh

# Exit immediately if a command exits with a non-zero status
set -e

echo "Starting Hailerz Deployment..."

# 1. Compile Assets Locally
echo "Building production assets (Vite)..."
npm run build

echo "Optimizing Composer dependencies..."
composer install --optimize-autoloader --no-dev

# 2. Package Payload
echo " Zipping project (excluding junk)..."
# We remove the old zip if it exists first
rm -f deploy.zip
zip -r deploy.zip . -x "node_modules/*" -x ".git/*" -x ".env" -x "storage/logs/*" -x "tests/*" -x "bin/*" -x "deploy.zip"

# 3. Upload to Server using SSH Alias
echo "Uploading to GoDaddy via godaddy-hailerz..."
scp deploy.zip godaddy-hailerz:/home/apa780681/

# 4. Remote Execution
echo " Extracting and clearing cache..."
# -T disables pseudo-terminal allocation to avoid 'tput' errors
# We use a heredoc to run multiple commands clearly
ssh -T godaddy-hailerz << 'EOF'
    cd hailerz
    unzip -o ../deploy.zip
    
    # Set production environment flags
    php artisan optimize
    php artisan filament:optimize
    
    # Cleanup the zip to save space
    rm ../deploy.zip
EOF

echo "Deployment Complete! Site is live."