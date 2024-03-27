create database Thuvienne;

use Thuvienne;

/*==============================================================*/
/* Table: CHI_TIET_MUON_TRA                                     */
/*==============================================================*/
create table CHI_TIET_MUON_TRA
(
   STT_PHIEUMUON        int not null,
   MA_SACH              int not null,
   TINHTRANG            text not null,
   DA_TRA               bool not null,
   NGAY_TRA             date not null,
   primary key (STT_PHIEUMUON, MA_SACH)
);

/*==============================================================*/
/* Table: NHA_XUAT_BAN                                          */
/*==============================================================*/
create table NHA_XUAT_BAN
(
   MA_NXB               char(10) not null,
   TEN_NXB              varchar(20) not null,
   DIACHI_NXB           varchar(50) not null,
   NGUOIDAIDIEN         text not null,
   primary key (MA_NXB)
);

/*==============================================================*/
/* Table: PHANLOAI_TAIKHOAN                                     */
/*==============================================================*/
create table PHANLOAI_TAIKHOAN
(
   TEN_LOAI             char(10) not null,
   primary key (TEN_LOAI)
);

/*==============================================================*/
/* Table: PHIEU_MUON                                            */
/*==============================================================*/
create table PHIEU_MUON
(
   STT_PHIEUMUON        int not null,
   STT_THETV            int not null,
   USERNAME_QTV         varchar(30) not null,
   NGAY_MUON            date not null,
   NGAY_HENTRA          date not null,
   primary key (STT_PHIEUMUON)
);

/*==============================================================*/
/* Table: SACH                                                  */
/*==============================================================*/
create table SACH
(
   MA_SACH              int not null,
   STT_THELOAI          int not null,
   MA_NXB               char(10) not null,
   MA_TG                char(10) not null,
   TEN_SACH             varchar(20) not null,
   TGXB                 date not null,
   primary key (MA_SACH)
);

/*==============================================================*/
/* Table: TAC_GIA                                               */
/*==============================================================*/
create table TAC_GIA
(
   MA_TG                char(10) not null,
   TEN_TG               varchar(20) not null,
   WEBSITE              varchar(30) not null,
   primary key (MA_TG)
);

/*==============================================================*/
/* Table: THE_LOAI                                              */
/*==============================================================*/
create table THE_LOAI
(
   STT_THELOAI          int not null,
   TEN_TL               varchar(20) not null,
   primary key (STT_THELOAI)
);

/*==============================================================*/
/* Table: THE_THU_VIEN                                          */
/*==============================================================*/
create table THE_THU_VIEN
(
   STT_THETV            int not null,
   USERNAME_DG          varchar(30) not null,
   NGAY_LAPTHE          date not null,
   NGAY_HETHAN          date not null,
   primary key (STT_THETV)
);

/*==============================================================*/
/* Table: TK_DOCGIA                                             */
/*==============================================================*/
create table TK_DOCGIA
(
   USERNAME_DG          varchar(30) not null,
   STT_THETV            int,
   TEN_LOAI             char(10) not null,
   TEN_DG               varchar(20) not null,
   EMAIL_DG             varchar(30) not null,
   NGAYSINH_DG          date not null,
   PASSWORD_DG          char(10) not null,
   primary key (USERNAME_DG)
);

/*==============================================================*/
/* Table: TK_QUANTRIVIEN                                        */
/*==============================================================*/
create table TK_QUANTRIVIEN
(
   USERNAME_QTV         varchar(30) not null,
   TEN_LOAI             char(10) not null,
   TEN_QTV              varchar(20) not null,
   EMAIL_QTV            char(20) not null,
   NGAY_SINH            date not null,
   PASSWORD_QTV         char(10) not null,
   primary key (USERNAME_QTV)
);

alter table CHI_TIET_MUON_TRA add constraint FK_CTMT_MUONTRA foreign key (STT_PHIEUMUON)
      references PHIEU_MUON (STT_PHIEUMUON) on delete restrict on update restrict;

