<?php global $activeNavbar;
    $activeNavbar = 1; ?>
<!DOCTYPE HTML>
<html>
<head>
    <script>var rating = <?php echo $result['Rating'] ?> </script>

    <meta content="width=device-width, initial-scale=1" name="viewport"/>
    <link rel="stylesheet" href="/tugasbesar2_2018/Pro-Book/frontend/common_files/grid_system.css">
    <link rel="stylesheet" href="/tugasbesar2_2018/Pro-Book/frontend/common_files/navbar.css">
    <link rel="stylesheet" href="/tugasbesar2_2018/Pro-Book/frontend/book/detail/detail.css">

</head>
<body>
<?php include 'frontend/common_files/navbar.php' ?>
<div class="container" id="content">
    <div class="row" id="first-row">
        <div class="kolom-md-1"></div>
        <div class="kolom-md-10">
            <div class="row book-info">
                <div class="kolom-md-10 display-block info-text-wrapper">
                    <?php echo "<h1 style=\"color: orangered\">" . $result['Title'] . "</h1>" ?>
                    <?php echo "<h5>" . $result['Author'] . "</h5>" ?>
                    <br>
                    <?php 
                        if ($result['Price'] > 0) {
                            echo "<h3 style=\"color: orangered\"> Rp" . $result['Price'] . "</h3>";
                        } else {
                            echo "<h3 style=\"color: orangered\">Not For Sale</h3>";
                        }
                    ?>
                    <?php echo "<p>" . $result['Description'] . "</p>" ?>
                </div>
                <div class="kolom-md-2">
                    <div class="wrapper">
                        <div class="image-wrapper">
                            <?php echo "<img src=" . $result["Thumbnail"] . " class=\"book-thumbnail\"/><img>" ?>
                        </div>
                        <div class="star-wrapper">
                            <img id="star1" class="review-star"
                                 src="/tugasbesar2_2018/Pro-Book/frontend/img_resource/starEmpty.png">
                            <img id="star2" class="review-star"
                                 src="/tugasbesar2_2018/Pro-Book/frontend/img_resource/starEmpty.png">
                            <img id="star3" class="review-star"
                                 src="/tugasbesar2_2018/Pro-Book/frontend/img_resource/starEmpty.png">
                            <img id="star4" class="review-star"
                                 src="/tugasbesar2_2018/Pro-Book/frontend/img_resource/starEmpty.png">
                            <img id="star5" class="review-star"
                                 src="/tugasbesar2_2018/Pro-Book/frontend/img_resource/starEmpty.png">
                        </div>
                        <?php echo "<div class=\"row rating-wrapper\"> " . sprintf("%.1f", $result["Rating"]) . " / 5.0</div>" ?>
                    </div>
                </div>
            </div>


            <div class="row order-row">
                <div class="row">
                    <h2>Order</h2>
                </div>
                <div class="row">
                    <div class="row">
                        <label style="margin-right: 10px;">Jumlah: </label>
                        <select id="order-quantity">
                            <?php
                                for ($i = 1; $i <= 10; $i++) {
                                    ?>
                                    <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                    <?php
                                }
                            ?>
                        </select>
                    </div>
                    <div id="order-btn-div" class="row" style="margin: auto">
                        <?php
                            if ($result["Price"] < 0) {
                                echo "<button disabled id=\"order-btn\">Not For Sale</button>";
                            } else {
                                echo "<button onclick=\"displayModal('otp-modal')\" id='order-btn'>Order</button>";
//                                echo "<button onclick=\"makeOrder('" . $result['ID'] . "')\" id=\"order-btn\">Order</button>";
                            }
                        ?>
                    </div>
                </div>
            </div>


            <div class="row reviews-row">
                <h2>Reviews</h2>
                <!-- sample review -->
                <?php foreach ($reviews as $review) { ?>
                    <div class="row" style="margin-top: 10px;">
                        <div class="kolom-md-1">
                            <!--profile picture -->
                            <!-- <div class="profile-picture-wrapper"> -->
                            <?php echo "<img src = \"" . $review["image_url"] . "\" class=\"profile-picture\">"; ?>
                            <!-- </div> -->
                        </div>
                        <div class="kolom-md-10">
                            <!--review content-->
                            <!-- <div class="review-info-wrapper"> -->
                            <?php echo "<h3>@" . $review["username"] . "</h3>"; ?>
                            <?php echo "<div class=\"row\">" . $review["comment"] . "</div>"; ?>
                            <!-- </div> -->
                        </div>
                        <div class="kolom-md-1">
                            <!--star and review rating -->
                            <div class="review-star-wrapper">
                                <img src="/tugasbesar2_2018/Pro-Book/frontend/img_resource/starFull.png"
                                     class="review-info-star">
                                <div class="row" style="font-weight: bold">
                                    <?php echo sprintf("%.1f", $review["rating"]) ?> / 5.0
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } ?>
                <!-- end of sample review -->
            </div>
            <!-- recommendation -->
            <br>
            <h2>Recommended for you</h2>
            <br>
            <div class="row">
                <div class="kolom-md-2">
                    <img class="img-thumbnail"
                         src=<?php echo $recommendation["Thumbnail"] . " alt=" . $recommendation["Title"] . " label=" . $recommendation["Title"] ?>>
                </div>
                <div class="kolom-md-10 display-block">
                    <?php echo "<h2 class='book-title'>" . $recommendation["Title"] . "</h2>" ?>
                    <?php echo "<h3>" . $recommendation["Author"] . " - " . sprintf("%.1f", $recommendation["Rating"]) . "/5.0 (" . $recommendation["Voters"] . " votes)</h3>" ?>
                    <?php echo "<p>" . $recommendation["Description"] . "</p>" ?>
                    <a href="http://localhost/tugasbesar2_2018/Pro-Book/index.php/Book/detail?id=<?php echo $recommendation["ID"] ?>">
                        <button class="detail-btn">Detail</button>
                    </a>
                </div>
            </div>
        </div>
        <div class="kolom-md-1"></div>
    </div>
</div>


<div id="overlay">
    <div id="feedback-modal">

        <div class="row">
            <div class="kolom-md-12" id="close-button-container">
                <button class="close-button" id="close-feedback-modal-button" onclick="closeModal('feedback-modal')">X</button>
            </div>
        </div>

        <div class="row" style="height:80%">

            <div class="kolom-md-3">
                <img id="checklist" src="/tugasbesar2_2018/Pro-Book/frontend/img_resource/checklist-black.png">
            </div>

            <div class="kolom-md-6">
                <h4 id="success-message"></h4>
            </div>

        </div>
    </div>

    <div id="otp-modal">

        <div class="row">
            <div class="kolom-md-12" id="close-button-container">
                <button class="close-button" id="close-feedback-modal-button" onclick="closeModal('otp-modal')">X</button>
            </div>
        </div>
        <div class="otp-form">
            <form onsubmit="makeOrder('<?= $result['ID'] ?>', getOtpTokenValue())">
                <input title="otp-token-field" id="otp-token-field" type="text">
                <button type="submit" id="order-btn">Order</button>
            </form>
        </div>

    </div>
</div>

<script type="text/javascript" src="/tugasbesar2_2018/Pro-Book/frontend/book/detail/detail.js"></script>
</body>
</html>
