# PROJECT_SUMMARY

## 1. Project overview
- Tên dự án: **Kanboard**.
- Mục đích hệ thống: phần mềm quản lý dự án theo phương pháp **Kanban** (quản lý project, board, task, người dùng, phân quyền, theo dõi tiến độ).
- Trạng thái dự án: theo `README.md`, dự án đang ở **maintenance mode**.
- Tech stack chính:
- Backend: PHP (yêu cầu >= 8.1), kiến trúc monolith.
- DB: SQLite (mặc định), MySQL/MariaDB, PostgreSQL (có hỗ trợ MSSQL/ODBC trong code).
- Dependency chính: PicoDb, Pimple (DI), Symfony Console, JSON-RPC server, OTP/TOTP.
- Runtime/deploy: Nginx + PHP-FPM + Docker (Dockerfile + docker-compose mẫu).
- Kiến trúc tổng quát:
- Entry point web: `index.php` -> `app/common.php` -> Router -> middleware chain -> Controller.
- Entry point API: `jsonrpc.php` (JSON-RPC).
- Entry point CLI: `./cli` (db migrate, worker, cronjob, export, reset password...).
- Tổ chức mã chính: `app/Controller`, `app/Model`, `app/Core`, `app/ServiceProvider`, `app/Schema`, `app/Api/Procedure`, `app/Template`.

## 2. How to run/deploy locally
- Prerequisites:
- Cách khuyến nghị: Docker + Docker Compose.
- Nếu chạy native: cần PHP >= 8.1 và các extension bắt buộc (`pdo_sqlite`/`pdo_mysql`/`pdo_pgsql`, `gd`, `mbstring`, `openssl`, `json`, `dom`, `SimpleXML`, ...).

- Các bước chạy từ đầu (Docker, nhanh nhất với SQLite):
1. Tại root repo, chạy: `docker compose -f docker-compose.sqlite.yml up -d`.
2. Mở trình duyệt: `http://localhost` (hoặc `https://localhost` với cert self-signed).
3. Đăng nhập tài khoản mặc định: `admin` / `admin`.

- Các biến thể DB:
1. MySQL/MariaDB: `docker compose -f docker-compose.mysql.yml up -d`.
2. PostgreSQL: `docker compose -f docker-compose.postgres.yml up -d`.
3. Hai file trên dùng `DATABASE_URL` trong service `app` để trỏ DB container.

- Config cần sửa:
- Có thể tạo `config.php` từ `config.default.php` (hoặc dùng `data/config.php`).
- Các mục thường chỉnh: `DB_DRIVER`, `DB_*`, `MAIL_*`, `LDAP_*`, `ENABLE_URL_REWRITE`, `PLUGIN_INSTALLER`.
- Trong Docker, nhiều config được truyền qua env (xem `docker/etc/php84/php-fpm.d/env.conf`).

- Database:
- Migrate tự chạy khi app boot nếu `DB_RUN_MIGRATIONS = true`.
- Có thể chạy tay: `./cli db:migrate`.
- Schema/migration theo từng DB driver: `app/Schema/Sqlite.php`, `app/Schema/Mysql.php`, `app/Schema/Postgres.php`.

- URL truy cập:
- Web UI: `http://localhost`.
- API JSON-RPC: `http://localhost/jsonrpc.php`.

- Tài khoản mặc định:
- `admin` / `admin` (seed trong schema).

- Lỗi thường gặp / note ngắn:
- Port `80/443` bị chiếm.
- Thư mục dữ liệu không ghi được (`data`, `plugins`).
- Thiếu extension PDO đúng với DB đã chọn.
- Bật `REVERSE_PROXY_AUTH` nhưng không cấu hình `TRUSTED_PROXY_NETWORKS` sẽ bị lỗi setup.

## 3. Main features
- Quản lý project: tạo/sửa/disable/archive, project private/public, permissions.
- Kanban board: cột, swimlane, kéo-thả task, giới hạn WIP.
- Quản lý task: tạo/sửa/đóng/mở, assign, due date, priority, recurrence.
- Task nâng cao: subtasks, comments, attachments, internal/external links, tags, custom filters.
- Dashboard + activity + search.
- Báo cáo/analytics: task distribution, user distribution, CFD, burndown, lead/cycle time.
- Notification/integration: email, web notification, webhook, iCal/feed.
- API và tự động hóa: JSON-RPC API, cronjob/worker/queue, plugin system.

- Vai trò người dùng:
- App-level: `Administrator`, `Manager`, `User`.
- Project-level: `Project Manager`, `Project Member`, `Project Viewer`.

## 4. Useful for project management course
- Phạm vi dự án có thể mô tả:
- Hệ thống quản lý công việc cho nhóm theo Kanban, có cả nghiệp vụ vận hành (task flow) và quản trị hệ thống (user/role/config/integration).

- Những công việc chính nhóm sẽ phải làm:
- Khảo sát yêu cầu + use case (project, task lifecycle, phân quyền).
- Lập kế hoạch triển khai môi trường (Docker + DB + config).
- Phân rã module (auth, project, board/task, notification, API, reporting).
- Thiết kế kiểm thử (flow nghiệp vụ chính, phân quyền, migration).
- Quản trị thay đổi dữ liệu (schema version, backup/restore, upgrade).

- Những phần nhóm có thể mở rộng thêm:
- REST wrapper cho JSON-RPC hoặc API gateway.
- Tích hợp SSO/OAuth provider mới.
- Plugin nghiệp vụ riêng (workflow, báo cáo tùy biến).
- Dashboard quản trị nâng cao (SLA, throughput, forecast).

## 5. Limitations / notes
- Tài liệu cài đặt/nâng cấp chi tiết trong repo không nhiều; `README.md` chủ yếu trỏ sang docs ngoài (`docs.kanboard.org`).
- Không có `.env.example`; cấu hình chính theo `config.php`/hằng số/env runtime.
- Chưa chạy test/integration thực tế trên máy hiện tại; các bước run ở trên dựa trên file cấu hình và source code: **Chưa xác minh trực tiếp**.
- Chưa xác minh toàn bộ flow nghiệp vụ UI/API end-to-end: **Chưa xác minh trực tiếp**.
