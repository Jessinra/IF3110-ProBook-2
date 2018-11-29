reviewScore = 0;

function fillStar(numStar){
	fullStars = document.getElementsByClassName("review-star-full");
	emptyStars = document.getElementsByClassName("review-star");

	emptyStar();

	for(i = 0; i < numStar; i++){
		emptyStars[i].style.display = "none";
		fullStars[i].style.display = "flex";
	}
}

function emptyStar(){
	fullStars = document.getElementsByClassName("review-star-full");
	emptyStars = document.getElementsByClassName("review-star");

	for(i = 0; i < 5; i++){
		emptyStars[i].style.display = "flex";
		fullStars[i].style.display = "none";
	}
}

function selectStar(numStar){
	removeStarsMouseLeave();
	emptyStar();
	reviewScore = numStar;
	fillStar(numStar);
}

function removeStarsMouseLeave(){
	starDiv = document.getElementsByClassName("star-div");
	for(i = 0; i < 5; i++){
		starDiv[i].removeEventListener("onmouseleave", emptyStar);
		starDiv[i].removeEventListener("onmouseover", fillStar);
	}
}

function submit(){
	String.prototype.trim = function() {
	  return this.replace(/^\s+|\s+$/g,"");
	}

	comment = document.getElementById("comment").value.trim();
	rating = reviewScore;
	book_id = document.getElementById("book-id").value;
	order_id = document.getElementById("order-id").value;

	if(reviewScore == 0){
		alert("tolong berikan nilai review antara 1 hingga 5");
	} else if(comment.trim() == ""){
		alert("tolong berikan comment");
	} else {
		var xhttp = new XMLHttpRequest();
		
		xhttp.open("POST", "/tugasbesar2_2018/Pro-Book/index.php/Review/insert_review", true);
		xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		xhttp.onreadystatechange = function() {
			setTimeout(function(){}, 2000);
			document.getElementById("overlay").style.display = "flex";
	    	document.getElementById("feedback-modal").style.display = "flex";
	    	setTimeout(back, 3000);
		};
		xhttp.send("comment="+comment+"&rating="+rating+"&book_id="+book_id+"&order_id="+order_id);
	}
}

function back(){
	window.location = "http://localhost/tugasbesar2_2018/Pro-Book/index.php/History/index";
}

