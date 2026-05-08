## Current Step

Runtime demo data correction - align Kanboard tasks with `report.md` Bảng 3.2.

## Files Reviewed / Updated

- `PLANS.md`
- `FEATURE_SUMMARY.md`
- `docker-compose.sqlite.yml`
- `plugins/StudentProjectTheme/`
- Existing core customization hooks were removed from:
  - `app/Template/layout.php`
  - `app/Template/project_header/search.php`
  - `app/Template/project_header/views.php`

## Implementation Completed

- Current correction pass:
  - re-read `report.md` Bảng 2.4 and Bảng 3.2;
  - update demo task assignees to match the report resource column;
  - update task due dates to match report finish dates;
  - add task descriptions containing report start/end dates and assigned members.
- Converted the UI/dashboard/filter customization to plugin-first implementation under `plugins/StudentProjectTheme`.
- Added plugin template overrides for:
  - login page branding;
  - project header quick filters;
  - project header `Tiến độ` dashboard tab.
- Added plugin dashboard controller/template for project progress metrics.
- Changed `docker-compose.sqlite.yml` to mount local `./plugins` into `/var/www/app/plugins`.
- Removed empty local `plugins/StudentWorkspace` directories because Kanboard tried to load them as a plugin and logged a critical error.
- Reseeded runtime demo data in the Docker SQLite database:
  - project `Quản lý bài tập lớn nhóm 03 - Kanboard` (`project_id=2`);
  - 6 demo users;
  - 4 standard columns;
  - 25 WBS tasks from `report.md` Bảng 3.2, all in `Hoàn thành`;
  - assignees redistributed from the report resources, with Phong assigned 7 tasks;
  - each task description includes start date, finish date, full resource list, and Kanboard owner.

## Validation Result

- PHP syntax checks passed for plugin PHP files and touched core templates.
- Docker container was recreated with the local plugin mount and is healthy.
- `admin/admin` login worked.
- Live HTTP/browser-style checks passed:
  - `/login`
  - `/dashboard`
  - `/projects`
  - `/board/2`
  - `/task/7`
  - `/?controller=ProjectDashboardController&action=show&project_id=2&plugin=StudentProjectTheme`
  - quick-filter list URLs
  - `/extensions`
  - `/settings`
- Runtime audit confirmed the demo project, users, roles, columns, 25 report-aligned tasks, and owner distribution.
- After restarting the app, `/board/2`, `/task/26`, and the progress dashboard returned HTTP 200.
- `/task/26` confirmed `6.2 Thêm trang tổng quan tiến độ` has `2026-02-04` to `2026-02-26`, resources `Lại Trần Trí, Lê Bảo Tấn Phong`, and Kanboard owner `Lê Bảo Tấn Phong`.

## Evidence Screenshots To Capture

- Docker container healthy.
- Login page with `Kanboard Nhóm 03` banner.
- Installed Plugins page showing `StudentProjectTheme`.
- Project list showing `Quản lý bài tập lớn nhóm 03 - Kanboard`.
- Board `project_id=2` with 4 columns.
- Task detail `/task/26` showing report start/finish dates and assigned resources.
- Quick filters in project header.
- Dashboard tiến độ page.

## Remaining Risks

- Runtime demo data lives in the local Docker volume, not in tracked repo files.
- Existing old project `hehe` and user `test` were left untouched to avoid deleting local data.
