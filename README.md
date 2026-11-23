# Yo-Ji

Yo-Ji Frozen Yogurt & Açaí sitesi (düz PHP + statik tema).

## Yapı
- `index.html`, `*.php` — sayfalar (`header.php`/`footer.php` include edilir)
- `img/`, `wp-content/themes/yochi/`, `wp-content/uploads/` — görseller ve tema
- `yoji-footer.css` — footer stilleri

## Not
Depoya yalnızca sitenin fiilen kullandığı dosyalar alındı; kullanılmayan
eski medya ve `error_log`/`cache` dışarıda bırakıldı (`.gitignore`).
