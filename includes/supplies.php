<?php
namespace Supply;
require_once ('db.php');
require_once ('common.php');


class showSupplies {
    public $dblink;

    function __construct(){
        global $link;
        $this->dblink = $link;

    }

    function get_supplies ($db, $function="make_table"){
        //$function = '$this->'.$function;
        $sql = "SELECT `supplies`.*, `items`.`item_name`, `suppliers`.`name` AS `supplier_name`

        FROM `supplies`, `suppliers`, `items`

        WHERE (`paid` = 'no'
        AND (`status` != 'cancelled' ||  `status` != 'returned'))
        AND `supplies`.`item_id` = `items`.`id` 
        AND `supplies`.`supplier_id` = `suppliers`.`id`";
        //echo $sql;
        $result = @mysqli_query($db, $sql);
        $response = "";
        while ($rows = @mysqli_fetch_assoc($result)){
            $response .= $this->$function($rows);
        }

        return $response;
    }

    function make_table ($rows){
        if (($rows['supply_type'] == 'prepaid' 
        && $rows['status'] == 'initiated') ||
        ($rows['supply_type'] == 'postpaid' 
        && $rows['status'] == 'supplied')){
            $pay = '<a href="pay.php?supply_id='.$rows['id'].'" target="pay_frame"> 
            <small data-toggle="modal" data-target="#payModal">Pay</small>
            </a>';
        } else {
            $pay = '<small class="text-danger">Pay</small>';
        }




        $row = '
        <tr>
          <td>'.$rows['supplier_name'].'</td>
          <td>'.$rows['quantity_desc'].' of <strong>'.$rows['item_name'].'</strong></td>
          <td>'.$rows['status'].' ('.$rows['supply_type'].')</td>
          <td>N'.number_format($rows['amount'],2,".",",").'</td>
          <td>'.$rows['supply_order_date'].'</td>
          <td>'.$pay.'</td>
        </tr>
        ';
        return $row;
    }
}

class getSupply {
    public $dblink;
    private $supply_id;

    function __construct($supply_id){
        global $link;
        $this->dblink = $link;

        $this->supply_id = addslashes($supply_id);
    }
    
    function get_supply_details ($db){
        $sql = "SELECT `supplies`.*, `items`.`item_name`, `suppliers`.`name` AS `supplier_name`

        FROM `supplies`, `suppliers`, `items`

        WHERE `supplies`.`id` = '$this->supply_id'
        AND `supplies`.`item_id` = `items`.`id` 
        AND `supplies`.`supplier_id` = `suppliers`.`id`";

        $result = @mysqli_query($db, $sql);
        $row = @mysqli_fetch_assoc($result);
        return $row;
    }
}

?>