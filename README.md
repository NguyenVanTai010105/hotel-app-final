# 🏨 HỆ THỐNG QUẢN LÝ ĐẶT PHÒNG KHÁCH SẠN

## 📌 Giới thiệu dự án
Dự án **Hệ thống quản lý đặt phòng khách sạn** là một ứng dụng web giúp người dùng gửi yêu cầu đặt phòng trực tuyến và cho phép quản trị viên (Admin) quản lý, duyệt hoặc từ chối các yêu cầu đặt phòng một cách thuận tiện.

Hệ thống hỗ trợ:
- Người dùng gửi yêu cầu đặt phòng
- Admin duyệt / từ chối yêu cầu
- Gửi email thông báo kết quả đặt phòng
- Quản lý phòng và trạng thái đặt phòng

Dự án được xây dựng phục vụ cho mục đích **học tập và báo cáo học phần**.

---

## 👥 Thành viên thực hiện
- **Nguyễn Văn Tài** – Lớp K23CNTT2  
- *(Có thể bổ sung thêm nếu làm nhóm)*

---

## 🛠️ Công nghệ sử dụng
- **Laravel** (Framework PHP)
- **Blade Template Engine**
- **MySQL** (Cơ sở dữ liệu)
- **Tailwind CSS** (Thiết kế giao diện)
- **JavaScript**
- **Laravel Mail** (Gửi email thông báo)
- **Composer**

---

## ⚙️ Hướng dẫn cài đặt và chạy dự án

1. Clone dự án
```bash
git clone <link_repository>
cd <ten_thu_muc_du_an>
2. Cài đặt thư viện
composer install
3. Tạo .env từ .env.example
cp .env.example .env

4.Generate key
php artisan key:generate
5. Chạy migrate
php artisan migrate
6.Cài đặt tailwindcss
6.1 Install Tailwind CSS 
bật Terminal
npm install tailwindcss @tailwindcss/vite
6.2 Configure Vite Plugin 
Vào vite.config.ts
import { defineConfig } from 'vite'
import tailwindcss from '@tailwindcss/vite'

import { defineConfig } from 'vite'
import tailwindcss from '@tailwindcss/vite'

import { defineConfig } from 'vite'
import tailwindcss from '@tailwindcss/vite'
export default defineConfig({
  plugins: [
    tailwindcss(),
    // …
  ],
})
6.3 Import Tailwind CSS
Vào app.css
@import "tailwindcss";
@source '../../vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php';
@source '../../storage/framework/views/*.php';
@source '../**/*.blade.php';
@source '../**/*.js';
6.4 Start your build process
Bật terminal
npm run dev
6.5 Start using Tailwind in your project
 @vite('resources/css/app.css')
7. Tạo lại storage link
php artisan storage:link
8.Chạy project
php artisan serve
