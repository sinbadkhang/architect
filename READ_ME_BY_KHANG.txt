1. Bất cứ file nào thuộc về admin thì bỏ vào folder admin, tương tự với client. File php chạy html, file css hoặc bất cứ file nào về giao diện thì bỏ vào view. File js xử lý bỏ vào control. File php tương tác với db bỏ vào model.

2. Tên biến, hàm đặt tên Tiếng Anh, đúng cú pháp.

3. Ai làm giao diện sẽ quy định name, id, class cho các element bằng Tiếng Anh, phải RÕ RÀNG và KHÔNG TRÙNG LẶP.

4. Tên database và tên cột được quy định sẵn.

5. Ai viết xử lý trong file php phải viết đúng cột tương ứng trong database.

6. Ai viết xử lý trong js phải viết đúng tên element được gọi trong file giao diện (html) và đúng tên file php.

7. Khi dùng git. Nếu chưa có project thì clone về. Sau khi làm xong, kiểm tra lại tất cả các chức năng có LIÊN QUAN đến phần của mình. Nếu ko có lỗi => Add , Commit với message nói rõ phần mình làm => Pull về => Push lên.

8. Có 2 database. Phần mọi người làm chỉ liên quan đến db1 (trong config/database.php)
