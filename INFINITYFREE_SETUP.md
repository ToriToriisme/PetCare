# InfinityFree Setup Guide - PetCare Website

## ✅ Why InfinityFree is Perfect for Your Project

- ✅ **Free PHP hosting** - Full PHP 7.4+ support
- ✅ **Free MySQL database** - Up to 50MB (enough for your project)
- ✅ **No credit card required**
- ✅ **Easy setup** - Similar to XAMPP
- ✅ **cPanel access** - Familiar interface

## 📝 Step-by-Step Setup

### 1. Sign Up at InfinityFree
- Go to: https://www.infinityfree.net/
- Click "Sign Up" (free)
- Verify your email

### 2. Choose Your Subdomain

**Recommended subdomain names:**
- `petcare` (best choice - simple and memorable)
- `trungtamthuy` (Vietnamese name)
- `petcare-vet` (clear and professional)
- `petcare-clinic` (descriptive)

**Domain extension options:**
- `petcare.great-site.net` ✅
- `petcare.rf.gd` ✅
- `petcare.ml` ✅

### 3. Create Your Account
1. Click "Create Account"
2. Enter your subdomain (e.g., `petcare`)
3. Choose domain extension (e.g., `great-site.net`)
4. Click "Check Availability"
5. Complete registration

### 4. Access cPanel
1. Log in to InfinityFree
2. Go to "Control Panel"
3. Click "Login to cPanel"

### 5. Upload Your Files
**Option A: Using cPanel File Manager**
1. In cPanel, open "File Manager"
2. Navigate to `htdocs` or `public_html` folder
3. Upload all your project files (zip first, then extract)

**Option B: Using FTP**
- **FTP Host:** `ftpupload.net` or your assigned host
- **FTP Username:** (provided in cPanel)
- **FTP Password:** (your account password)
- **Port:** 21

### 6. Create MySQL Database
1. In cPanel, find "MySQL Databases"
2. Create new database: `petcare_db` (or any name)
3. Create database user
4. Add user to database with ALL PRIVILEGES
5. Note down:
   - Database name: `epiz_xxxxx_petcare_db`
   - Database user: `epiz_xxxxx_dbuser`
   - Database password: (your password)
   - Database host: `sqlXXX.epizy.com` (usually)

### 7. Update Database Configuration

Edit `config/db.php` with your InfinityFree database details:

```php
// Database configuration for InfinityFree
define('DB_HOST', 'sqlXXX.epizy.com');  // Your InfinityFree MySQL host
define('DB_USER', 'epiz_xxxxx_dbuser');  // Your database username
define('DB_PASS', 'your_password');      // Your database password
define('DB_NAME', 'epiz_xxxxx_petcare_db'); // Your database name
```

### 8. Import Your Database
1. In cPanel, open "phpMyAdmin"
2. Select your database
3. Click "Import" tab
4. Choose file: `database/schema.sql`
5. Click "Go"

### 9. Test Your Website
Visit: `https://petcare.great-site.net` (or your chosen subdomain)

## ⚙️ Important Configuration Notes

### File Permissions
- Make sure `uploads/` folder (if exists) has write permissions (755)
- Images folder should be readable (644)

### PHP Version
- InfinityFree supports PHP 7.4, 8.0, 8.1
- Check in cPanel → Select PHP Version

### .htaccess File
Your existing `.htaccess` should work, but verify:
- RewriteEngine is enabled
- All paths are correct

### Session Configuration
- Sessions should work automatically
- If issues, check `php.ini` in cPanel

## 🔒 Security Tips

1. **Change default passwords** immediately
2. **Keep database credentials secure** - don't commit to GitHub
3. **Use strong passwords** for database
4. **Regular backups** - InfinityFree provides backup tools

## 📊 InfinityFree Limits (Free Plan)

- **Storage:** 5GB
- **Bandwidth:** Unlimited
- **MySQL:** 50MB per database
- **Email accounts:** 400
- **Subdomains:** Unlimited

## 🚀 After Setup Checklist

- [ ] Files uploaded to `htdocs` or `public_html`
- [ ] Database created and configured
- [ ] `config/db.php` updated with InfinityFree credentials
- [ ] Database schema imported
- [ ] Website accessible at your subdomain
- [ ] Test login functionality
- [ ] Test database queries
- [ ] Check image uploads work

## 🆘 Troubleshooting

### Database Connection Error
- Double-check host, username, password in `config/db.php`
- Verify database user has proper permissions
- Check if database name includes the prefix (e.g., `epiz_xxxxx_`)

### 500 Internal Server Error
- Check `.htaccess` file
- Verify PHP version compatibility
- Check error logs in cPanel

### Images Not Loading
- Verify image paths are relative or use full URLs
- Check file permissions
- Ensure images are in correct folders

## 📞 Support

- InfinityFree Support: https://forum.infinityfree.net/
- Documentation: https://forum.infinityfree.net/forum/

---

**Your website will be live at:** `https://petcare.great-site.net` (or your chosen subdomain)

Good luck with your deployment! 🎉

