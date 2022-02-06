<?php
require_once 'controllers/Controller.php';
require_once 'models/Ticker.php';
require_once 'models/Movie.php';
require_once 'models/Pagination.php';

class TickerController extends Controller
{
    public function index()
    {
        $ticker_model = new Ticker();

        //lấy tổng số bản ghi đang có trong bảng tickers
        $count_total = $ticker_model->countTotal();
        //        xử lý phân trang
        $query_additional = '';
        if (isset($_GET['movie_id'])) {
            $query_additional .= '&movie_id=' . $_GET['movie_id'];
        }
        $arr_params = [
            'total' => $count_total,
            'limit' => 5,
            'query_string' => 'page',
            'controller' => 'ticker',
            'action' => 'index',
            'full_mode' => false,
            'query_additional' => $query_additional,
            'page' => isset($_GET['page']) ? $_GET['page'] : 1
        ];
        $tickers = $ticker_model->getAllPagination($arr_params);
        $pagination = new Pagination($arr_params);

        $pages = $pagination->getPagination();

        //lấy danh sách movie đang có trên hệ thống để phục vụ cho search
        $movie_model = new Movie();
        $movies = $movie_model->getAll();
        if($_SESSION['user']['roleId'] == 1){
            $this->content = $this->render('views/tickers/index.php', [
                'tickers' => $tickers,
                'movies' => $movies,
                'pages' => $pages,
            ]);
            require_once 'views/layouts/main.php';
        }
        else{
            $this->content = $this->render('views/tickers/index_home.php', [
                'tickers' => $tickers,
                'movies' => $movies,
                'pages' => $pages,
            ]);
            require_once 'views/layouts/main_home.php';
        }
    }

    public function create()
    {
        //xử lý submit form
        if (isset($_POST['submit'])) {
            $movie_id = $_POST['movie_id'];
            $price = $_POST['price'];
            $amount = $_POST['amount'];
            //xử lý validate
            if (empty($price)) {
                $this->error = 'Không được để trống giá';
            }

            //nếu ko có lỗi thì tiến hành save dữ liệu
            if (empty($this->error)) {
                //save dữ liệu vào bảng tickers
                $ticker_model = new Ticker();
                $ticker_model->movie_id = $movie_id;
                $ticker_model->price = $price;
                $ticker_model->amount = $amount;
                $is_insert = $ticker_model->insert();
                if ($is_insert) {
                    $_SESSION['success'] = 'Insert dữ liệu thành công';
                } else {
                    $_SESSION['error'] = 'Insert dữ liệu thất bại';
                }
                header('Location: index.php?controller=ticker');
                exit();
            }
        }

        //lấy danh sách movie đang có trên hệ thống để phục vụ cho search
        $movie_model = new Movie();
        $movies = $movie_model->getAll();

        $this->content = $this->render('views/tickers/create.php', [
            'movies' => $movies
        ]);
        require_once 'views/layouts/main.php';
    }

    public function detail()
    {
        if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
            $_SESSION['error'] = 'ID không hợp lệ';
            header('Location: index.php?controller=ticker');
            exit();
        }

        $id = $_GET['id'];
        $ticker_model = new Ticker();
        $ticker = $ticker_model->getById($id);
        if($_SESSION['user']['roleId'] == 1){
            $this->content = $this->render('views/tickers/detail.php', [
                'ticker' => $ticker
            ]);
            require_once 'views/layouts/main.php';
        }
        else{
            $this->content = $this->render('views/tickers/detail_home.php', [
                'ticker' => $ticker
            ]);
            require_once 'views/layouts/main_home.php';
        }
    }

    public function update()
    {
        if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
            $_SESSION['error'] = 'ID không hợp lệ';
            header('Location: index.php?controller=ticker');
            exit();
        }

        $id = $_GET['id'];
        $ticker_model = new Ticker();
        $ticker = $ticker_model->getById($id);
        //xử lý submit form
        if (isset($_POST['submit'])) {
            $movie_id = $_POST['movie_id'];
            $price = $_POST['price'];
            $amount = $_POST['amount'];
            //xử lý validate
            if (empty($price)) {
                $this->error = 'Không được để trống giá';
            }

            //nếu ko có lỗi thì tiến hành save dữ liệu
            if (empty($this->error)) {
                //save dữ liệu vào bảng tickers
                $ticker_model->movie_id = $movie_id;
                $ticker_model->price = $price;
                $ticker_model->amount = $amount;
                $ticker_model->updated_at = date('Y-m-d H:i:s');

                $is_update = $ticker_model->update($id);
                if ($is_update) {
                    $_SESSION['success'] = 'Update dữ liệu thành công';
                } else {
                    $_SESSION['error'] = 'Update dữ liệu thất bại';
                }
                header('Location: index.php?controller=ticker');
                exit();
            }
        }

        //lấy danh sách movie đang có trên hệ thống để phục vụ cho search
        $movie_model = new Movie();
        $movies = $movie_model->getAll();

        $this->content = $this->render('views/tickers/update.php', [
            'movies' => $movies,
            'ticker' => $ticker,
        ]);
        require_once 'views/layouts/main.php';
    }

    public function delete()
    {
        if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
            $_SESSION['error'] = 'ID không hợp lệ';
            header('Location: index.php?controller=ticker');
            exit();
        }

        $id = $_GET['id'];
        $ticker_model = new Ticker();
        $is_delete = $ticker_model->delete($id);
        if ($is_delete) {
            $_SESSION['success'] = 'Xóa dữ liệu thành công';
        } else {
            $_SESSION['error'] = 'Xóa dữ liệu thất bại';
        }
        header('Location: index.php?controller=ticker');
        exit();
    }   
}