alter table CHI_TIET_MUON_TRA add constraint FK_CTMT_SACH foreign key (MA_SACH)
      references SACH (MA_SACH) on delete restrict on update restrict;

alter table PHIEU_MUON add constraint FK_LAP_PHIEU foreign key (USERNAME_QTV)
      references TK_QUANTRIVIEN (USERNAME_QTV) on delete restrict on update restrict;

alter table PHIEU_MUON add constraint FK_MUON_TRA_THE_THU_VIEN foreign key (STT_THETV)
      references THE_THU_VIEN (STT_THETV) on delete restrict on update restrict;

alter table SACH add constraint FK_THUOC_NXB foreign key (MA_NXB)
      references NHA_XUAT_BAN (MA_NXB) on delete restrict on update restrict;

alter table SACH add constraint FK_THUOC_THE_LOAI foreign key (STT_THELOAI)
      references THE_LOAI (STT_THELOAI) on delete restrict on update restrict;

alter table SACH add constraint FK_VIET_SACH foreign key (MA_TG)
      references TAC_GIA (MA_TG) on delete restrict on update restrict;

alter table THE_THU_VIEN add constraint FK_SO_HUU2 foreign key (USERNAME_DG)
      references TK_DOCGIA (USERNAME_DG) on delete restrict on update restrict;

alter table TK_DOCGIA add constraint FK_SO_HUU foreign key (STT_THETV)
      references THE_THU_VIEN (STT_THETV) on delete restrict on update restrict;

alter table TK_DOCGIA add constraint FK_THUOC_DG foreign key (TEN_LOAI)
      references PHANLOAI_TAIKHOAN (TEN_LOAI) on delete restrict on update restrict;

alter table TK_QUANTRIVIEN add constraint FK_THUOC_QTV foreign key (TEN_LOAI)
      references PHANLOAI_TAIKHOAN (TEN_LOAI) on delete restrict on update restrict;

/*Thêm 2 loại tài khoản */
insert into phanloai_taikhoan(ten_loai) values ('quantv');
insert into phanloai_taikhoan(ten_loai) values ('nguoidung');
/*==============================================================*/

/*Thêm các NXB*/
insert into nha_xuat_ban(ma_nxb, ten_nxb,diachi_nxb, nguoidaidien) values ('001', 'Tân Dân', '63 Nguyễn Du, Hai Bà Trưng, Hà Nội, Việt Nam', 'Nguyễn Bá Thanh');
insert into nha_xuat_ban(ma_nxb, ten_nxb,diachi_nxb, nguoidaidien) values ('002', 'Tân Việt', '45 Hàng Bông, Hoàn Kiếm, Hà Nội, Việt Nam', 'Nguyễn Tường Tam');
insert into nha_xuat_ban(ma_nxb, ten_nxb,diachi_nxb, nguoidaidien) values ('003', 'Kim Đồng', '55 Quang Trung, Hoàn Kiếm, Hà Nội, Việt Nam', 'Lê Quang Thắng');
insert into nha_xuat_ban(ma_nxb, ten_nxb,diachi_nxb, nguoidaidien) values ('004', 'Nhà xuất bản Trẻ', '65 Nguyễn Thị Minh Khai, Hồ Chí Minh, Việt Nam', 'Nguyễn Minh Nhựt');
insert into nha_xuat_ban(ma_nxb, ten_nxb,diachi_nxb, nguoidaidien) values ('005', 'Báo Việt Nữ', '58 Quán Thánh, Ba Đình, Hà Nội, Việt Nam', 'Bùi Thị Thanh');
insert into nha_xuat_ban(ma_nxb, ten_nxb,diachi_nxb, nguoidaidien) values ('006', 'Báo Tiền Phong', '47 Quán Thánh, Ba Đình, Hà Nội, Việt Nam', 'Lê Xuân Sơn');
/*==============================================================*/

