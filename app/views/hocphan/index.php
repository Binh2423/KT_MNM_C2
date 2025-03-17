

<h2>Danh Sách Học Phần</h2>
<a href="index.php?action=create" class="btn btn-primary">Thêm Học Phần</a>

<table class="table">
    <tr>
        <th>Mã Học Phần</th>
        <th>Tên Học Phần</th>
        <th>Số Tín Chỉ</th>
        <th>Hành Động</th>
    </tr>

    <?php if (!empty($hocphans)): ?>
        <?php foreach ($hocphans as $hocphan): ?>
        <tr>
            <td><?= htmlspecialchars($hocphan["ma_hocphan"]) ?></td>
            <td><?= htmlspecialchars($hocphan["ten_hocphan"]) ?></td>
            <td><?= htmlspecialchars($hocphan["so_tinchi"]) ?></td>
            <td>
                <a href="index.php?action=edit&id=<?= $hocphan['id'] ?>">Sửa</a>
                <a href="index.php?action=delete&id=<?= $hocphan['id'] ?>" onclick="return confirm('Xóa học phần này?')">Xóa</a>
            </td>
        </tr>
        <?php endforeach; ?>
    <?php else: ?>
        <tr><td colspan="4">Không có học phần nào.</td></tr>
    <?php endif; ?>
</table>
