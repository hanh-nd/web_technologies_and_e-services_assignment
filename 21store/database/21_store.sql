SET GLOBAL time_zone = '+07:00';


CREATE TABLE users (
    id int(10) AUTO_INCREMENT,
    username varchar(50) NOT NULL,
    password varchar(50) NOT NULL,
    fullname varchar(50),
    phone_number varchar(50),
    address varchar(50),
    role varchar(50) DEFAULT 'user',
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

CREATE TABLE products (
    id int(10) AUTO_INCREMENT,
    product_name varchar(50) NOT NULL,
    product_description varchar(200),
    price int(10),
    image_url varchar(200),
    size varchar(5) NOT NULL,
    color varchar(20) NOT NULL,
    material varchar(50) NOT NULL,
    brand_id int(10),
    product_type varchar(100),
    rate  decimal(10, 1) DEFAULT '0.0',
    quantity int(10),
    created_at datetime DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (id),
    FOREIGN KEY (brand_id) REFERENCES brands(id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE comments (
    id int(10) AUTO_INCREMENT,
    user_id int(10) NOT NULL,
    product_id int(10) NOT NULL,
    content varchar(200),
    rate int(10) DEFAULT 5,
    created_at datetime DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (id),
    FOREIGN KEY (product_id) REFERENCES products(id),
    FOREIGN KEY (user_id) REFERENCES users(id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE cart_sessions (
    id int(10) AUTO_INCREMENT,
    user_id int(10) NOT NULL,
    total_amount int(10) DEFAULT 0,
    created_at datetime DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (id),
    FOREIGN KEY (user_id) REFERENCES users(id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE cart_items (
    id int(10) AUTO_INCREMENT,
    cart_session_id int(10) NOT NULL,
    product_id int(10) NOT NULL,
    quantity int(10),
    created_at datetime DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (id),
    FOREIGN KEY (cart_session_id) REFERENCES cart_sessions(id),    
    FOREIGN KEY (product_id) REFERENCES products(id)    
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Trigger update total amount in cart session after create cart items --
DELIMITER $$
CREATE TRIGGER update_cart_sessions_after_insert
AFTER INSERT ON `cart_items` FOR EACH ROW
begin
    declare existed_cart_session_id Boolean;
    -- Check cart sessions table --
    SELECT 1
    INTO @existed_cart_session_id
    FROM cart_sessions
    WHERE cart_sessions.id = NEW.cart_session_id;

    IF @existed_cart_session_id = 1
    THEN
        SET @price = (SELECT price FROM products WHERE id = NEW.product_id);
        UPDATE cart_sessions
        SET total_amount = total_amount + NEW.quantity * @price
        WHERE id = NEW.cart_session_id;
    END IF;
END; $$
DELIMITER  ;

DELIMITER $$
CREATE TRIGGER update_cart_sessions_after_delete
AFTER DELETE ON `cart_items` FOR EACH ROW
BEGIN
    declare existed_cart_session_id Boolean;
    -- Check cart sessions table --
    SELECT 1
    INTO @existed_cart_session_id
    FROM cart_sessions
    WHERE cart_sessions.id = OLD.cart_session_id;

    IF @existed_cart_session_id = 1
    THEN
        SET @price = (SELECT price FROM products WHERE id = OLD.product_id);
        UPDATE cart_sessions
        SET total_amount = total_amount - OLD.quantity * @price
        WHERE id = OLD.cart_session_id;
    END IF;
END; $$
DELIMITER  ;
-- end trigger

CREATE TABLE bills (
    id int(10) AUTO_INCREMENT,
    user_id int(10) NOT NULL,
    total_amount int(10) DEFAULT 0,
    status varchar(100) DEFAULT "Chờ xác nhận", 
    created_at datetime DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (id),
    FOREIGN KEY (user_id) REFERENCES users(id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE order_items (
    id int(10) AUTO_INCREMENT,
    bill_id int(10) NOT NULL,
    product_id int(10) NOT NULL,
    quantity int(10),
    created_at datetime DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (id),
    FOREIGN KEY (bill_id) REFERENCES bills(id),    
    FOREIGN KEY (product_id) REFERENCES products(id)    
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Trigger update total amount in bill after create order items --
DELIMITER $$
CREATE TRIGGER update_bills_after_insert
AFTER INSERT ON `order_items` FOR EACH ROW
begin
    declare existed_bill_id Boolean;
    -- Check bills table --
    SELECT 1
    INTO @existed_bill_id
    FROM bills
    WHERE bills.id = NEW.bill_id;

    IF @existed_bill_id = 1
    THEN
        SET @price = (SELECT price FROM products WHERE id = NEW.product_id);
        UPDATE bills
        SET total_amount = total_amount + NEW.quantity * @price
        WHERE id = NEW.bill_id;
    END IF;
END; $$
DELIMITER ;

DELIMITER $$
CREATE TRIGGER update_bills_after_delete
AFTER DELETE ON `order_items` FOR EACH ROW
BEGIN
    declare existed_bill_id Boolean;
    -- Check bills table --
    SELECT 1
    INTO @existed_bill_id
    FROM bills
    WHERE bills.id = OLD.bill_id;

    IF @existed_bill_id = 1
    THEN
        SET @price = (SELECT price FROM products WHERE id = OLD.product_id);
        UPDATE bills
        SET total_amount = total_amount - OLD.quantity * @price
        WHERE id = OLD.bill_id;
    END IF;
END; $$
DELIMITER  ;
-- end trigger

INSERT INTO brands(brand_name, image_url) VALUES ("ARMANI", "https://static.cdnlogo.com/logos/e/41/emporio-armani.svg"), ("FENDI", "https://i.pinimg.com/originals/97/f8/f8/97f8f8332d2e31fe20877f1b8ee3a8e9.png"), ("VERSACE", "https://global-uploads.webflow.com/5e157548d6f7910beea4e2d6/5ed97c67c917b86429019e61_Versace%20(1).png"), ("BURBERRY", "https://logos-world.net/wp-content/uploads/2020/08/Burberry-Logo-2018-present.jpg"), ("CHANEL", "https://cdn.elly.vn/uploads/2021/01/06205934/y-nghia-logo-thuong-hieu-chanel.png"), ("PRADA", "https://www.elleman.vn/wp-content/uploads/2019/07/27/logo-thu%CC%9Bo%CC%9Bng-hie%CC%A3%CC%82u-prada-nguye%CC%82n-ba%CC%89n.jpg"), ("HERMES", "https://bazaarvietnam.vn/wp-content/uploads/2022/03/BZ-logo-hermes-stories-history-meaning-01.jpg"), ("GUCCI", "https://i.pinimg.com/originals/0e/9e/df/0e9edf68a71c691ba32b5e88847588f8.png"), ("LOUIS VUITTON", "https://upload.wikimedia.org/wikipedia/commons/thumb/7/76/Louis_Vuitton_logo_and_wordmark.svg/1679px-Louis_Vuitton_logo_and_wordmark.svg.png");

INSERT INTO products(product_name, product_description, price, image_url, size, color, material, brand_id, product_type, quantity) VALUES ("Quần caro ống suông", "QUẦN TÂY CƠ BẢN, BẢNG LƯNG KHOẢNG 4CM, QUẦN CÓ PAGHET, DÂY KÉO Ở GIỮA, CÓ NÚT, TRƯỚC CÓ XÊP LY EO, CÓ TÚI.", "384000", "https://cdn.gumac.vn/image2/bo-suu-tap-web/2022/t0622/0-caro-qc06071040620221450400431.jpg?width=450", "XS", "đen", "LINEN PHA", 1, "Quần", 100), ("Chân váy xòe xếp ly", "CHÂN VÁY FORM A XÒE, BẢN LƯNG KHOẢNG 4CM, CÓ XẾP LY TẠI PHẦN THÂN TRƯỚC VÀ SAU TẠO ĐỘ XÒE, DÂY KÉO PHÍA SAU.", "229000", "https://cdn.gumac.vn/image2/bo-suu-tap-web/2022/t0622/0-xam-lv0612280520221319071170.jpg?width=450", "XS", "đen", "LINE THUN", 2, "Váy", 100), ("Đầm voan bèo vai", "ĐẦM FORM XÒE, TAY DÀI, ĐỈNH VAI CÓ PHỐI BÈO TẠO KIỂU, CỬA TAY CÓ BO CHUN CO GIÃN, ĐẦM RÃ CÚP NGỰC, RÃ EO CÓ NHÚN XẾP LY, DÂY KÉO PHÍA SAU.", "279000", "https://cdn.gumac.vn/image2/bo-suu-tap-web/2022/t0622/0-xanh-dc06072280520221123358511.jpg?width=450", "XS", "xanh", "VOAN", 3, "Đầm", 100), ("Đầm họa tiết ly eo", "ĐẦM FORM HƠI A, CỔ TRÒN, TAY LỞ, XẾP LY NHÚN Ở ĐỈNH VAI VÀ CỬA TAY TẠO ĐỘ PHỒNG, BẢNG CỬA TAY KHOẢNG 3.CM, CÓ NÚT CÀI, ĐẦM RÃ EO, PHẦN RÃ EO CÓ XẾP LY, DÂY KÉO PHÍA SAU.", "440000", "https://cdn.gumac.vn/image2/bo-suu-tap-web/2022/t0722/1-vang-dc06070270620221600150147.jpg?width=450", "S", "vàng", "LỤA", 4, "Đầm", 100), ("Chân váy xòe đính nút", "CHÂN VÁY XÒE, BẢNG LƯNG KHOẢNG 8CM, BẢNG LƯNG CÓ ĐÍNH NÚT TẠO KIỂU, ĐIỂM RÃ EO CÓ XẾP LY MỞ TẠO ĐỘ XÒE.", "249000", "https://cdn.gumac.vn/image2/bo-suu-tap-web/2022/t0622/0-kem-vc06057260520221424127824.jpg?width=450", "S", "vàng", "PHI TATTA", 5, "Chân váy", 100), ("Quần suông ống rộng", "QUẦN TÂY ỐNG RỘNG, LƯNG LIỀN, QUẦN CÓ PAGHET, DÂY KÉO Ở GIỮA, CÓ NÚT, PHẦN LƯNG BÊN PHẢI NGƯỜI MẶC CÓ ĐÍNH ĐAI, TRÊN ĐAI CÓ ĐÍNH NÚT NHỰA TẠO KIỂU.", "348000", "https://cdn.gumac.vn/image2/bo-suu-tap-web/2022/t0622/0-den-qc06068-fix060620221309474960.jpg?width=450", "S", "Đen", "COTTON CHÉO", 6, "Quần", 100), ("Quần tây cơ bản", "QUẦN TÂY CƠ BẢN, BẢN LƯNG KHOẢNG 4CM, QUẦN CÓ PAGHET, DÂY KÉO Ở GIỮA, CÓ NÚT, CÓ TÚI.", "360000", "https://cdn.gumac.vn/image2/bo-suu-tap-web/2022/t0622/0-den-qc06059250520221544249661.jpg?width=450", "S", "Đỏ", "COTTON Hàn", 7, "Quần", 100), ("Đầm maxi cổ bèo", "ĐẦM FORM A DÀI, CỔ TIM CÓ PHỐI BÈO, PHÍA SAU CÓ DÂY KÉO.", "440000", "https://cdn.gumac.vn/image2/bo-suu-tap-web/2022/t0622/0-hong-dc06069250520221135093491.jpg?width=450", "S", "Hồng", "CHIFON", 8, "Đầm", 100), ("Quần jeans ống loe", "QUẦN JEANS ỐNG HƠI LOE, BẢN LƯNG KHOẢNG CM, QUẦN CÓ PAGET, DÂY KÉO Ở GIỮA, CÓ NÚT, PHẦN LAI TUA RUA.", "560000", "https://cdn.gumac.vn/image2/bo-suu-tap-web/2022/t0722/0-xdam-qjc07020280620221648282404.jpg?width=450", "S", "XANH ĐẬM, XANH NHẠT", "JEANS", 9, "Quần", 100), ("Quần tây ống suông", "QUẦN TÂY FORM ỐNG SUÔNG, BẢN LƯNG KHOẢNG 4CM, QUẦN CÓ PAGET, DÂY KÉO MỞ GIỮA, CÓ NÚT NHỰA, ĐẦU LƯNG NHỌN.", "480000", "https://cdn.gumac.vn/image2/bo-suu-tap-web/2022/t0722/0-den-lq0710290620221125450948.jpg?width=450", "S", "đen", "COTTON CHÉO", 8, "Quần", 100), ("Đầm hoa nhún ngực", "ĐẦM FORM A XÒE NHẸ, CỔ V, TAY LOE NGẮN, ĐẦM RÃ CÚP NGỰC, XẾP LY NHÚN Ở NGỰC, DÂY KÉO PHÍA SAU.", "530000", "https://cdn.gumac.vn/image2/bo-suu-tap-web/2022/t0722/0-hong-ld0702210620221511286826.jpg?width=450", "S", "HỒNG", "CHIFON", 9, "Đầm", 100), ("Đầm form A phối viền", "ĐẦM FORM A, CỔ BÂU SEN, TAY NGẮN, TRƯỚC CÓ NẸP PHỐI VIỀN, RÃ EO, CÓ TÚI, CÓ DÂY KÉO PHÍA SAU.", "530000", "https://cdn.gumac.vn/image2/bo-suu-tap-web/2022/t0722/0-xanh-dc07033270620221553458665.jpg?width=450", "S", "XANH", "BỐ SỌC", 9, "Đầm", 100), ("Đầm lệch vai phụ kiện", "ĐẦM FORM BÚT CHÌ, CỔ HƠI THUYỀN, KHÔNG TAY, VAI BNÊ TRÁI CÓ ĐÍNH NÚT NGỌC TẠO KIỂU, ĐẦM RÃ EO, BÊN EO TRÁI CÓ ĐÍNH DÂY THẮT NƠ, DÂY KÉO PHÍA SAU, LAI SAU CÓ XẺ TÀ KHOẢNG 21CM.", "550000", "https://cdn.gumac.vn/image2/bo-suu-tap-web/2022/t0722/0-den-dc07035250620221642566917.jpg?width=450", "S", "ĐEN, TÍM", "COTTON MỊN", 8, "Đầm", 100), ("Áo cổ nhún tay phồng", "ÁO KIỂU FORM CƠ BẢN, CỔ TRÒN, PHẦN CỔ SAU CÓ DÂY THẮT NƠ, TAY DÀI, BẢN CỬA TAY KHOẢNG 6CM, CÓ NÚT NGỌC, CỔ TRƯỚC XẾP LY NHÚN.", "350000", "https://cdn.gumac.vn/image2/bo-suu-tap-web/2022/t0722/0-xanh-la0704280620221104047406.jpg?width=450", "S", "XANH", "VOAN", 6, "Áo", 100), ("Áo sơ mi cổ bẻ", "ÁO SƠ MI FORM CƠ BẢN, BÂU SAM, TAY DÀI, BẢN MĂNG SẾT KHOẢNG 7.3CM CÓ NÚT NHỰA.", "375000", "https://cdn.gumac.vn/image2/bo-suu-tap-web/2022/t0722/0-trang-la0706280620221122067719.jpg?width=450", "S", "ĐỎ, TRẮNG", "LỤA XƯỚC", 4, "Áo", 100), ("Áo thun in Memories", "ÁO THUN FORM CƠ BẢN, CỔ TRÒN, TAY NGẮN, TRƯỚC NGỰC CÓ IN HÌNH VÀ CHỮ.", "270000", "https://cdn.gumac.vn/image2/bo-suu-tap-web/2022/t0722/0-be-atc07037280620221404526326.jpg?width=450", "S", "BE, TRẮNG, XANH", "TICI", 9, "Áo", 100), ("Áo thun sát nách", "ÁO THUN FORM HƠI ÔM, SÁT NÁCH, CỔ TRÒN.", "170000", "https://cdn.gumac.vn/image2/bo-suu-tap-web/2022/t0722/0-xam-atc07003220620221128183828.jpg?width=450", "S", "TRẮNG, ĐEN, XÁM", "THUN GÂN TICI", 3, "Áo", 100), ("Áo khoác dù rút dây", "ÁO KHOÁC FORM NỮ, CÓ NÓN, PHẦN NÓN CÓ LUỒNG DÂY RÚT, DÂY KÉO Ở GIỮA TRƯỚC, TAY DÀI CÓ BO CHUN CO GIÃN, LAI CÓ DÂY RÚT CÓ THỂ ĐIỀU CHỈNH,  TÚI CÓ DÂY KÉO.", "450000", "https://cdn.gumac.vn/image2/bo-suu-tap-web/2022/t0622/0nau-ac06015260520221108485691.jpg?width=450", "S", "ĐEN, NÂU", "DÙ", 1, "Áo", 100), ("Đầm form A thắt nơ", "ĐẦM FORM A, CỔ BÂU SEN, GIỮA CÓ ĐÍNH NÚT TẠO KIỂU, TAY NGẮN, ĐẦM RÃ EO, CÓ DÂY BUỘC Ở EO, PHÍA SAU CÓ DÂY KÉO.", "550000", "https://cdn.gumac.vn/image2/bo-suu-tap-web/2022/t0622/0-trang-dc06008250520221305175573.jpg?width=450", "S", "TÍM, TRẮNG", "LINE", 9, "Đầm", 100);

INSERT INTO users(username, password, fullname, phone_number, address, role) VALUES ("admin", "admin", "Admin", "113", "DH Bach Khoa Ha Noi", "admin");
INSERT INTO users(username, password, fullname, phone_number, address) VALUES ("hoanganh", "123123", "Nguyen Duy Hoang Anh", "0912972138", "Nga Son Thanh Hoa");
INSERT INTO users(username, password, fullname, phone_number, address) VALUES ("votienbac", "123123", "Vo Tien Bac", "0912976138", "Ha Tinh");
INSERT INTO users(username, password, fullname, phone_number, address) VALUES ("nguyenvanhung", "123123", "Nguyen Van Hung", "0911975138", "Hoang Hoa Thanh Hoa");
INSERT INTO users(username, password, fullname, phone_number, address) VALUES ("ngodanghanh", "123123", "Ngo Dang Hanh", "0912975738", "Ha Noi");

INSERT INTO comments(product_id, user_id, rate, content) VALUES ("1", "1", "1" ,"sp xau");

INSERT INTO bills(user_id) VALUES (3);

INSERT INTO order_items(bill_id, product_id, quantity) VALUES (1, 3, 2);
INSERT INTO order_items(bill_id, product_id, quantity) VALUES (1, 5, 4);


INSERT INTO bills(user_id, status) VALUES (3, "Đã mua");

INSERT INTO order_items(bill_id, product_id, quantity) VALUES (2, 6, 1);
INSERT INTO order_items(bill_id, product_id, quantity) VALUES (2, 2, 2);

DELETE FROM order_items WHERE id = 4;
