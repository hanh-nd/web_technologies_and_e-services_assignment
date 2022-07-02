SET GLOBAL time_zone = '+07:00';

CREATE TABLE products (
    id int(10) AUTO_INCREMENT,
    product_name varchar(50) NOT NULL,
    product_description varchar(200),
    price int(10),
    image_url varchar(200),
    size varchar(5) NOT NULL,
    color varchar(20) NOT NULL,
    material varchar(50) NOT NULL,
    brand varchar(50),
    product_type varchar(100),
    rate  varchar(10) DEFAULT '0',
    created_at datetime DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE brands (
    id int(10) AUTO_INCREMENT,
    brand_name varchar(50) NOT NULL,
    image_url varchar(200),
    created_at datetime DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE users (
    id int(10) AUTO_INCREMENT,
    username varchar(50) NOT NULL,
    password varchar(50) NOT NULL,
    phone_number varchar(50) NOT NULL,
    address varchar(50) NOT NULL,
    role varchar(50) DEFAULT 'user',
    created_at datetime DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE comments (
    id int(10) AUTO_INCREMENT,
    product_id int(10) NOT NULL,
    user_id  int(10) NOT NULL,
    content varchar(200),
    rate int(10) DEFAULT 5,
    created_at datetime DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (id),
    FOREIGN KEY (product_id) REFERENCES products(id),
    FOREIGN KEY (user_id) REFERENCES users(id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO products(product_name, product_description, price, image_url, size, color, material, brand, product_type) VALUES ("Quần caro ống suông", "QUẦN TÂY CƠ BẢN, BẢNG LƯNG KHOẢNG 4CM, QUẦN CÓ PAGHET, DÂY KÉO Ở GIỮA, CÓ NÚT, TRƯỚC CÓ XÊP LY EO, CÓ TÚI.", "384000", "https://cdn.gumac.vn/image2/bo-suu-tap-web/2022/t0622/0-caro-qc06071040620221450400431.jpg?width=450", "XS", "đen", "LINEN PHA", "ARMANI", "Quần"), ("Chân váy xòe xếp ly", "CHÂN VÁY FORM A XÒE, BẢN LƯNG KHOẢNG 4CM, CÓ XẾP LY TẠI PHẦN THÂN TRƯỚC VÀ SAU TẠO ĐỘ XÒE, DÂY KÉO PHÍA SAU.", "229000", "https://cdn.gumac.vn/image2/bo-suu-tap-web/2022/t0622/0-xam-lv0612280520221319071170.jpg?width=450", "XS", "đen", "LINE THUN", "FENDI", "Váy"), ("Đầm voan bèo vai", "ĐẦM FORM XÒE, TAY DÀI, ĐỈNH VAI CÓ PHỐI BÈO TẠO KIỂU, CỬA TAY CÓ BO CHUN CO GIÃN, ĐẦM RÃ CÚP NGỰC, RÃ EO CÓ NHÚN XẾP LY, DÂY KÉO PHÍA SAU.", "279000", "https://cdn.gumac.vn/image2/bo-suu-tap-web/2022/t0622/0-xanh-dc06072280520221123358511.jpg?width=450", "XS", "xanh", "VOAN", "BURBERRY", "Đầm"), ("Đầm họa tiết ly eo", "ĐẦM FORM HƠI A, CỔ TRÒN, TAY LỞ, XẾP LY NHÚN Ở ĐỈNH VAI VÀ CỬA TAY TẠO ĐỘ PHỒNG, BẢNG CỬA TAY KHOẢNG 3.CM, CÓ NÚT CÀI, ĐẦM RÃ EO, PHẦN RÃ EO CÓ XẾP LY, DÂY KÉO PHÍA SAU.", "440000", "https://cdn.gumac.vn/image2/bo-suu-tap-web/2022/t0722/1-vang-dc06070270620221600150147.jpg?width=450", "S", "vàng", "LỤA", "CHANEL", "Đầm"), ("Chân váy xòe đính nút", "CHÂN VÁY XÒE, BẢNG LƯNG KHOẢNG 8CM, BẢNG LƯNG CÓ ĐÍNH NÚT TẠO KIỂU, ĐIỂM RÃ EO CÓ XẾP LY MỞ TẠO ĐỘ XÒE.", "249000", "https://cdn.gumac.vn/image2/bo-suu-tap-web/2022/t0622/0-kem-vc06057260520221424127824.jpg?width=450", "S", "vàng", "PHI TATTA", "PRADA", "Chân váy"), ("Quần suông ống rộng", "QUẦN TÂY ỐNG RỘNG, LƯNG LIỀN, QUẦN CÓ PAGHET, DÂY KÉO Ở GIỮA, CÓ NÚT, PHẦN LƯNG BÊN PHẢI NGƯỜI MẶC CÓ ĐÍNH ĐAI, TRÊN ĐAI CÓ ĐÍNH NÚT NHỰA TẠO KIỂU.", "348000", "https://cdn.gumac.vn/image2/bo-suu-tap-web/2022/t0622/0-den-qc06068-fix060620221309474960.jpg?width=450", "S", "Đen", "COTTON CHÉO", "HERMES", "Quần"), ("Quần tây cơ bản", "QUẦN TÂY CƠ BẢN, BẢN LƯNG KHOẢNG 4CM, QUẦN CÓ PAGHET, DÂY KÉO Ở GIỮA, CÓ NÚT, CÓ TÚI.", "360000", "https://cdn.gumac.vn/image2/bo-suu-tap-web/2022/t0622/0-den-qc06059250520221544249661.jpg?width=450", "S", "Đỏ", "COTTON Hàn", "GUCCI", "Quần"), ("Đầm maxi cổ bèo", "ĐẦM FORM A DÀI, CỔ TIM CÓ PHỐI BÈO, PHÍA SAU CÓ DÂY KÉO.", "440000", "https://cdn.gumac.vn/image2/bo-suu-tap-web/2022/t0622/0-hong-dc06069250520221135093491.jpg?width=450", "S", "Hồng", "CHIFON", "LOUIS VUITTON", "Đầm");

INSERT INTO brands(brand_name, image_url) VALUES ("ARMANI", "https://static.cdnlogo.com/logos/e/41/emporio-armani.svg"), ("FENDI", "https://i.pinimg.com/originals/97/f8/f8/97f8f8332d2e31fe20877f1b8ee3a8e9.png"), ("VERSACE", "https://global-uploads.webflow.com/5e157548d6f7910beea4e2d6/5ed97c67c917b86429019e61_Versace%20(1).png"), ("BURBERRY", "https://logos-world.net/wp-content/uploads/2020/08/Burberry-Logo-2018-present.jpg"), ("CHANEL", "https://cdn.elly.vn/uploads/2021/01/06205934/y-nghia-logo-thuong-hieu-chanel.png"), ("PRADA", "https://www.elleman.vn/wp-content/uploads/2019/07/27/logo-thu%CC%9Bo%CC%9Bng-hie%CC%A3%CC%82u-prada-nguye%CC%82n-ba%CC%89n.jpg"), ("HERMES", "https://bazaarvietnam.vn/wp-content/uploads/2022/03/BZ-logo-hermes-stories-history-meaning-01.jpg"), ("GUCCI", "https://i.pinimg.com/originals/0e/9e/df/0e9edf68a71c691ba32b5e88847588f8.png"), ("LOUIS VUITTON", "https://upload.wikimedia.org/wikipedia/commons/thumb/7/76/Louis_Vuitton_logo_and_wordmark.svg/1679px-Louis_Vuitton_logo_and_wordmark.svg.png");

INSERT INTO users(username, password, phone_number, address) VALUES ("hoanganh", "123123", "0912972138", "Nga Son Thanh Hoa");
INSERT INTO users(username, password, phone_number, address) VALUES ("Bac Vo Tien", "123123", "0912976138", "Ha Tinh");
INSERT INTO users(username, password, phone_number, address) VALUES ("Nguyen Van Hung", "123123", "0911975138", "Hoang Hoa Thanh Hoa");
INSERT INTO users(username, password, phone_number, address) VALUES ("Ngo Dang Hanh", "123123", "0912975738", "Ha Noi");

INSERT INTO comments(product_id, user_id, rate, content) VALUES ("1", "1", "1" ,"sp nhu biu");


create table admin(
	admin_username varchar(50) not null,
    admin_password varchar(50)
);
insert admin(admin_username, admin_password)
value('admin', 'admin');