/*Thêm các tác giả*/
insert into tac_gia(ma_tg,ten_tg,website) values ('TG001', 'Tô Hoài', 'https://vi.wikipedia.org/wiki/T%C3%B4_Ho%C3%A0i');
insert into tac_gia(ma_tg,ten_tg,website) values ('TG002', 'Thạch Lam', 'https://vi.wikipedia.org/wiki/Th%E1%BA%A1ch_Lam');
insert into tac_gia(ma_tg,ten_tg,website) values ('TG003', 'Đoàn Giỏi', 'https://vi.wikipedia.org/wiki/%C4%90o%C3%A0n_Gi%E1%BB%8Fi');
insert into tac_gia(ma_tg,ten_tg,website) values ('TG004', 'Phạm Công Luận', 'https://www.netabooks.vn/tac-gia/pham-cong-luan-3429');
insert into tac_gia(ma_tg,ten_tg,website) values ('TG005', 'Nguyễn Quan Thân', 'https://vi.wikipedia.org/wiki/Nguy%E1%BB%85n_Quang_Th%C3%A2n');
insert into tac_gia(ma_tg,ten_tg,website) values ('TG006', 'Ngô Tất Tố', 'https://vi.wikipedia.org/wiki/Ng%C3%B4_T%E1%BA%A5t');
insert into tac_gia(ma_tg,ten_tg,website) values ('TG007', 'Kim Lân', 'https://vi.wikipedia.org/wiki/Kim_L%C3%A2n');
/*==============================================================*/

/*Thêm thể loại*/
insert into the_loai(stt_theloai,ten_tl) values (01, 'Văn học thiếu nhi');
insert into the_loai(stt_theloai,ten_tl) values (02, 'Truyện ngắn');
insert into the_loai(stt_theloai,ten_tl) values (03, 'Tiểu thuyết');
/*==============================================================*/

/*Thêm 10 quyển sách*/
insert into sach(ma_sach, stt_theloai, ma_nxb, ma_tg, ten_sach, tgxb) values (110, 01, '001', 'TG001', 'Dế Mèn phiêu lưu ký' ,1941);
insert into sach(ma_sach, stt_theloai, ma_nxb, ma_tg, ten_sach, tgxb) values (111, 02, '002', 'TG001', 'Vợ chồng A Phủ' ,1952);
insert into sach(ma_sach, stt_theloai, ma_nxb, ma_tg, ten_sach, tgxb) values (112, 02, '002', 'TG002', 'Hai đứa trẻ' ,1938);
insert into sach(ma_sach, stt_theloai, ma_nxb, ma_tg, ten_sach, tgxb) values (113, 03, '003', 'TG003', 'Đất rừng phương Nam' ,1957);
insert into sach(ma_sach, stt_theloai, ma_nxb, ma_tg, ten_sach, tgxb) values (114, 01, '004', 'TG004', 'Chú bé Thát Sơn' ,1993);
insert into sach(ma_sach, stt_theloai, ma_nxb, ma_tg, ten_sach, tgxb) values (115, 01, '003', 'TG005', 'Con hạc thờ bí ẩn' ,1983);
insert into sach(ma_sach, stt_theloai, ma_nxb, ma_tg, ten_sach, tgxb) values (116, 03, '003', 'TG003', 'Cuộc truy tầm kho vũ khí' ,1962);
insert into sach(ma_sach, stt_theloai, ma_nxb, ma_tg, ten_sach, tgxb) values (117, 03, '005', 'TG006', 'Tắt đèn' ,1937);
insert into sach(ma_sach, stt_theloai, ma_nxb, ma_tg, ten_sach, tgxb) values (118, 02, '006', 'TG007', 'Vợ nhặt' ,1946);
insert into sach(ma_sach, stt_theloai, ma_nxb, ma_tg, ten_sach, tgxb) values (119, 02, '002', 'TG002', 'Gió lạnh đầu mùa' ,1937);
/*==============================================================*/