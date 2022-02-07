<?php
require_once 'controllers/Controller.php';
require_once 'models/Movie.php';
require_once 'models/Pagination.php';

class MovieController extends Controller
{

    public function index()
    {
        $movie_model = new Movie();
        $params = [
            'limit' => 5,
            'query_string' => 'page',
            'controller' => 'movie',
            'action' => 'index',
            'full_mode' => FALSE,
        ];
        $page = 1;
        if (isset($_GET['page'])) {
            $page = $_GET['page'];
        }
        if (isset($_GET['name'])) {
            $params['query_additional'] = '&name=' . $_GET['name'];
        }
        $count_total = $movie_model->countTotal();
        $params['total'] = $count_total;
        $params['page'] = $page;
        $pagination = new Pagination($params);
        $pages = $pagination->getPagination();
        $movies = $movie_model->getAllPagination($params);

        $this->content = $this->render('views/movies/index.php', [
            //truyền biến $movies ra vew
            'movies' => $movies,
            //truyền biến phân trang ra view
            'pages' => $pages,
        ]);
        require_once 'views/layouts/main.php';
    }

    public function create()
    {
        if (isset($_POST['submit'])) {
            $name = $_POST['name'];
            $description = $_POST['description'];
            $avatar_files = $_FILES['avatar'];
            
            //check validate
            if (empty($name)) {
                $this->error = 'Cần nhập tên';
            }else if ($avatar_files['error'] == 0) {
                $extension_arr = ['jpg', 'jpeg', 'gif', 'png'];
                $extension = pathinfo($avatar_files['name'], PATHINFO_EXTENSION);
                $extension = strtolower($extension);
                $file_size_mb = $avatar_files['size'] / 1024 / 1024;
                $file_size_mb = round($file_size_mb, 2);

                if (!in_array($extension, $extension_arr)) {
                    $this->error = 'Cần upload file định dạng ảnh';
                } else if ($file_size_mb >= 2) {
                    $this->error = 'File upload không được lớn hơn 2Mb';
                }
            }

            $avatar = '';
            if (empty($this->error)) {
                //xử lý upload ảnh nếu có
                if ($avatar_files['error'] == 0) {
                    $dir_uploads = __DIR__ . '/../assets/uploads';
                    if (!file_exists($dir_uploads)) {
                        mkdir($dir_uploads);
                    }
                    $avatar = time() . '-' . $avatar_files['name'];
                    move_uploaded_file($avatar_files['tmp_name'], $dir_uploads . '/' . $avatar);
                }
                $movie_model = new Movie();
                $movie_model->name = $name;
                $movie_model->avatar = $avatar;
                $movie_model->description = $description;
                $is_insert = $movie_model->insert();
                if ($is_insert) {
                    $_SESSION['success'] = 'Thêm mới thành công';
                } else {
                    $_SESSION['error'] = 'Thêm mới thất bại';
                }
                header('Location: index.php?controller=movie&action=index');
                exit();
            }

        }
        $this->content = $this->render('views/movies/create.php');
        require_once 'views/layouts/main.php';
    }

    public function update()
    {
        if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
            $_SESSION['error'] = 'ID movie không hợp lệ';
            header('Location: index.php?controller=movie&action=index');
            exit();
        }

