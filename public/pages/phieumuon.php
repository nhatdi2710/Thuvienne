<!DOCTYPE html>
<html lang="en">

<!-- Header -->
<?php require __DIR__ . '/../../src/partials/header.php' ?>

<body>
    <main class="container mt-4">
        <img src="" alt="">
        <h2 class="text-center">PHIẾU MƯỢN</h2>

        <div class="row mt-4">
            <div class="col text-center">
                <p>Số: ...</p>
            </div>

            <div class="col text-center">
                <p>Ngày lập: ...</p>
            </div>
        </div>

        <h4 class="mt-4">Chi tiết phiếu:</h4>
        <p>Số thẻ: ...</p>
        <p>Tài khoản mượn: ...</p>
        <p>Ngày mượn: ...</p>
        <p>Ngày hẹn trả: ...</p>

        <h4 class="mt-4">Danh sách mượn:</h4>
        <table style="min-height: 120px;" class="table">
            <thead>
                <tr>
                    <th>Sách</th>
                    <th>Ngày trả</th>
                    <th>Tình trạng</th>
                </tr>
            </thead>
            <tbody>
                <!-- <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr> -->
            </tbody>
        </table>

        <div class="row">
            <div class="col text-center">
                <p style="min-height: 120px;"><b>Người mượn</b></p>
                <p>Ký và ghi rõ họ tên</p>
            </div>

            <div class="col text-center">
                <p style="min-height: 120px;"><b>Người lập phiếu</b></p>
                <p>Ký và ghi rõ họ tên</p>
            </div>
        </div>
    </main>

    <!-- Footer -->
    <?php require __DIR__ . '/../../src/partials/footer.php' ?>
</body>
</html>