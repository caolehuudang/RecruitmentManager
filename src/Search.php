<?php 
require_once('../Config/db.php');
$search = $_POST['search'];
$location = $_POST['location'];
if($location == 'null'){
    $sql = mysqli_query($conn,"select * from post where
    name_company = '$search' or title = '$search' or description = '$search' or location = '$location'
    or name_company like '%$search%' or title like '%$search%' or description like '%$search%' 
    ORDER BY id_post desc");
}else if(empty($search)){
    $sql = mysqli_query($conn,"select * from post where
    location = '$location'
    ORDER BY id_post desc");
}else{
    $sql = mysqli_query($conn,"select * from post where
    (name_company = '$search' or title = '$search' or description = '$search'
    or name_company like '%$search%' or title like '%$search%' or description like '%$search%' ) and location = '$location'
    ORDER BY id_post desc");
}

while ($result = mysqli_fetch_array($sql)) {
        ?>
                <div class="uk-card uk-card-default uk-width-1-3@m" style = "margin-bottom:5%">
                    <div class="uk-card-header">
                        <div class="uk-grid-small uk-flex-middle" uk-grid>
                            <div class="uk-width-auto">
                                <img class="uk-border-circle" width="40" height="40" src="../images/<?= $result['image'] ?>">
                            </div>
                            <div class="uk-width-expand">
                                <h3 class="uk-card-title uk-margin-remove-bottom"><?= $result["title"] ?></h3>
                                <p class="uk-text-meta uk-margin-remove-top"><span uk-icon="icon: location"> </span><?= $result["location"] ?></p>
                            </div>
                        </div>
                    </div>
                    <div class="uk-card-body">
                        <p>Yêu Cầu:</p>
                        <p><?= $result["description"] ?></p>
                    </div>
                    <div class="uk-card-footer">
                        <a href = "./JobDetail.php?id_post=<?= $result['id_post'] ?>" class="uk-button uk-button-text">Xem Chi Tiết</a>
                    </div>
                </div>
        <?php
   
}


mysqli_close($conn);
?>