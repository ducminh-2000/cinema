<?php
//models/OrderDetail.php
require_once 'models/Model.php';
class OrderDetail extends Model {
  public $order_id;
  public $ticker_id;
  public $movie_id;
  public $quantity;

  public function insert() {
    // + Tạo câu truy vấn dạng tham số
    $sql_insert = "INSERT INTO order_details(order_id, ticker_id,movie_id, quantity) 
                   VALUES (:order_id, :ticker_id, :movie_id, :quantity)";
    // + Tạo đối tượng truy vấn
    $obj_insert = $this->connection->prepare($sql_insert);
    // + Tạo mảng
    $arr_insert = [
        ':order_id' => $this->order_id,
        ':ticker_id' => $this->ticker_id,
        ':movie_id' => $this->movie_id,
        ':quantity' => $this->quantity,
    ];
    // + Thực thi đối tượng truy vấn
    return $obj_insert->execute($arr_insert);
  }

  public function getByOrderId($id){
    $obj_select = $this->connection
            ->prepare("SELECT order_details.*,movies.name AS movie, tickers.price as price FROM order_details
                      Inner join movies on movies.id = order_details.movie_id
                      INNER JOIN tickers ON tickers.id = order_details.ticker_id
                      where order_details.order_id = $id
                      ");
    $obj_select->execute();
    $orderDetail = $obj_select->fetchAll(PDO::FETCH_ASSOC);
    return $orderDetail;
  }
}