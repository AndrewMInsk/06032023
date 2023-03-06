<?php
    namespace src;

    class Receipt
    {
        private $receiptId;
        private $clientId;
        private $dishesIds = [];

        /**
         * @param $receiptId
         * @param array $dishesIds
         */
        public function __construct($clientId = null, $receiptId = null, array $dishesIds = [])
        {
            $this->clientId = $clientId;
            $this->receiptId = $receiptId;
            $this->dishesIds = $dishesIds;
        }

        /**
         * @return mixed
         */
        public function getReceiptId()
        {
            return $this->receiptId;
        }

        /**
         * @param mixed $receiptId
         */
        public function setReceiptId($receiptId): void
        {
            $this->receiptId = $receiptId;
        }
        
        /**
         * @return mixed
         */
        public function getClientId()
        {
            return $this->clientId;
        }

        /**
         * @param mixed $receiptId
         */
        public function setClientId($clientId): void
        {
            $this->clientId = $clientId;
        }


        /**
         * @return array
         */
        public function getDishesIds(): array
        {
            return $this->dishesIds;
        }

        /**
         * @param array $dishesIds
         */
        public function setDishesIds(array $dishesIds): void
        {
            $this->dishesIds = $dishesIds;
        }
        /**
         * @param array $dishesIds
         */
        public function addDishesIds($dishId): void
        {
            $this->dishesIds[] = $dishId;
        }

                /**
         * full stats
         */
        public static function getStats(): array
        {
            $conn = (new Database())->getConn();
            $sql = "SELECT dish_id as dish_id, count(*) as  count FROM receipt_to_dishes group by dish_id";
            $result = $conn->query($sql);
            return mysqli_fetch_all($result, MYSQLI_ASSOC);

        }
                /**
         * @param array $dishesIds
         */
        public function save()
        {
            $conn = (new Database())->getConn();
            if($this->getReceiptId()) {
                $stmt = $conn->prepare("DELETE FROM receipt_to_dishes WHERE receipt_id = ?");
                $stmt->bind_param('i', $this->receiptId);
                $stmt->execute();
                foreach ($this->getDishesIds() as $dish){
                    $stmt = $conn->prepare("INSERT INTO receipt_to_dishes SET dish_id = ?, receipt_id = ? ");
                    $stmt->bind_param('ii', $dish, $this->receiptId);
                    $stmt->execute();
                }
            }
            else{
                $stmt = $conn->prepare("INSERT INTO receipt SET client_id = ? ");
                $stmt->bind_param('i', $this->getClientId());
                $stmt->execute();
            }
            if ($conn->affected_rows) {
                return true;
            }
            return false;
        }
        public static function findReceipt($receiptId)
        {            
            $conn = (new Database())->getConn();
            $sql = "SELECT * FROM receipt WHERE receipt_id = $receiptId limit 1";
            $result = $conn->query($sql);
            $row = mysqli_fetch_assoc($result);
            if($row){
                $model = new self($row['client_id'],$row['receipt_id']);

                $query = "SELECT * FROM receipt_to_dishes WHERE receipt_id = " . $receiptId;
                $result = mysqli_query($conn, $query);
                while ($row = mysqli_fetch_array($result)) {
                $model->addDishesIds($row['dish_id']);
                }
                return $model;
            }

        }
        public static function receiptList()
        {            
            $conn = (new Database())->getConn();
            $sql = "SELECT * FROM receipt";
            $result = $conn->query($sql);
            $row = mysqli_fetch_assoc($result);
            $list = [];
            while ($row = mysqli_fetch_array($result)) {
                $model = new self($row['client_id'],$row['receipt_id']);

                $queryDish = "SELECT * FROM receipt_to_dishes WHERE receipt_id = " . $row['receipt_id'];
                $resultDish = mysqli_query($conn, $queryDish);
                while ($rowDish = mysqli_fetch_array($resultDish)) {
                    $model->addDishesIds($rowDish['dish_id']);
                }

                $list[] = $model;
            }
            return $list;
        }
    }