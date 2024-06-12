<?php
include "../connect.php";
$user = $_SESSION['id_user'] ?? null;

//thông tin của admin
function getAdminInfo($user, $conn) {
    $sql = "SELECT * FROM users WHERE id_user = ? AND role = 'admin'";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$user]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}
//tìm kiếm tài khoản theo vai trò
function getTaiKhoanByRole($role, $conn) {
    $sql = "SELECT * FROM users WHERE role = :role";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(":role", $role);
    $stmt->execute();
    $accounts = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $accounts;
}

//lấy tài khoản
function getTaiKhoan($conn) {
    try {
        $sql = "SELECT * FROM users";
        $stmt = $conn->query($sql);    
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo "Lỗi: " . $e->getMessage();
        return false; 
    }
}
//lây id tài khoản
function getUserById($id_user, $conn) {
    $sql = "SELECT * FROM users WHERE id_user = :id_user";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':id_user', $id_user, PDO::PARAM_STR);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($user) {
        return $user;
    } else {
        return false;
    }
}

function updateTaiKhoan($id_user, $ten, $email, $gioi_tinh, $ngay_sinh, $dia_chi, $hinh_the, $ma_lop, $khoa, $role, $conn) {
    try {
        $sql = "UPDATE users SET ten = :ten, email = :email, gioi_tinh = :gioi_tinh, ngay_sinh = :ngay_sinh, dia_chi = :dia_chi, hinh_the = :hinh_the, ma_lop = :ma_lop, khoa = :khoa, role = :role WHERE id_user = :id_user";
        $stmt = $conn->prepare($sql);

        $stmt->bindParam(':id_user', $id_user);
        $stmt->bindParam(':ten', $ten);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':gioi_tinh', $gioi_tinh);
        $stmt->bindParam(':ngay_sinh', $ngay_sinh);
        $stmt->bindParam(':dia_chi', $dia_chi);
        $stmt->bindParam(':hinh_the', $hinh_the);
        $stmt->bindParam(':ma_lop', $ma_lop);
        $stmt->bindParam(':khoa', $khoa);
        $stmt->bindParam(':role', $role);

        $stmt->execute();

        return true;
    } catch (PDOException $e) {
        error_log("Lỗi khi cập nhật tài khoản: " . $e->getMessage());
        return false;
    }
}





//thêm tài khoản
function themTaiKhoan($id_user, $password, $role, $ten, $email, $gioi_tinh, $ngay_sinh, $dia_chi, $hinh_the, $ma_lop, $khoa, $conn) {
    // Get the temporary file path of the uploaded image
    $hinh_the_tmp = $hinh_the['tmp_name'];

    // Prepare the SQL statement to insert a new user into the database
    $sql = "INSERT INTO users (id_user, password, role, ten, email, gioi_tinh, ngay_sinh, dia_chi, hinh_the, ma_lop, khoa) 
            VALUES (:id_user, :password, :role, :ten, :email, :gioi_tinh, :ngay_sinh, :dia_chi, :hinh_the, :ma_lop, :khoa)";

    // Prepare the SQL statement
    $stmt = $conn->prepare($sql);

    // Bind parameters to the placeholders
    $stmt->bindParam(':id_user', $id_user);
    $stmt->bindParam(':password', $password);
    $stmt->bindParam(':role', $role);
    $stmt->bindParam(':ten', $ten);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':gioi_tinh', $gioi_tinh);
    $stmt->bindParam(':ngay_sinh', $ngay_sinh);
    $stmt->bindParam(':dia_chi', $dia_chi);
    $stmt->bindParam(':hinh_the', $hinh_the_tmp); // Use the temporary file path
    $stmt->bindParam(':ma_lop', $ma_lop);
    $stmt->bindParam(':khoa', $khoa);

    // Execute the statement
    if ($stmt->execute()) {
        // If insertion is successful, return true
        return true;
    } else {
        // If insertion fails, return false
        return false;
    }
}


//kiểm tra id_user đã tồn tại hay chưa
function checkExistingUser($id_user, $conn) {
    $sql = "SELECT COUNT(*) AS count FROM users WHERE id_user = :id_user";
    $stmt = $conn->prepare($sql);
    $stmt->bindValue(":id_user", $id_user);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result['count'] > 0;
}
//lay lop học
function getClasses($conn) {
    try {
        $sql = "SELECT * FROM lophoc";
        $stmt = $conn->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo "Lỗi: " . $e->getMessage();
        return false;
    }
}




