-- Bảng người dùng
CREATE TABLE nguoiDung (
    id INT PRIMARY KEY AUTO_INCREMENT,
    tenDangNhap VARCHAR(255) NOT NULL,
    matKhau VARCHAR(255) NOT NULL,
    anhDaiDien VARCHAR(255),
    email VARCHAR(255),
    diaChi VARCHAR(255),
    vaiTro VARCHAR(50)
);

-- Bảng chuyên đề
CREATE TABLE chuyenDe (
    id INT PRIMARY KEY AUTO_INCREMENT,
    tenChuyenDe VARCHAR(255) NOT NULL,
    boCauHoi VARCHAR(255),
    boDapAn VARCHAR(255)
);

-- Bảng câu hỏi
CREATE TABLE cauHoi (
    id INT PRIMARY KEY AUTO_INCREMENT,
    noiDung TEXT NOT NULL,
    hinhAnh VARCHAR(255),
    chuyenDeId INT,
    FOREIGN KEY (chuyenDeId) REFERENCES chuyenDe(id)
);

-- Bảng đáp án
CREATE TABLE dapAn (
    id INT PRIMARY KEY AUTO_INCREMENT,
    noiDung TEXT NOT NULL,
    hinhAnh VARCHAR(255),
    laDapAnDung BOOLEAN,
    cauHoiId INT,
    FOREIGN KEY (cauHoiId) REFERENCES cauHoi(id)
);

-- Bảng đề thi
CREATE TABLE deThi (
    id INT PRIMARY KEY AUTO_INCREMENT,
    chuyenDeId INT,
    lichThiId INT,
    FOREIGN KEY (chuyenDeId) REFERENCES chuyenDe(id),
    FOREIGN KEY (lichThiId) REFERENCES lichThi(id)
);

-- Bảng lịch thi
CREATE TABLE lichThi (
    id INT PRIMARY KEY AUTO_INCREMENT,
    thoiGianBatDau DATETIME,
    thoiGianKetThuc DATETIME,
    thoiGianThi INT,
    soLuongDeThi INT
);

-- Bảng kết quả
CREATE TABLE ketQua (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nguoiDungId INT,
    deThiId INT,
    diem FLOAT,
    FOREIGN KEY (nguoiDungId) REFERENCES nguoiDung(id),
    FOREIGN KEY (deThiId) REFERENCES deThi(id)
);


--Bản cực kì demo. Sẽ không gộp vào trong database chính ngay mà sẽ chỉ nhập tạm thời vào branch của cá nhân tôi.
--Sẽ chỉ show lên khi hoản thiện