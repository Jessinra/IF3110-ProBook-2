window.onload = function () {
    showStars(rating);
};

function showStars(rating) {
    star1 = document.getElementById("star1");
    star2 = document.getElementById("star2");
    star3 = document.getElementById("star3");
    star4 = document.getElementById("star4");
    star5 = document.getElementById("star5");

    if (rating >= 1) {
        star1.src = "/tugasbesar2_2018/Pro-Book/frontend/img_resource/starFull.png";
    }
    if (rating >= 2) {
        star2.src = "/tugasbesar2_2018/Pro-Book/frontend/img_resource/starFull.png";
    }
    if (rating >= 3) {
        star3.src = "/tugasbesar2_2018/Pro-Book/frontend/img_resource/starFull.png";
    }
    if (rating >= 4) {
        star4.src = "/tugasbesar2_2018/Pro-Book/frontend/img_resource/starFull.png";
    }
    if (rating >= 5) {
        star5.src = "/tugasbesar2_2018/Pro-Book/frontend/img_resource/starFull.png";
    }
}


function makeOrder(book_id) {
    let e = document.getElementById("order-quantity");
    let amount = parseInt(e.options[e.selectedIndex].text);

    let xhttp = new XMLHttpRequest();
    let url = "/tugasbesar2_2018/Pro-Book/index.php/Order/orderBook";
    let params = "book_id=" + book_id + "&amount=" + amount;

    xhttp.open("POST", url, true);
    xhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    xhttp.send(params);

    xhttp.onreadystatechange = function () {
        if (xhttp.readyState == 4 && xhttp.status == 200) {
            if (xhttp.responseText == "false") {
                window.location = "http://localhost/tugasbesar2_2018/Pro-Book/index.php/Auth/index"
            }
            document.getElementById("success-message").innerHTML = "<p style='font-weight:bold'>Pesanan berhasil!</p><p>Nomor Transaksi:" + xhttp.responseText + "</p>";
            document.getElementById("overlay").style.display = "flex";
            document.getElementById("feedback").style.display = "block";
            document.getElementById("close-X").addEventListener("click", function () {
                document.getElementById("overlay").style.display = "none";
                document.getElementById("feedback").style.display = "flex";
            });
        }
    }
}