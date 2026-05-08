# Tính năng nhóm đã tùy biến/mở rộng

## 1. Giao diện sinh viên/Bách Khoa

- Đã chuyển tùy biến giao diện sang plugin `plugins/StudentProjectTheme`.
- Banner hiển thị `Kanboard Nhóm 03`, logo Bách Khoa, dòng `Hệ thống quản lý công việc nhóm sinh viên`, và ngữ cảnh môn học.
- CSS plugin áp dụng cho login page, header, form, board, quick filters, dashboard và các trang chung.
- Plugin đã được mount vào container qua `./plugins:/var/www/app/plugins` và hiển thị trong Installed Plugins.

## 2. Bộ lọc nhanh công việc

- Đã thêm khu vực `Bộ lọc nhanh` trong project header bằng template override của plugin.
- Các bộ lọc gồm:
  - `Công việc của tôi`
  - `Công việc quá hạn`
  - `Công việc sắp đến hạn`
  - `Công việc chưa có người phụ trách`
  - `Công việc đã hoàn thành`
- Bộ lọc đã được kiểm tra trên project demo `2`.

## 3. Dashboard tiến độ

- Đã thêm trang `Dashboard tiến độ` theo project bằng plugin controller.
- Các chỉ số hiển thị:
  - `Tổng số công việc`
  - `Công việc đang làm`
  - `Công việc đã hoàn thành`
  - `Công việc quá hạn`
  - `Công việc theo thành viên`
- Dashboard tính `Đang làm` theo cột `Đang làm` và `Hoàn thành` theo cột `Hoàn thành`, phù hợp workflow demo của nhóm sinh viên.

## 4. Dữ liệu demo đã tạo trong runtime local

- Project mẫu: `Quản lý bài tập lớn nhóm 03 - Kanboard` (`project_id=2`).
- 6 user demo: `phong`, `phat`, `phuoc`, `tri`, `hoanganh`, `anhduc`.
- Role: `phong` là project manager; các user còn lại là project member.
- 4 cột Kanban chuẩn: `Chưa làm`, `Đang làm`, `Chờ phản hồi`, `Hoàn thành`.
- 25 task WBS theo `report.md` Bảng 3.2, đặt trong cột `Hoàn thành`.
- Mỗi task có ngày bắt đầu, ngày hoàn thành, nguồn lực đầy đủ và người phụ trách chính trên Kanboard.
- Phân bổ owner chính hiện tại: `phong` 7 task, `hoanganh` 6 task, `anhduc` 4 task, `phat` 3 task, `tri` 3 task, `phuoc` 2 task.
- Tài khoản demo mới tạo dùng mật khẩu local-only `demo123`.

## 5. Cách kiểm tra nhanh

- Chạy lệnh:
  - `docker compose -f docker-compose.sqlite.yml up -d`
  - `docker compose -f docker-compose.sqlite.yml ps`
  - `docker logs --since 2026-05-08T11:55:00Z kanboard`
- Mở các trang:
  - `http://localhost/login`
  - `http://localhost/dashboard`
  - `http://localhost/projects`
  - `http://localhost/board/2`
  - `http://localhost/task/26`
  - `http://localhost/?controller=ProjectDashboardController&action=show&project_id=2&plugin=StudentProjectTheme`
  - `http://localhost/extensions`
  - `http://localhost/settings`
