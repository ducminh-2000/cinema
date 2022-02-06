<?php
//models/movie
require_once 'models/Model.php';
class Movie extends Model {
    //khai báo các thuộc tính cho model trùng với các trường
//    của bảng movies
    public $id;
    public $name;
    public $avatar;
    public $description;
    public $created_at;
    public $updated_at;

    public $str_search = '';
    public function __construct()
    {
        parent::__construct();
        if (isset($_GET['name']) && !empty($_GET['name'])) {
            $this->str_search .= " AND `name` LIKE '%{$_GET['name']}%'";
        }
    }

    //insert dữ liệu vào bảng movies
    public function insert() {
        $sql_insert =
            "INSERT INTO movies(`name`, `description`, `avatar`)
VALUES (:name, :description, :avatar)";
        //cbi đối tượng truy vấn
        $obj_insert = $this->connection
            ->prepare($sql_insert);
        //gán giá trị thật cho các placeholder
        $arr_insert = [
            ':name' => $this->name,
            ':avatar' => $this->avatar,
            ':description' => $this->description
        ];
        return $obj_insert->execute($arr_insert);
    }

    /**
     * LẤy thông tin danh mục trên hệ thống
     * @param $params array Mảng các tham số search
     * @return array
     */
    public function getAll($params = []) {
        //tạo 1 chuỗi truy vấn để thêm các điều kiện search
        //dựa vào mảng params truyền vào
        $str_search = 'WHERE TRUE';
        //check mảng param truyền vào để thay đổi lại chuỗi search
        if (isset($params['name']) && !empty($params['name'])) {
            $name = $params['name'];
            //nhớ phải có dấu cách ở đầu chuỗi
            $str_search .= " AND `name` LIKE '%$name%'";
        }
        //tạo câu truy vấn
        //gắn chuỗi search nếu có vào truy vấn ban đầu
        $sql_select_all = "SELECT movies.* FROM movies $str_search";
        //cbi đối tượng truy vấn
        $obj_select_all = $this->connection
            ->prepare($sql_select_all);
        $obj_select_all->execute();
        $movies = $obj_select_all
            ->fetchAll(PDO::FETCH_ASSOC);
        return $movies;
    }

    public function getMovieInHomePage($params = []) {
        $str_search = 'WHERE TRUE';
        //check mảng param truyền vào để thay đổi lại chuỗi search
        if (isset($params['name']) && !empty($params['name'])) {
            $name = $params['name'];
            //nhớ phải có dấu cách ở đầu chuỗi
            $str_search .= " AND `name` LIKE '%$name%'";
        }
        //tạo câu truy vấn

        $sql_select = "SELECT movies.*, tickers.price AS ticker_price, 
        tickers.id AS ticker_id
        FROM movies INNER JOIN tickers ON movies.id = tickers.movie_id $str_search";
    
        $obj_select = $this->connection->prepare($sql_select);
        $obj_select->execute();
    
        $tickers = $obj_select->fetchAll(PDO::FETCH_ASSOC);
        return $tickers;
      }


    public function getById($id) {
        $sql_select_one = "SELECT * FROM movies WHERE id = $id";
        $obj_select_one = $this->connection
            ->prepare($sql_select_one);
        $obj_select_one->execute();
        $movie = $obj_select_one->fetch(PDO::FETCH_ASSOC);
        return $movie;
    }

    /**
     * Lấy movie theo id truyền vào
     * @param $id
     * @return array
     */
    public function getMovieById($id)
    {
        $obj_select = $this->connection
            ->prepare("SELECT * FROM movies WHERE id = $id");
        $obj_select->execute();
        $movie = $obj_select->fetch(PDO::FETCH_ASSOC);

        return $movie;
    }

    /**
     * Update bản ghi theo id truyền vào
     * @param $id
     * @return bool
     */
    public function update($id)
    {
        $obj_update = $this->connection->prepare("UPDATE movies SET `name` = :name, `description` = :description,`avatar` =:avatar, `updated_at` = :updated_at 
         WHERE id = $id");
        $arr_update = [
            ':name' => $this->name,
            ':avatar' => $this->avatar,
            ':description' => $this->description,
            ':updated_at' => $this->updated_at
        ];

        return $obj_update->execute($arr_update);
    }

    /**
     * Xóa bản ghi theo id truyền vào
     * @param $id
     * @return bool
     */
    public function delete($id)
    {
        $obj_delete = $this->connection
            ->prepare("DELETE FROM movies WHERE id = $id");
        $is_delete = $obj_delete->execute();
        //để đảm bảo toàn vẹn dữ liệu, sau khi xóa movie thì cần xóa cả các ticker nào đang thuộc về movie này
        $obj_delete_ticker = $this->connection
            ->prepare("DELETE FROM tickers WHERE movie_id = $id");
        $obj_delete_ticker->execute();

        return $is_delete;
    }

    /**
     * Lấy tổng số bản ghi trong bảng movies
     * @return mixed
     */
    public function countTotal()
    {
        $obj_select = $this->connection->prepare("SELECT COUNT(id) FROM movies");
        $obj_select->execute();

        return $obj_select->fetchColumn();
    }

    public function getAllPagination($params = [])
    {
        $limit = $params['limit'];
        $page = $params['page'];
        $start = ($page - 1) * $limit;
        $obj_select = $this->connection
            ->prepare("SELECT * FROM movies WHERE TRUE $this->str_search LIMIT $start, $limit");
        $obj_select->execute();
        $movies = $obj_select->fetchAll(PDO::FETCH_ASSOC);

        return $movies;
    }
}