//thêm môn học
function addSubject($id_mh, $ten, $so_tin_chi, $conn) {
    try {
        $sql = "INSERT INTO monhoc (id_mh, ten, so_tin_chi) VALUES (:id_mh, :ten, :so_tin_chi)";
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(':id_mh', $id_mh);
        $stmt->bindValue(':ten', $ten);
        $stmt->bindValue(':so_tin_chi', $so_tin_chi, PDO::PARAM_INT);

        return $stmt->execute();
    } catch (PDOException $e) {
        // Log error or handle it as necessary
        return false;
    }
}

//tất cả giảng viên
function getTatCaGiangVien($conn) {
    $sql = "SELECT * FROM users WHERE role = 'teacher'";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

//tất cả môn học có trong hệ thống

function getAllMonHoc($conn) {
    $sql = "SELECT * FROM monhoc";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}


if (isset($_GET['id_hk'])) {
    $id_hk = $_GET['id_hk'];
    $hocKy = getMotHocKy($id_hk, $conn);
}
//thông tin học kỳ 
function getHocKy($conn) {
    $sql = "SELECT id_hk, ten_hk, Nam_hoc FROM hocky";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

if (isset($_GET['id_lhp'])) {
    $id_lhp = $_GET['id_lhp'];
    $lopHocPhan = getMotLopHocPhan($id_lhp, $conn);
}



//thông tin một học có bao nhiêu lớp học phần
function getMotHocKy($id_hk, $conn) {
    $sql = "SELECT monhoc.ten AS ten_monhoc, lophocphan.id_lhp, monhoc.so_tin_chi
            FROM lophocphan
            INNER JOIN monhoc ON lophocphan.id_mh = monhoc.id_mh 
            INNER JOIN users ON lophocphan.id_gv = users.id_user
            LEFT JOIN danhsachlophocphan ON lophocphan.id_lhp = danhsachlophocphan.id_lhp
            WHERE lophocphan.id_hk = :id_hk
            GROUP BY lophocphan.id_lhp";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':id_hk', $id_hk);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}


//hàm update học kì
function updateHocKy($id_hk, $ten_hk, $nam_hoc, $conn) {
    $sql = "UPDATE hocky SET ten_hk = :ten_hk, nam_hoc = :nam_hoc WHERE id_hk = :id_hk";
    $stmt = $conn->prepare($sql);

    $stmt->bindParam(':id_hk', $id_hk);
    $stmt->bindParam(':ten_hk', $ten_hk);
    $stmt->bindParam(':nam_hoc', $nam_hoc);

    if ($stmt->execute()) {
        return true;
    } else {
        return false;
    }
}
function getHocKiById($id_hk, $conn) {
    $sql = "SELECT * FROM hocky WHERE id_hk = :id_hk";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':id_hk', $id_hk);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result;
}


//Hàm update Môn học
function updateMonHoc($id_mh, $ten_mh, $so_tin_chi, $conn) {
    $sql = "UPDATE monhoc SET ten = :ten_mh, so_tin_chi = :so_tin_chi WHERE id_mh = :id_mh";
    $stmt = $conn->prepare($sql);

    $stmt->bindParam(':id_mh', $id_mh);
    $stmt->bindParam(':ten_mh', $ten_mh);
    $stmt->bindParam(':so_tin_chi', $so_tin_chi);

    if ($stmt->execute()) {
        return true;
    } else {
        return false;
    }
}

function getMonHocById($id_mh, $conn) {
    $sql = "SELECT * FROM monhoc WHERE id_mh = :id_mh";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':id_mh', $id_mh);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result;
}

function getLopHocPhan($conn, $id_lhp = null) {
    $sql = "SELECT lophocphan.id_lhp, lophoc.tenLop AS ten_lop, monhoc.ten AS ten_monhoc, users.ten AS ten_giangvien, hocky.ten_hk, COUNT(danhsachlophocphan.ma_sv) AS si_so
            FROM lophocphan
            INNER JOIN monhoc ON lophocphan.id_mh = monhoc.id_mh
            INNER JOIN users ON lophocphan.id_gv = users.id_user
            INNER JOIN hocky ON lophocphan.id_hk = hocky.id_hk
            INNER JOIN lophoc ON lophocphan.id_lh = lophoc.id_lh
            LEFT JOIN danhsachlophocphan ON lophocphan.id_lhp = danhsachlophocphan.id_lhp";

    if ($id_lhp) {
        $sql .= " WHERE lophocphan.id_lhp = :id_lhp";
    }

    $sql .= " GROUP BY lophocphan.id_lhp, lophoc.tenLop, monhoc.ten, users.ten, hocky.ten_hk";
    $stmt = $conn->prepare($sql);

    if ($id_lhp) {
        $stmt->bindParam(':id_lhp', $id_lhp);
    }

    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function getLopHocPhanList($conn) {
    $sql = "SELECT id_lhp FROM lophocphan";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function getMonHocList($conn) {
    $sql = "SELECT id_mh, ten FROM monhoc";
    $result = $conn->query($sql);
    $monHocList = $result->fetchAll(PDO::FETCH_ASSOC);
    return $monHocList;
}

function getGiangVienList($conn) {
    $sql = "SELECT id_user, ten FROM users WHERE role = 'teacher'";
    $result = $conn->query($sql);
    $giangVienList = $result->fetchAll(PDO::FETCH_ASSOC);
    return $giangVienList;
}

function themLopHocPhan($id_lhp, $id_lh, $id_mh, $id_gv, $id_hk, $conn) {
    try {

        $sql = "INSERT INTO lophocphan (id_lhp, id_lh, id_mh, id_gv, id_hk) VALUES (:id_lhp, :id_lh, :id_mh, :id_gv, :id_hk)";
        

        $stmt = $conn->prepare($sql);
        

        $stmt->bindParam(':id_lhp', $id_lhp);
        $stmt->bindParam(':id_lh', $id_lh);
        $stmt->bindParam(':id_mh', $id_mh);
        $stmt->bindParam(':id_gv', $id_gv);
        $stmt->bindParam(':id_hk', $id_hk);
        
        $stmt->execute();


        return true;
    } catch (PDOException $e) {

        echo "Lỗi: " . $e->getMessage();
        return false;
    }
}

function getLopHoc($conn) {
    $sql = "SELECT * FROM lophoc";
    $result = $conn->query($sql);
    $LopHoc = $result->fetchAll(PDO::FETCH_ASSOC);
    return $LopHoc;
}

function themLopHoc($id_lh, $tenLop, $conn) {
    try {
        $sql = "INSERT INTO lophoc (id_lh, tenLop) VALUES (:id_lh, :tenLop)";
        $stmt = $conn->prepare($sql);

        $stmt->bindParam(':id_lh', $id_lh);
        $stmt->bindParam(':tenLop', $tenLop);

        $stmt->execute();

        return true;
    } catch (PDOException $e) {
        error_log("Error adding class: " . $e->getMessage());
        return false;
    }
}

function getLopHocById($id_lh, $conn) {
    try {
        $sql = "SELECT * FROM lophoc WHERE id_lh = :id_lh";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':id_lh', $id_lh);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        error_log("Lỗi khi lấy thông tin lớp học: " . $e->getMessage());
        return false;
    }
}

// Hàm cập nhật thông tin lớp học
function capNhatLopHoc($id_lh, $tenLop, $conn) {
    try {
        $sql = "UPDATE lophoc SET tenLop = :tenLop WHERE id_lh = :id_lh";

        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':tenLop', $tenLop);
        $stmt->bindParam(':id_lh', $id_lh);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            return true; 
        } else {
            return false; 
        }
    } catch (PDOException $e) {

        echo "Lỗi: " . $e->getMessage();
        return false; 
    }
}

function getMotLopHocPhan($id_lhp, $conn) {
    try {
        $sql = "SELECT * FROM danhsachlophocphan WHERE id_lhp = :id_lhp";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':id_lhp', $id_lhp);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        error_log("Lỗi khi lấy thông tin lớp học: " . $e->getMessage());
        return false;
    }
}

function getLopHocPhanById($id_lhp, $conn) {
    try {
        $sql = "SELECT * FROM danhsachlophocphan WHERE id_lhp = :id_lhp";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':id_lhp', $id_lhp);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        error_log("Lỗi khi lấy thông tin lớp học: " . $e->getMessage());
        return false;
    }
}





