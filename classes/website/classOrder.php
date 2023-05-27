<?php
include __DIR__ . "/../../config/Database.php";

class order extends Database
{
  private int $orderId;
  private float $orderTotalPrice = 0;

  public function insert_order($data)
  {
    $this->insertOrder($data);
    $this->insertOrderItems();
    $this->updateOrderTotalPrice();
    unset($_SESSION['cart']);
    $_SESSION['cartCountItems'] = 0;
    return  ['success' => true, "order_id" => $this->orderId, 'message' => "order has been added successfully"];
  }

  private function insertOrder(array $data): void
  {
    $date = date('Y-m-d h:i:s');
    $status = "orderd";
    $customer_name = mysqli_real_escape_string($this->conn, $data['full-name']);
    $customer_contact = mysqli_real_escape_string($this->conn, $data['contact']);
    $customer_email = mysqli_real_escape_string($this->conn, $data['email']);
    $customer_address = mysqli_real_escape_string($this->conn, $data['address']);

    $result = $this->conn->query(
      "INSERT INTO tbl_order SET
        order_date='$date',
        status='$status',
        customer_name='$customer_name',
        customer_contact='$customer_contact',
        customer_email='$customer_email',
        customer_address='$customer_address'"
    );
    if ($result) {
      $this->orderId = $this->conn->insert_id;
    }
  }

  private function insertOrderItems(): void
  {
    foreach ($_SESSION['cart'] as $item) {
      $this->orderTotalPrice += $item['food_quantity'] * $item['food_price'];
      $this->conn->query(
        "INSERT INTO tbl_order_items SET
          order_id='" . $this->orderId . "',
          food_id='" . $item['food_id'] . "',
          food_title='" . $item['food_title'] . "',
          food_price='" . $item['food_price'] . "',
          food_quantity='" . $item['food_quantity'] . "',
          total_price='" . $item['food_quantity'] * $item['food_price'] . "'
        "
      );
    }
  }
  private function updateOrderTotalPrice(): void
  {
    $this->conn->query(
      "UPDATE tbl_order SET
        total_price='" . $this->orderTotalPrice . "' WHERE id = $this->orderId"
    );
  }
}
