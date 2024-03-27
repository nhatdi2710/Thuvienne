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


