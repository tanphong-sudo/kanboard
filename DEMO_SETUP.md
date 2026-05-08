# Demo Setup

## 1. Project setup

- Tạo project với tên: `Quản lý bài tập lớn nhóm 03 - Kanboard`
- Đây là project dùng để trình bày demo cho bài tập lớn môn Quản lý Dự án cho Kỹ sư.

## 2. Board columns

Chuẩn hóa board thành 4 cột:

- `Chưa làm`
- `Đang làm`
- `Chờ phản hồi`
- `Hoàn thành`

## 3. Demo users

Tạo 6 tài khoản demo:

- `phong - Lê Bảo Tấn Phong`
- `phat - Trần Tấn Phát`
- `phuoc - Phạm Hữu Phước`
- `tri - Lại Trần Trí`
- `hoanganh - Huỳnh Hoàng Anh`
- `anhduc - Đoàn Quang Anh Đức`

Nếu cần đặt mật khẩu để demo, chỉ dùng mật khẩu giả/local-only như `demo123`.
Không dùng mật khẩu thật, tài khoản thật, hoặc thông tin bí mật.

## 4. Task conventions

### Title format

- Dùng một format thống nhất như: `[Nhóm 03] Tên công việc`
- Có thể dùng biến thể: `[Module] Tên công việc` nếu muốn phân nhóm rõ hơn

### Assignee rule

- Mỗi task khi bắt đầu làm nên có 1 người phụ trách chính
- Task chưa có người phụ trách nên để ở cột `Chưa làm`

### Deadline rule

- Mỗi task demo nên có deadline
- Nên đặt deadline lệch nhau để dễ trình bày bộ lọc nhanh và dashboard

### Priority rule

- `High`: việc gấp hoặc chặn tiến độ nhóm
- `Medium`: việc bình thường
- `Low`: việc phụ trợ hoặc hoàn thiện tài liệu/giao diện

### Comment/update rule

- Khi chuyển task đang làm hoặc chờ phản hồi, thêm ít nhất 1 comment cập nhật ngắn
- Comment nên mô tả tiến độ, vấn đề gặp phải, hoặc nội dung cần phản hồi

### Column movement rule

- `Chưa làm`: chưa bắt đầu
- `Đang làm`: đang được một thành viên thực hiện
- `Chờ phản hồi`: đang chờ review, phản hồi từ giảng viên, hoặc xác nhận từ thành viên khác
- `Hoàn thành`: đã xong và không cần xử lý thêm cho buổi demo

## 5. Demo tasks to create

Tạo các task sau:

- `Khảo sát tính năng Kanboard`
- `Phân tích nhu cầu nhóm sinh viên`
- `Thiết kế quy trình quản lý công việc`
- `Chuẩn hóa cột Kanban`
- `Cấu hình Docker`
- `Tạo tài khoản thành viên`
- `Chuẩn hóa deadline và priority`
- `Đổi tên hệ thống`
- `Chỉnh giao diện cơ bản`
- `Tạo project mẫu`
- `Thêm bộ lọc nhanh`
- `Xây dựng dashboard tiến độ`
- `Kiểm thử chức năng cốt lõi`
- `Kiểm thử phần tùy biến/mở rộng`
- `Ghi nhận lỗi`
- `Chuẩn bị dữ liệu demo`

## 6. Suggested demo-state distribution

Để board nhìn thực tế và dễ trình bày:

- Giữ một số task ở `Chưa làm`
- Chuyển các task như `Cấu hình Docker`, `Đổi tên hệ thống`, `Chỉnh giao diện cơ bản`, `Thêm bộ lọc nhanh`, `Xây dựng dashboard tiến độ` sang `Hoàn thành`
- Giữ 2-3 task ở `Đang làm`
- Đặt ít nhất 1 task ở `Chờ phản hồi`
- Đảm bảo có:
  - 1 task quá hạn
  - 1 task sắp đến hạn
  - 1 task chưa có người phụ trách

Thiết lập này giúp phần `Bộ lọc nhanh` và `Dashboard tiến độ` có dữ liệu rõ ràng để trình bày.

## 7. Screenshot checklist

Chụp các màn hình sau:

- Docker running
- login/home page
- project list
- board with 4 columns
- task detail with assignee/deadline/priority
- quick filters
- dashboard
- redesigned UI

## 8. Short presentation flow

Trình bày ngắn theo thứ tự:

1. Cho thấy Docker/app đang chạy
2. Đăng nhập vào hệ thống
3. Mở project demo
4. Giới thiệu board 4 cột và một vài task mẫu
5. Mở một task để cho thấy assignee, deadline, priority, comment
6. Mở `Bộ lọc nhanh`
7. Mở `Dashboard tiến độ`
8. Kết thúc bằng phần giao diện đã tùy biến và liên hệ với nội dung báo cáo
