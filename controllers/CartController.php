<?php
require_once 'controllers/Controller.php';
require_once 'models/Ticker.php';

class CartController extends Controller
{
    //Phương thức thêm sản phẩm vào giỏ hàng
    public function add()
    {
        //Debug biến $_GET để xem thông tin
        $ticker_id = $_GET['ticker_id'];
        // Gọi model để lấy ra thông tin sản phẩm theo id trên
        $ticker_model = new Ticker();
        $ticker = $ticker_model->getById($ticker_id);

        // Tạo biến để lưu các thông tin sản phẩm theo cấu trúc
        //của giỏ hàng ban đầu: tên sp, giá, avatar, quantity
        $cart = [
            'name' => $ticker['movie_name'],
            'price' => $ticker['price'],
            'movie_id' => $ticker['movie_id'],
            'avatar' => $ticker['movie_avatar'],
            //mặc định số lượng ban đầu khi thêm vào giỏ = 1
            'quantity' => 1
        ];
        // Khi click thêm vào giỏ, sẽ có 2 trường hợp xảy ra:
        // Nếu giỏ hàng chưa từng tồn tại trước đó, thì cần khởi tạo
        //giỏ hàng và thêm sản phẩm mới vào giỏ
        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'][$ticker_id] = $cart;
        }
        // Nếu giỏ hàng đã tồn tại trước đó r, có 2 trường hợp xảy ra
        // + NẾu sản phẩm đã tồn tại trong giỏ hàng r thì sẽ chỉ
        // update số lượng của sp đó
        // + Nếu sản phẩm chưa tồn tại thì thêm mới như bình thường
        else {
            if (array_key_exists($ticker_id, $_SESSION['cart'])) {
                $_SESSION['cart'][$ticker_id]['quantity']++;
            } else {
                $_SESSION['cart'][$ticker_id] = $cart;
            }
        }
    }

    //Phương thức liệt kê sản phẩm trong giỏ - Giỏ hàng của bạn
    public function index()
    {
        //Debug mảng $_POST
        // Xử lý Cập nhật giỏ hàngs
        if (isset($_POST['submit'])) {
            //Xử lý thêm trường hợp nếu nhập số lượng là số âm thì sẽ
            //ko xủ lý update
            foreach ($_SESSION['cart'] AS $ticker_id => $cart) {
                if ($_POST[$ticker_id] < 0) {
                    $_SESSION['error'] = 'Số lượng phải > 0';
                    header('Location: index.php?controller=cart&action=index');
                    exit();
                }
            }
            //Lặp giỏ hàng, truy cập phần tử mảng theo id, r set
            //lại số lượng tương ứng từ form gửi lên
            foreach ($_SESSION['cart'] AS $ticker_id => $cart) {
                $_SESSION['cart'][$ticker_id]['quantity'] = $_POST[$ticker_id];
            }
            $_SESSION['success'] = 'Cập nhật giỏ thành công';
        }

        //Lấy  nội dung view views/carts/index.php
        $this->content = $this->render('views/carts/index.php');
        // Gọi layout để hiển thị nội dung view trên
        require_once 'views/layouts/main_home.php';

    }

    //Phương thức xóa sản phẩm khỏi Giỏ
    public function delete() {
        //Do trong rewrite đã có regex bắt buộc id phải là số, nên ko
        //cần validate bằng PHP nữa
        $ticker_id = $_GET['id'];
        //Xử lý xóa
        unset($_SESSION['cart'][$ticker_id]);
        //Sau mỗi lần xóa cần kiểm tra nếu xóa hết sp trong giỏ thì
        //cần xóa Giỏ hàng
        if (empty($_SESSION['cart'])) {
            unset($_SESSION['cart']);
        }
        $_SESSION['success'] = "Xóa $ticker_id thành công";
        header("Location: index.php?controller=cart&action=index");
        exit();
    }
}