        $id = $_GET['id'];
        $movie_model = new Movie();
        $movie = $movie_model->getMovieById($id);
        //submit form
        if (isset($_POST['submit'])) {
            $name = $_POST['name'];
            $description = $_POST['description'];
            $avatar_files = $_FILES['avatar'];
            if (empty($name)) {
                $this->error = 'Cần nhập tên';
            }
            else if ($avatar_files['error'] == 0) {
                $extension_arr = ['jpg', 'jpeg', 'gif', 'png'];
                $extension = pathinfo($avatar_files['name'], PATHINFO_EXTENSION);
                $extension = strtolower($extension);
                $file_size_mb = $avatar_files['size'] / 1024 / 1024;
                $file_size_mb = round($file_size_mb, 2);

                if (!in_array($extension, $extension_arr)) {
                    $this->error = 'Cần upload file định dạng ảnh';
                } else if ($file_size_mb >= 2) {
                    $this->error = 'File upload không được lớn hơn 2Mb';
                }
            }
            $avatar = $movie['avatar'];
            if (empty($this->error)) {
                if ($avatar_files['error'] == 0) {
                    //xóa file ảnh cũ đi

                    $dir_uploads = __DIR__ . '/../assets/uploads';
                    if (!file_exists($dir_uploads)) {
                        mkdir($dir_uploads);
                    }
                    @unlink($dir_uploads . '/' . $avatar);
                    $avatar = time() . '-' . $avatar_files['name'];

                    move_uploaded_file($avatar_files['tmp_name'], $dir_uploads . '/' . $avatar);
                }
                $movie_model = new Movie();
                $movie_model->name = $name;
                $movie_model->avatar = $avatar;
                $movie_model->description = $description;
                $movie_model->updated_at = date('Y-m-d H:i:s');
                $is_update = $movie_model->update($id);
                if ($is_update) {
                    $_SESSION['success'] = 'Update thành công';
                } else {
                    $_SESSION['error'] = 'Update thất bại';
                }
                header('Location: index.php?controller=movie&action=index');
                exit();
            }

        }
        $this->content = $this->render('views/movies/update.php', ['movie' => $movie]);
        require_once 'views/layouts/main.php';
    }

    public function delete()
    {
        if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
            $_SESSION['error'] = 'ID không hợp lệ';
            header('Location: index.php?controller=movie&action=index');
            exit();
        }
        $id = $_GET['id'];
        $movie_model = new Movie();
        $is_delete = $movie_model->delete($id);
        if ($is_delete) {
            $_SESSION['success'] = 'Xóa thành công';
        } else {
            $_SESSION['error'] = 'Xóa thất bại';
        }
        header('Location: index.php?controller=movie&action=index');
        exit();
    }

    public function detail()
    {
        if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
            $_SESSION['error'] = 'ID không hợp lệ';
            header('Location: index.php?controller=movie&action=index');
            exit();
        }
        $id = $_GET['id'];
        $movie_model = new Movie();
        $movie = $movie_model->getMovieById($id);
        //lấy nội dung view create.php
       if($_SESSION['user']['roleId'] == 1){
            $this->content = $this->render('views/movies/detail.php', [
                'movie' => $movie
            ]);
            //gọi layout để nhúng nội dung view detail vừa lấy đc
            require_once 'views/layouts/main.php';

       }
       else{
        $this->content = $this->render('views/movies/detail_home.php', [
            'movie' => $movie
        ]);
        //gọi layout để nhúng nội dung view detail vừa lấy đc
        require_once 'views/layouts/main_home.php';

       }
    }

    public function showAll() {
        $params = [];
        //nếu user có hành động filter
        // if (isset($_POST['filter'])) {
        //   if (isset($_POST['movie'])) {
        //     $movie = implode(',', $_POST['movie']);
        //     //chuyển thành chuỗi sau để sử dụng câu lệnh in_array
        //     $str_movie_id = "($movie)";
        //     $params['movie'] = $str_movie_id;
        //   }
        //   if (isset($_POST['price'])) {
        //     $str_price = '';
        //     foreach ($_POST['price'] AS $price) {
        //       if ($price == 1) {
        //         $str_price .= " OR tickers.price < 1000000";
        //       }
        //       if ($price == 2) {
        //         $str_price .= " OR (tickers.price >= 1000000 AND tickers.price < 20000000)";
        //       }
        //       if ($price == 3) {
        //         $str_price .= " OR (tickers.price >= 2000000 AND tickers.price < 30000000)";
        //       }
        //       if ($price == 4) {
        //         $str_price .= " OR tickers.price >= 3000000";
        //       }
        //     }
        //     //cắt bỏ từ khóa OR ở vị trí ban đầu
        //     $str_price = substr($str_price, 3);
        //     $str_price = "($str_price)";
        //     $params['price'] = $str_price;
        //   }
        // }
        $movie_model = new Movie();
        $count_total = $movie_model->countTotal();
        $params_pagination = [
            'total' => $count_total,
            'limit' => 5,
            'query_string' => 'page',
            'controller' => 'ticker',
            'action' => 'showAll',
            'full_mode' => false,
            'query_additional' => '',
            'page' => isset($_GET['page']) ? $_GET['page'] : 1
        ];
        //xử lý phân trang
        $pagination_model = new Pagination($params_pagination);
        $pagination = $pagination_model->getPagination();
        $movies = $movie_model->getMovieInHomePage($params);
    
        $this->content = $this->render('views/movies/index_home.php', [
          'movies' => $movies,
          'pagination' => $pagination,
        ]);
    
        require_once 'views/layouts/main_home.php';
      }
}