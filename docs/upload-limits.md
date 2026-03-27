# Upload Limits for Seller Registration

Seller registration uploads four required image files in one multipart request:

- `business_license`
- `articles_of_incorporation`
- `national_identity_card`
- `authorized_signature`

To avoid `413 Request Entity Too Large`, set upload limits above the combined payload size.

## Recommended limits

- NGINX: `client_max_body_size 20m;`
- PHP: `post_max_size = 20M`
- PHP: `upload_max_filesize = 4M`
- PHP: `max_file_uploads = 20`

These settings allow multiple document uploads with multipart overhead while keeping per-file validation controlled by Laravel request rules.

## NGINX example

```nginx
server {
    # ...
    client_max_body_size 20m;
}
```

After changing NGINX config, reload it:

```bash
sudo nginx -t && sudo systemctl reload nginx
```

## PHP example (`php.ini` or pool config)

```ini
post_max_size = 20M
upload_max_filesize = 4M
max_file_uploads = 20
```

After changing PHP-FPM config, restart/reload it.

## Apache note

`public/.htaccess` in this repository includes:

- `LimitRequestBody 20971520`
- `php_value` upload settings for mod_php environments

If your stack uses PHP-FPM behind Apache or NGINX, make sure server-level and PHP-FPM configs are also updated because `.htaccess` alone is not always sufficient.
