<?php
require_once 'models/Model.php';

class Ticker extends Model
{

    public $id;
    public $movie_id;
    public $price;
    public $amount;
    public $created_at;
    public $updated_at;
    /*
     * Chuỗi search, sinh tự động dựa vào tham số GET trên Url
     */
    public $str_search = '';

    public function __construct()
    {
        parent::__construct();
        if (isset($_GET['movie_id']) && !empty($_GET['movie_id'])) {
            $this->str_search .= " AND tickers.movie_id = {$_GET['movie_id']}";
        }
    }

    /**
     * Lấy thông tin của sản phẩm đang có trên hệ thống
     * @return array
     */
    public function getAll()
    {
        $obj_select = $this->connection
            ->prepare("SELECT tickers.*, movies.name AS movie_name FROM tickers 
                        INNER JOIN movies ON movies.id = tickers.movie_id
                        WHERE TRUE $this->str_search
                        ORDER BY tickers.created_at DESC
                        ");

        $arr_select = [];
        $obj_select->execute($arr_select);
        $tickers = $obj_select->fetchAll(PDO::FETCH_ASSOC);

        return $tickers;
    }

    /**
     * Lấy thông tin của sản phẩm đang có trên hệ thống
     * @param array Mảng các tham số phân trang
     * @return array
     */
    public function getAllPagination($arr_params)
    {
        $limit = $arr_params['limit'];
        $page = $arr_params['page'];
        $start = ($page - 1) * $limit;
        $obj_select = $this->connection
            ->prepare("SELECT tickers.*, movies.name AS movie_name FROM tickers 
                        INNER JOIN movies ON movies.id = tickers.movie_id
                        WHERE TRUE $this->str_search
                        ORDER BY tickers.updated_at DESC, tickers.created_at DESC
                        LIMIT $start, $limit
                        ");

        $arr_select = [];
        $obj_select->execute($arr_select);
        $tickers = $obj_select->fetchAll(PDO::FETCH_ASSOC);

        return $tickers;
    }

    /**
     * Tính tổng số bản ghi đang có trong bảng tickers
     * @return mixed
     */
    public function countTotal()
    {
        $obj_select = $this->connection->prepare("SELECT COUNT(id) FROM tickers WHERE TRUE $this->str_search");
        $obj_select->execute();

        return $obj_select->fetchColumn();
    }

    /**
     * Insert dữ liệu vào bảng tickers
     * @return bool
     */
    public function insert()
    {
        $obj_insert = $this->connection
            ->prepare("INSERT INTO tickers(movie_id, price, amount) 
                                VALUES (:movie_id, :price, :amount)");
        $arr_insert = [
            ':movie_id' => $this->movie_id,
            ':price' => $this->price,
            ':amount' => $this->amount,
        ];
        return $obj_insert->execute($arr_insert);
    }

    /**
     * Lấy thông tin sản phẩm theo id
     * @param $id
     * @return mixed
     */
    public function getById($id)
    {
        $obj_select = $this->connection
            ->prepare("SELECT tickers.*, movies.id AS movie_id, movies.avatar AS movie_avatar FROM tickers 
          INNER JOIN movies ON tickers.movie_id = movies.id WHERE tickers.id = $id");

        $obj_select->execute();
        return $obj_select->fetch(PDO::FETCH_ASSOC);
    }


    public function update($id)
    {
        $obj_update = $this->connection
            ->prepare("UPDATE tickers SET movie_id=:movie_id,price=:price,amount=:amount,
            updated_at=:updated_at WHERE id = $id
");
        $arr_update = [
            ':movie_id' => $this->movie_id,
            ':price' => $this->price,
            ':amount' => $this->amount,
            ':updated_at' => $this->updated_at,
        ];
        return $obj_update->execute($arr_update);
    }

    public function delete($id)
    {
        $obj_delete = $this->connection
            ->prepare("DELETE FROM tickers WHERE id = $id");
        return $obj_delete->execute();
    }

    public function getTickerInHomePage($params = []) {
        $str_filter = '';
        if (isset($params['movie'])) {
          $str_movie = $params['movie'];
          $str_filter .= " AND movies.id IN $str_movie";
        }
        if (isset($params['price'])) {
          $str_price = $params['price'];
          $str_filter .= " AND $str_price";
        }
        //do cả 2 bảng tickers và movies đều có trường name, nên cần phải thay đổi lại tên cột cho 1 trong 2 bảng
        $sql_select = "SELECT tickers.*, movies.name 
              AS movie_name FROM tickers
              INNER JOIN movies ON tickers.movie_id = movies.id
              WHERE TRUE $str_filter";
    
        $obj_select = $this->connection->prepare($sql_select);
        $obj_select->execute();
    
        $tickers = $obj_select->fetchAll(PDO::FETCH_ASSOC);
        return $tickers;
      }
}