<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Orders</title>
    <link href="/admin/css/Dashboard.css" rel="stylesheet">
</head>

<body>
<nav class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0">
    <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="#">Menu</a>
    <div class=" form-control-dark w-100"></div>
    <ul class="navbar-nav px-3">
        <li class="nav-item text-nowrap">
            <a class="nav-link" href="/admin/logout.php">Sign out</a>
        </li>
    </ul>
</nav>

<div class="container-fluid">
    <div class="row">
        <nav class="col-md-2 d-none d-md-block bg-light sidebar">
            <div class="sidebar-sticky">
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link active" href="#">
                            <span data-feather="file"></span>
                            Orders
                            <!--                   TODO DELETE -->
                            <!-- <span class="sr-only">(current)</span> -->
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/admin/view/Dashboard.php">
                            <span data-feather="shopping-cart"></span>
                            Products
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/admin/view/Customers.php">
                            <span data-feather="users"></span>
                            Customers
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/admin/view/Questions.php">
                            <span data-feather="inbox"></span>
                            Questions
                        </a>
                    </li>
                </ul>
            </div>
        </nav>

        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom"
                 style="text-align: center">
                <h1 class="h2">Orders</h1>
            </div>
            <div class="table-responsive">
                <table class="table table-striped table-sm">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Address</th>
                        <th>Email</th>
                        <th>ProductID</th>
                        <th>Quantity</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php

                        class OrderItem {
                            private $id;

                            public $order_id;

                            public $first_name;

                            public $last_name;

                            public $address;

                            public $country;

                            public $zip;

                            public $email;

                            public $product_id;

                            public $card_issuer;

                            public $card_number;

                            public $cvv;

                            public $qty;

                            function __construct() {
                                $this->order_id = $this->id;
                            }
                        }

                        $ROOT_PATH = $_SERVER['DOCUMENT_ROOT'];
                        include_once $ROOT_PATH . '/inc/CRUD.php';

                        $db = new CRUD();

                        $select = $db->prepare("SELECT * FROM orders");
                        $select->execute();

                        $select->setFetchMode(PDO::FETCH_CLASS, 'OrderItem');
                        $orders = array();

                        while ($order = $select->fetch())
                            array_push($orders, $order);

                        $i = 0;
                        /** @var OrderItem $order_o */
                        foreach ($orders as $order_o) {
                            $i += 1;
                            echo("
				    <tr>
				    <td>$i</td>
					<td>$order_o->first_name</td>
					<td>$order_o->address</td>
					<td>$order_o->email</td>
					<td>$order_o->product_id</td>
					<td>$order_o->qty</td>
					<td><button id='$order_o->order_id' class='btn btn-danger'>Delete</button></td>
					</tr>
					");
                            //echo 'Name: ' . $order_o->first_name;
                        }

                    ?>

                    </tbody>


                </table>
            </div>
        </main>
    </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<!--<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"-->
<!--        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"-->
<!--        crossorigin="anonymous"></script>-->
<!--<script>window.jQuery || document.write('<script src="/js/jquery-slim.min.js"><\/script>')</script>-->
<script src="/js/popper.min.js"></script>
<script src="/js/bootstrap.min.js"></script>
<!-- Icons -->
<script src="https://unpkg.com/feather-icons/dist/feather.min.js"></script>
<script src="/js/deleteOrder.js"></script>
<script>
    feather.replace()
</script>

</body>
</html>
