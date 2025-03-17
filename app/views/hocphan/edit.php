<h2>Chỉnh sửa Học Phần</h2>
<form method="POST">
    <label>Mã Học Phần:</label>
    <input type="text" name="ma_hocphan" value="<?= $hocphan["ma_hocphan"] ?>" required><br>

    <label>Tên Học Phần:</label>
    <input type="text" name="ten_hocphan" value="<?= $hocphan["ten_hocphan"] ?>" required><br>

    <label>Số Tín Chỉ:</label>
    <input type="number" name="so_tinchi" value="<?= $hocphan["so_tinchi"] ?>" required><br>

    <button type="submit">Lưu</button>
</form>
<a href="index.php?action=index">Quay lại</a>
