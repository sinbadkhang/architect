1. Bất cứ file nào thuộc về admin thì bỏ vào folder admin, tương tự với client. File php chạy html, file css hoặc bất cứ file nào về giao diện thì bỏ vào view. File js xử lý bỏ vào control. File php tương tác với db bỏ vào model.

2. Tên biến, hàm đặt tên Tiếng Anh, đúng cú pháp. Và có COMMENT.

3. Ai làm giao diện sẽ quy định name, id, class cho các element bằng Tiếng Anh, phải RÕ RÀNG và KHÔNG TRÙNG LẶP.

4. Tên database và tên cột được quy định sẵn.

5. Ai viết xử lý trong file php phải viết đúng cột tương ứng trong database.

6. Ai viết xử lý trong js phải viết đúng tên element được gọi trong file giao diện (html) và đúng tên file php.

7. Khi dùng git. Nếu chưa có project thì clone về. 
$git clone link folder

Sau khi làm xong, kiểm tra lại tất cả các chức năng có LIÊN QUAN đến phần của mình. Nếu ko có lỗi. Kiểm tra thay đổi.
$git status

Nếu có thay đổi.
$git add . 

Commit với message nói rõ phần mình làm.
$git commit -m "mô tả trong đây"
$git pull
$git push

8. Có 1 database mẫu là branch_1. Khi làm đồng bộ dữ liệu, mọi người tạo thêm branch_2, head rồi import branch_1