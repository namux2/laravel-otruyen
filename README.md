# Laravel OTruyen Admin 📚

Hệ thống quản trị Laravel để crawl và quản lý dữ liệu truyện tranh từ [OTruyen API](https://otruyenapi.com).

## Tính năng chính

- ✅ **Admin Dashboard** đơn giản để quản lý dữ liệu truyện.
- 🤖 **Crawler Engine** thu thập dữ liệu từ API.
- 🗄️ **Database Management** lưu trữ truyện đã crawl.
- 📬 **Queue System** xử lý tác vụ crawl lớn.
- ⏰ **Scheduled Tasks** tự động hóa việc crawl hàng ngày.

## Cài đặt

```bash
composer require your-vendor/laravel-otruyen
```

## Lệnh artisan

```bash
php artisan otruyen:crawl --store
```

Lệnh trên sẽ lấy danh sách truyện mới và dispatch job để lấy chi tiết từng truyện.

## Phát triển

> Mở rộng trong thư mục `src/` theo PSR-4: `YourVendor\\Otruyen\\` với các command, job, facade, model, service provider v.v.
