-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th3 30, 2024 lúc 04:36 AM
-- Phiên bản PHP: 8.0.30
--
-- Cơ sở dữ liệu: `thuvienne`
--
create database thuvienne;

use thuvienne;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `chi_tiet_muon_tra`
--

CREATE TABLE `chi_tiet_muon_tra` (
  `STT_PHIEUMUON` int(11) NOT NULL,
  `MA_SACH` int(11) NOT NULL,
  `TINHTRANG` text NOT NULL,
  `DA_TRA` tinyint(1) NOT NULL,
  `NGAY_TRA` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `nha_xuat_ban`
--

CREATE TABLE `nha_xuat_ban` (
  `MA_NXB` char(10) NOT NULL,
  `TEN_NXB` varchar(20) NOT NULL,
  `DIACHI_NXB` varchar(50) NOT NULL,
  `NGUOIDAIDIEN` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `nha_xuat_ban`
--

INSERT INTO `nha_xuat_ban` (`MA_NXB`, `TEN_NXB`, `DIACHI_NXB`, `NGUOIDAIDIEN`) VALUES
('001', 'Tân Dân', '63 Nguyễn Du, Hai Bà Trưng, Hà Nội, Việt Nam', 'Nguyễn Bá Thanh'),
('002', 'Tân Việt', '45 Hàng Bông, Hoàn Kiếm, Hà Nội, Việt Nam', 'Nguyễn Tường Tam'),
('003', 'Kim Đồng', '55 Quang Trung, Hoàn Kiếm, Hà Nội, Việt Nam', 'Lê Quang Thắng'),
('004', 'Nhà xuất bản Trẻ', '65 Nguyễn Thị Minh Khai, Hồ Chí Minh, Việt Nam', 'Nguyễn Minh Nhựt'),
('005', 'Báo Việt Nữ', '58 Quán Thánh, Ba Đình, Hà Nội, Việt Nam', 'Bùi Thị Thanh'),
('006', 'Báo Tiền Phong', '47 Quán Thánh, Ba Đình, Hà Nội, Việt Nam', 'Lê Xuân Sơn'),
('007', 'Nhã Nam', '59 Đỗ Quang, Trung Hòa, Cầu Giấy, Hà Nội', 'Nguyễn Cảnh Bình'),
('008', 'Dân Trí', '455 Tây Sơn, Đống Đa, Hà Nội', 'Lê Xuân Sơn'),
('009', 'Shogakukan', 'Hitotsubashi, Chiyoda-ku, Tokyo, Nhật Bản', 'Shoichi Takada'),
('010', 'NXB Tổng hợp TP.HCM', '62 Nguyễn Thị Minh Khai, P.Đa Kao, Q1, TP.HCM', 'Nguyễn Thị Thanh Thủy'),
('011', 'Hay House', 'PO Box 910, Carlsbad, CA 92008-0910, Hoa Kỳ', 'Reid Tracy');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `phanloai_taikhoan`
--

CREATE TABLE `phanloai_taikhoan` (
  `TEN_LOAI` char(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `phanloai_taikhoan`
--

INSERT INTO `phanloai_taikhoan` (`TEN_LOAI`) VALUES
('nguoidung'),
('quantv');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `phieu_muon`
--

CREATE TABLE `phieu_muon` (
  `STT_PHIEUMUON` int(11) NOT NULL,
  `STT_THETV` int(11) NOT NULL,
  `USERNAME_QTV` varchar(30) NOT NULL,
  `NGAY_MUON` date NOT NULL,
  `NGAY_HENTRA` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `sach`
--

CREATE TABLE `sach` (
  `MA_SACH` int(11) NOT NULL,
  `STT_THELOAI` int(11) NOT NULL,
  `MA_NXB` char(10) NOT NULL,
  `MA_TG` char(10) NOT NULL,
  `TEN_SACH` varchar(20) NOT NULL,
  `TGXB` year(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

select * from sach;
--
-- Đang đổ dữ liệu cho bảng `sach`
--

INSERT INTO `sach` (`MA_SACH`, `STT_THELOAI`, `MA_NXB`, `MA_TG`, `TEN_SACH`, `TGXB`) VALUES
(110, 1, '001', 'TG001', 'Dế Mèn phiêu lưu ký', '1941'),
(111, 2, '002', 'TG001', 'Vợ chồng A Phủ', '1952'),
(112, 2, '002', 'TG002', 'Hai đứa trẻ', '1938'),
(113, 3, '003', 'TG003', 'Đất rừng phương Nam', '1957'),
(114, 1, '004', 'TG004', 'Chú bé Thát Sơn', '1993'),
(115, 1, '003', 'TG005', 'Con hạc thờ bí ẩn', '1983'),
(116, 3, '003', 'TG003', 'Cuộc truy tầm kho vũ', '1962'),
(117, 3, '005', 'TG006', 'Tắt đèn', '1937'),
(118, 2, '006', 'TG007', 'Vợ nhặt', '1946'),
(119, 2, '002', 'TG002', 'Gió lạnh đầu mùa', '1937'),
(120, 4, '003', 'TG008', 'Đôn Ki-hô-tê', '1962'),
(121, 5, '007', 'TG009', 'Cứu tinh xứ cát', '1965'),
(122, 6, '008', 'TG010', 'Tịch Tịnh', '2024'),
(123, 7, '009', 'TG011', 'Frieren: Beyond Jour', '2020'),
(124, 8, '010', 'TG012', 'Sử Dụng Đúng Ngôn Ng', '2024'),
(125, 9, '011', 'TG013', 'Past Lives-Present H', '2023');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tac_gia`
--

CREATE TABLE `tac_gia` (
  `MA_TG` char(10) NOT NULL,
  `TEN_TG` varchar(20) NOT NULL,
  `WEBSITE` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `tac_gia`
--

INSERT INTO `tac_gia` (`MA_TG`, `TEN_TG`, `WEBSITE`) VALUES
('TG001', 'Tô Hoài', 'https://vi.wikipedia.org/wiki/'),
('TG002', 'Thạch Lam', 'https://vi.wikipedia.org/wiki/'),
('TG003', 'Đoàn Giỏi', 'https://vi.wikipedia.org/wiki/'),
('TG004', 'Phạm Công Luận', 'https://www.netabooks.vn/tac-g'),
('TG005', 'Nguyễn Quan Thân', 'https://vi.wikipedia.org/wiki/'),
('TG006', 'Ngô Tất Tố', 'https://vi.wikipedia.org/wiki/'),
('TG007', 'Kim Lân', 'https://vi.wikipedia.org/wiki/'),
('TG008', 'Miguel de Cervantes', 'https://en.wikipedia.org/wiki/'),
('TG009', 'Frank Herbert', 'https://en.wikipedia.org/wiki/'),
('TG010', 'Thích Đồng Tâm', 'https://giacngo.vn/tieu-su.htm'),
('TG011', 'Kanehito Yamada', 'https://frieren.fandom.com/wik'),
('TG012', 'Dương Út', 'https://www.khaitam.com/c%20gi'),
('TG013', 'Rebecca Campbell', 'https://en.wikipedia.org/wiki/');
select * from tac_gia;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `the_loai`
--

CREATE TABLE `the_loai` (
  `STT_THELOAI` int(11) NOT NULL,
  `TEN_TL` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `the_loai`
--

INSERT INTO `the_loai` (`STT_THELOAI`, `TEN_TL`) VALUES
(1, 'Văn học thiếu nhi'),
(2, 'Truyện ngắn'),
(3, 'Tiểu thuyết'),
(4, 'Trào phúng'),
(5, 'Khoa học viễn tưởng'),
(6, 'Tâm lý'),
(7, 'Truyện tranh'),
(8, 'Chuyên ngành'),
(9, 'Tâm linh');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `the_thu_vien`
--

CREATE TABLE `the_thu_vien` (
  `STT_THETV` int(11) NOT NULL,
  `USERNAME_DG` varchar(30) NOT NULL,
  `NGAY_LAPTHE` date NOT NULL,
  `NGAY_HETHAN` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `the_thu_vien`
--

INSERT INTO `the_thu_vien` (`STT_THETV`, `USERNAME_DG`, `NGAY_LAPTHE`, `NGAY_HETHAN`) VALUES
(1, 'user01', '2024-01-01', '2025-01-01'),
(2, 'user02', '2024-01-01', '2025-01-01'),
(3, 'user03', '2024-03-02', '2025-03-02'),
(4, 'user04', '2024-04-03', '2025-04-03'),
(5, 'user05', '2024-05-04', '2025-05-04'),
(6, 'user06', '2024-06-05', '2025-06-05'),
(7, 'user07', '2024-07-06', '2025-07-06'),
(8, 'user08', '2024-08-07', '2025-08-07'),
(9, 'user09', '2024-09-08', '2025-09-08'),
(10, 'user10', '2024-10-09', '2025-10-09'),
(11, 'user11', '2024-11-10', '2025-11-10'),
(13, 'user13', '2025-01-12', '2026-01-12'),
(15, 'user15', '2025-03-14', '2026-03-14'),
(16, 'user16', '2025-04-15', '2026-04-15');
select * from the_thu_vien;
select count(stt_thetv) as sl from the_thu_vien;
-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tk_docgia`
--

CREATE TABLE `tk_docgia` (
  `USERNAME_DG` varchar(30) NOT NULL,
  `STT_THETV` int(11) NOT NULL,
  `TEN_LOAI` char(10) DEFAULT NULL,
  `TEN_DG` varchar(20) NOT NULL,
  `EMAIL_DG` varchar(30) NOT NULL,
  `NGAYSINH_DG` date NOT NULL,
  `PASSWORD_DG` char(10) NOT NULL,
  `DIEM` int DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `tk_docgia`
--

INSERT INTO `tk_docgia` (`USERNAME_DG`, `STT_THETV`, `TEN_LOAI`, `TEN_DG`, `EMAIL_DG`, `NGAYSINH_DG`, `PASSWORD_DG`) VALUES
('user01', 1, 'nguoidung', 'Nguyễn Văn A', 'nguyenvana@example.com', '1990-01-01', 'pass1234'),
('user02', 2, 'nguoidung', 'Nguyễn Văn B', 'nguyenvanb@example.com', '1991-02-01', '1'),
('user03', 3, 'nguoidung', 'Lê Thị C', 'lethic@example.com', '1992-03-02', '1'),
('user04', 4, 'nguoidung', 'Phạm Đình D', 'phamdinhd@example.com', '1993-04-03', '1'),
('user05', 5, 'nguoidung', 'Trần Văn E', 'tranvane@example.com', '1994-05-04', '1'),
('user06', 6, 'nguoidung', 'Hoàng Thị F', 'hoangthif@example.com', '1995-06-05', '1'),
('user07', 7, 'nguoidung', 'Đặng Văn G', 'dangvang@example.com', '1996-07-06', '1'),
('user08', 8, 'nguoidung', 'Bùi Thị H', 'buithih@example.com', '1997-08-07', '1'),
('user09', 9, 'nguoidung', 'Vũ Đình I', 'vudinhi@example.com', '1998-09-08', '1'),
('user10', 10, 'nguoidung', 'Lưu Thị J', 'luuthij@example.com', '1999-10-09', '1'),
('user11', 11, 'nguoidung', 'Nguyễn Đức K', 'nguyenduck@example.com', '2000-11-10', '1'),
('user13', 13, 'nguoidung', 'Đoàn Văn M', 'doanvanm@example.com', '2002-01-12', '1'),
('user15', 15, 'nguoidung', 'Lê Thanh O', 'lethanho@example.com', '2004-03-14', '1'),
('user16', 16, 'nguoidung', 'Trần Quốc P', 'tranquocp@example.com', '2005-04-15', '1');

select * from tk_docgia;
-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tk_quantrivien`
--

CREATE TABLE `tk_quantrivien` (
  `USERNAME_QTV` varchar(30) NOT NULL,
  `TEN_LOAI` char(10) NOT NULL,
  `TEN_QTV` varchar(20) NOT NULL,
  `EMAIL_QTV` char(20) NOT NULL,
  `NGAY_SINH` date NOT NULL,
  `PASSWORD_QTV` char(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `tk_quantrivien` (`USERNAME_QTV`, `TEN_LOAI`, `TEN_QTV`, `EMAIL_QTV`, `NGAY_SINH`, `PASSWORD_QTV`) VALUES
('admin1', 'quantv', 'Nhat Duy', 'toitenla@example.com', '1990-01-01', '1');

--
-- Cấu trúc bảng cho bảng `danh_dau`
--
CREATE TABLE `danh_dau` (
	`USERNAME_DG` varchar(30),
    `MA_SACH` int(11),
    FOREIGN KEY (USERNAME_DG) REFERENCES tk_docgia(USERNAME_DG),
    FOREIGN KEY (MA_SACH) REFERENCES sach(MA_SACH)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
select * from danh_dau;
truncate table danh_dau;
--
-- Chỉ mục cho bảng `chi_tiet_muon_tra`
--
ALTER TABLE `chi_tiet_muon_tra`
  ADD PRIMARY KEY (`STT_PHIEUMUON`,`MA_SACH`),
  ADD KEY `FK_CTMT_SACH` (`MA_SACH`);

--
-- Chỉ mục cho bảng `nha_xuat_ban`
--
ALTER TABLE `nha_xuat_ban`
  ADD PRIMARY KEY (`MA_NXB`);

--
-- Chỉ mục cho bảng `phanloai_taikhoan`
--
ALTER TABLE `phanloai_taikhoan`
  ADD PRIMARY KEY (`TEN_LOAI`);

--
-- Chỉ mục cho bảng `phieu_muon`
--
ALTER TABLE `phieu_muon`
  ADD PRIMARY KEY (`STT_PHIEUMUON`),
  ADD KEY `FK_LAP_PHIEU` (`USERNAME_QTV`),
  ADD KEY `FK_MUON_TRA_THE_THU_VIEN` (`STT_THETV`);

--
-- Chỉ mục cho bảng `sach`
--
ALTER TABLE `sach`
  ADD PRIMARY KEY (`MA_SACH`),
  ADD KEY `FK_THUOC_NXB` (`MA_NXB`),
  ADD KEY `FK_THUOC_THE_LOAI` (`STT_THELOAI`),
  ADD KEY `FK_VIET_SACH` (`MA_TG`);

ALTER TABLE `sach`
	ADD tinhtrang boolean default true;
--
-- Chỉ mục cho bảng `tac_gia`
--
ALTER TABLE `tac_gia`
  ADD PRIMARY KEY (`MA_TG`);

--
-- Chỉ mục cho bảng `the_loai`
--
ALTER TABLE `the_loai`
  ADD PRIMARY KEY (`STT_THELOAI`);

--
-- Chỉ mục cho bảng `the_thu_vien`
--
ALTER TABLE `the_thu_vien`
  ADD PRIMARY KEY (`STT_THETV`),
  ADD KEY `FK_SO_HUU2` (`USERNAME_DG`);

--
-- AUTO_INCREMENT cho bảng `the_thu_vien`
--
ALTER TABLE `the_thu_vien`
  MODIFY `STT_THETV` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- Chỉ mục cho bảng `tk_docgia`
--
ALTER TABLE `tk_docgia`
  ADD PRIMARY KEY (`USERNAME_DG`),
  ADD KEY `FK_SO_HUU` (`STT_THETV`),
  ADD KEY `FK_THUOC_DG` (`TEN_LOAI`);

--
-- Chỉ mục cho bảng `tk_quantrivien`
--
ALTER TABLE `tk_quantrivien`
  ADD PRIMARY KEY (`USERNAME_QTV`),
  ADD KEY `FK_THUOC_QTV` (`TEN_LOAI`);

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `chi_tiet_muon_tra`
--
ALTER TABLE `chi_tiet_muon_tra`
  ADD CONSTRAINT `FK_CTMT_MUONTRA` FOREIGN KEY (`STT_PHIEUMUON`) REFERENCES `phieu_muon` (`STT_PHIEUMUON`),
  ADD CONSTRAINT `FK_CTMT_SACH` FOREIGN KEY (`MA_SACH`) REFERENCES `sach` (`MA_SACH`);

--
-- Các ràng buộc cho bảng `phieu_muon`
--
ALTER TABLE `phieu_muon`
  ADD CONSTRAINT `FK_LAP_PHIEU` FOREIGN KEY (`USERNAME_QTV`) REFERENCES `tk_quantrivien` (`USERNAME_QTV`),
  ADD CONSTRAINT `FK_MUON_TRA_THE_THU_VIEN` FOREIGN KEY (`STT_THETV`) REFERENCES `the_thu_vien` (`STT_THETV`);

--
-- Các ràng buộc cho bảng `sach`
--
ALTER TABLE `sach`
  ADD CONSTRAINT `FK_THUOC_NXB` FOREIGN KEY (`MA_NXB`) REFERENCES `nha_xuat_ban` (`MA_NXB`),
  ADD CONSTRAINT `FK_THUOC_THE_LOAI` FOREIGN KEY (`STT_THELOAI`) REFERENCES `the_loai` (`STT_THELOAI`),
  ADD CONSTRAINT `FK_VIET_SACH` FOREIGN KEY (`MA_TG`) REFERENCES `tac_gia` (`MA_TG`);

--
-- Các ràng buộc cho bảng `the_thu_vien`
--
ALTER TABLE `the_thu_vien`
  ADD CONSTRAINT `FK_SO_HUU2` FOREIGN KEY (`USERNAME_DG`) REFERENCES `tk_docgia` (`USERNAME_DG`);

--
-- Các ràng buộc cho bảng `tk_docgia`
--
ALTER TABLE `tk_docgia`
  ADD CONSTRAINT `FK_SO_HUU` FOREIGN KEY (`STT_THETV`) REFERENCES `the_thu_vien` (`STT_THETV`),
  ADD CONSTRAINT `FK_THUOC_DG` FOREIGN KEY (`TEN_LOAI`) REFERENCES `phanloai_taikhoan` (`TEN_LOAI`);

--
-- Các ràng buộc cho bảng `tk_quantrivien`
--
ALTER TABLE `tk_quantrivien`
  ADD CONSTRAINT `FK_THUOC_QTV` FOREIGN KEY (`TEN_LOAI`) REFERENCES `phanloai_taikhoan` (`TEN_LOAI`);

#them qtv
delimiter $$
create procedure them_admin (in username_qtv varchar(30), ten_loai char(10), ten_qtv varchar(30), email_qtv char(20), ngaysinh date, password_qtv char(10))
begin
	insert into tk_quantrivien values (username_qtv, ten_loai, ten_qtv, email_qtv, ngaysinh, password_qtv);
end$$

call them_admin ('Hello123', 'quantv', 'Nguyen Van A', 'nguyenvana@gmail.com', '2000-2-13', '123456');

#Xoa qtv
delimiter $$
create procedure xoa_admin (in username varchar(30))
begin
	declare ex int;
    select count(*) into ex from tk_quantrivien where username_qtv = username;
    if ex > 0 then
        delete from tk_quantrivien where username_qtv = username;
        select 'Xoá thành công' as result;
	else
		select 'Không tìm thấy admin' as result;
	end if;
end$$

call xoa_admin ('Hello123');