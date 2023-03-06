<?php


    namespace src;

    class Controller
    {
        private $view;
        public $errors;

        public function __construct()
        {
            $this->view = new \src\View();
        }

        public function index()
        {
            $list = \src\Receipt::receiptList();
            $this->view->generate('index.php', ['list' => $list]);

        }


        public function newReceipt()
        {
            $result = false;
            if (isset($_POST['create'])) {
                $model = new \src\Receipt($_POST['clientId']);
                $model->save();
            }

            $list = \src\Receipt::receiptList();
            $this->view->generate('index.php', ['list' => $list, 'error'=>$errors, 'stats'=>\src\Receipt::getStats()]);
        }
        public function addToReceipt()
        {
            $result = false;
            if (isset($_POST['add'])) {
                $model = \src\Receipt::findReceipt($_POST['receiptId']);
                if($model){
                    $model->addDishesIds($_POST['dishId']);
                    $model->save();
                }
                else{
                    $this->errors[] = 'Dont found opened receipt with this number';
                }
            }

            $list = \src\Receipt::receiptList();
            $this->view->generate('index.php', ['list' => $list, 'errors'=>$this->errors, 'stats'=>\src\Receipt::getStats()]);
        }
    }