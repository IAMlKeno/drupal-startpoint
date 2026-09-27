# Phase 3: Production Configuration Guide

**Date:** 2026-09-27  
**Status:** Ready for Configuration  
**Estimated Time:** 2–4 hours

---

## Overview

Phase 3 requires configuring external services and Drupal settings:
1. OAuth (Google & Apple login)
2. Google Analytics 4
3. Email (Simplenews, transactional)
4. Domain & SSL
5. Database backup strategy

Each section includes step-by-step instructions.

---

## 1. OAuth Configuration (Google & Apple Login)

### Prerequisites
- Google Cloud Console access
- Apple Developer account access

### Google OAuth Setup

**Step 1: Create Google Cloud Project**
1. Go to [Google Cloud Console](https://console.cloud.google.com/)
2. Create new project: "PolicyLink Nexus"
3. Enable APIs: OAuth 2.0, Google+ API
4. Create OAuth 2.0 credentials (Web application)

**Step 2: Configure OAuth Consent Screen**
1. Go to APIs & Services > OAuth consent screen
2. Set application name: "PolicyLink Nexus"
3. Add authorized domains: `policynexus.ddev.site` (dev), `yourdomain.com` (production)
4. Add scopes: `email`, `profile`

**Step 3: Create OAuth Client ID**
1. Go to APIs & Services > Credentials
2. Create OAuth 2.0 Client ID (Web application)
3. Authorized redirect URIs:
   - `https://policynexus.ddev.site/user/login/google_callback` (dev)
   - `https://yourdomain.com/user/login/google_callback` (prod)
4. Save: Client ID and Client Secret

**Step 4: Configure in Drupal**
1. Admin > Configuration > Social API
2. Enter Google Client ID and Secret
3. Test: Visit `/user/login` - should see "Login with Google"

---

### Apple OAuth Setup

**Step 1: Apple Developer Account**
1. Go to [Apple Developer](https://developer.apple.com/)
2. Sign in with your Apple ID
3. Navigate to Certificates, Identifiers & Profiles

**Step 2: Create Service ID**
1. Create new Service ID: `com.policylinknexus.web`
2. Enable "Sign in with Apple"
3. Configure: Add redirect URIs:
   - `https://policynexus.ddev.site/user/login/apple_callback` (dev)
   - `https://yourdomain.com/user/login/apple_callback` (prod)

**Step 3: Create Private Key**
1. Create new private key for "Sign in with Apple"
2. Download `.p8` file (save securely)
3. Note: Team ID, Key ID

**Step 4: Configure in Drupal**
1. Admin > Configuration > Social API > Apple
2. Enter: Team ID, Key ID, Service ID
3. Upload: Private key (.p8 file)
4. Test: Visit `/user/login` - should see "Login with Apple"

---

## 2. Google Analytics 4 Setup

### Prerequisites
- Google Analytics account

### Configuration Steps

**Step 1: Create GA4 Property**
1. Go to [Google Analytics](https://analytics.google.com/)
2. Create new Property: "PolicyLink Nexus"
3. Set timezone, reporting currency

**Step 2: Get Measurement ID**
1. In GA4 property, go to Admin > Data Streams
2. Create new web data stream
3. Enter website URL: `https://yourdomain.com`
4. Copy: **Measurement ID** (format: G-XXXXXXXXXX)

**Step 3: Configure in Drupal**
1. Admin > Configuration > System > Google Tag Manager
2. Enter Measurement ID: `G-XXXXXXXXXX`
3. Save
4. Test: Visit site, check Real-time in GA4 dashboard

**Step 4: Create GA4 Views**
- Set up views for: Traffic, Users, Conversions
- Create goals for: User registration, Policy comments, Newsletter signups

---

## 3. Email Configuration (Simplenews & Transactional)

### Prerequisites
- Email service (Gmail, SendGrid, AWS SES, or your own SMTP)

### Simplenews (Newsletter)

**Step 1: Configure SMTP**
1. Admin > Configuration > System > Mailer
2. Select SMTP module (if using third-party service)
3. Enter SMTP settings:
   - Host: `smtp.gmail.com` (or your provider)
   - Port: `587` (TLS) or `465` (SSL)
   - Username: your-email@gmail.com
   - Password: app-specific password (for Gmail)

**Step 2: Configure Simplenews**
1. Admin > Content > Simplenews > Settings
2. Set sender email: `newsletter@yourdomain.com`
3. Set sender name: "PolicyLink Nexus"
4. Configure email templates:
   - Subscribe confirmation
   - Welcome email
   - Unsubscribe confirmation

**Step 3: Create Newsletter**
1. Admin > Content > Simplenews > Manage newsletters
2. Create: "PolicyLink Updates"
3. Set email address: `newsletter@yourdomain.com`

**Step 4: Test Newsletter**
1. Subscribe at `/newsletter` (or add signup block to footer)
2. Send test email via admin
3. Verify delivery and formatting

---

## 4. Domain & SSL Setup

### Prerequisites
- Domain name registered
- Hosting environment configured (production server)

### Domain Configuration

**Step 1: Point Domain to Server**
1. Get server IP from hosting provider
2. Update DNS A record:
   - Type: A
   - Name: `@` (for root) or `www`
   - Value: Server IP
3. Wait for DNS propagation (15 min - 24 hours)

**Step 2: Update Drupal Site URL**
1. Admin > Configuration > System > Site information
2. Change Site name: "PolicyLink Nexus"
3. Site slogan: "Connecting Voices. Bridging Gaps. Shaping Policies."
4. Site mail: `admin@yourdomain.com`

**Step 3: SSL Certificate (HTTPS)**
1. Use free Let's Encrypt certificate
2. Via hosting provider's cPanel or manually
3. Install certificate on server
4. Redirect HTTP → HTTPS in server config

**Step 4: Update Drupal Config**
1. Edit `settings.php` (if needed)
2. Ensure `$settings['trusted_host_patterns']` includes your domain:
   ```php
   $settings['trusted_host_patterns'] = [
     '^yourdomain\.com$',
     '^www\.yourdomain\.com$',
   ];
   ```

---

## 5. Production Database Backup Strategy

### Prerequisites
- Backup storage (AWS S3, Google Cloud Storage, or local backup server)

### Backup Configuration

**Step 1: Set Up Automated Backups**
1. Install `backup_migrate` module (optional, for UI)
2. Or use server-level backups:
   - Daily snapshots via hosting provider
   - Weekly full backups to cloud storage

**Step 2: Configure Backup Schedule**
1. Admin > Configuration > System > Backup & Migrate
2. Set backup schedule:
   - Frequency: Daily (after hours)
   - Retention: Keep 7 daily, 4 weekly, 12 monthly
3. Destination: Cloud storage (S3, GCS, or local)

**Step 3: Test Backup Restore**
1. Create backup manually
2. Verify backup file created
3. Test restore on staging environment
4. Document restore procedure

**Step 4: Backup Files**
```
Key directories to backup:
- web/sites/default/files/ (user uploads)
- web/modules/custom/ (custom code)
- web/themes/custom/ (theme)
- composer.json, composer.lock (dependencies)
```

---

## 6. Pre-Launch Checklist

### Security
- [ ] SSL certificate installed and working (HTTPS)
- [ ] OAuth credentials configured and tested
- [ ] Email sending verified (test email sent)
- [ ] Database backups working
- [ ] Admin credentials changed from default
- [ ] Drupal security updates applied

### Functionality
- [ ] User registration tested (email + OAuth)
- [ ] Comment system working on policies
- [ ] Newsletter signup functioning
- [ ] Analytics tracking confirmed
- [ ] SEO settings configured (meta tags, sitemap)
- [ ] Contact/feedback forms tested

### Content
- [ ] Site name and slogan updated
- [ ] Homepage content populated
- [ ] Team member profiles added (optional)
- [ ] FAQ entries created (optional)
- [ ] Privacy policy posted (required)
- [ ] Terms of service posted (required)

### Performance
- [ ] Page load time < 3 seconds
- [ ] Mobile responsiveness verified
- [ ] Images optimized
- [ ] Caching configured
- [ ] CDN enabled (if applicable)

### Analytics & Monitoring
- [ ] GA4 tracking verified
- [ ] Goals/conversions configured
- [ ] Error monitoring set up
- [ ] Uptime monitoring enabled
- [ ] Log files configured

---

## 7. Credentials to Store Securely

Create a secure password manager entry with:
- [ ] Google OAuth Client ID
- [ ] Google OAuth Client Secret
- [ ] Apple Team ID
- [ ] Apple Key ID
- [ ] GA4 Measurement ID
- [ ] SMTP username & password
- [ ] Database backup credentials
- [ ] Admin account password
- [ ] Domain registrar login
- [ ] Hosting provider login

---

## 8. Post-Launch Tasks

### Week 1
- Monitor analytics for traffic
- Check error logs daily
- Respond to user feedback
- Test all user flows (registration, comments, newsletter)

### Week 2-4
- Gather user feedback
- Monitor performance metrics
- Add more content (policies, research, stories)
- Fine-tune designs/templates as needed

### Monthly
- Review analytics and user metrics
- Update content and research
- Monitor security updates
- Backup verification

---

## Configuration Timeline

| Task | Duration | Status |
|------|----------|--------|
| OAuth setup | 30-45 min | ⏳ Ready |
| Analytics setup | 20-30 min | ⏳ Ready |
| Email config | 30-45 min | ⏳ Ready |
| Domain & SSL | 1-2 hrs | ⏳ Ready |
| Backup setup | 30 min | ⏳ Ready |
| Testing | 30-45 min | ⏳ Ready |
| **Total** | **3-5 hrs** | ⏳ **Ready** |

---

## Support & Troubleshooting

### OAuth Not Appearing
- Check: Client ID/Secret entered correctly
- Verify: Redirect URIs match exactly
- Clear browser cache and reload

### Email Not Sending
- Test SMTP settings via Drupal admin
- Check spam folder
- Verify sender email is whitelisted

### Analytics Not Tracking
- Verify Measurement ID entered
- Check: Analytics script in page source
- Wait 24 hours for data to appear

### Domain Not Resolving
- Check: DNS propagation (use whatsmydns.net)
- Verify: A record points to server IP
- Check: DNS TTL (may take up to 24 hours)

---

## Next Steps

1. **Gather Credentials** — Collect all API keys and credentials
2. **Follow Each Section** — Configure OAuth, Analytics, Email, Domain
3. **Test Each Feature** — Verify OAuth login, email, analytics tracking
4. **Launch** — Once all tests pass, site is production-ready

**Questions?** Refer to Drupal module documentation or module-specific support.

---

**Ready to start configuration?** Begin with Section 1 (OAuth) or whichever you have credentials for first.
