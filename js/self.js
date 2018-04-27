/*For sort Forum Table*/
function sortTable(n){
	var table, rows, switching, i, x, y, shouldSwitch, dir, switchcount=0;
	table=document.getElementById("forum");
	switching=true;
	//set the sorting direction to ascending
	dir="asc";
	/*Make a loop that will continue until no switching has been done*/
	while(switching){
		//start by saying: no switching is done
		switching=false;
		rows=table.getElementsByTagName("TR");
		/*loop through all table rows, except first(header) and last*/
		for(i=1;i<(rows.length-2);i++){
			//start by should no switching
			shouldSwitch=false;
			/*get two compare elements, one from current, one from next */
			x=rows[i].getElementsByTagName("TD")[n];
			y=rows[i+1].getElementsByTagName("TD")[n];
			//check if should switch, based on direction
			if(dir=="asc"){
				if(x.innerHTML.toLowerCase()>y.innerHTML.toLowerCase()){
					//mark switch
					shouldSwitch=true;
					break;
				}
			}
			else if(dir=="desc"){
				if(x.innerHTML.toLowerCase()<y.innerHTML.toLowerCase()){
					//mark switch
					shouldSwitch=true;
					break;
				}
			}
		}//end loop
		if(shouldSwitch){
			//make switch & mark done
			rows[i].parentNode.insertBefore(rows[i+1], rows[i]);
			switching=true;
			//increase count each time switched
			switchcount++;
		}
		else{
			/*if no switching && dir=="asc", change to "desc" & loop*/
			if(switchcount==0 && dir=="asc"){
				dir="desc";
				switching=true;
			}
		}
	}
}	
/*End sort Forum Table*/

/*for enlarge img*/
function enlarge(){
	// Get the modal
	var modal = document.getElementById('enlargeImg');

	// Get the image and insert it inside the modal - use its "alt" text as a caption
	var image = document.getElementById('herbImg');
	var modalImg = document.getElementById("bigImg");
	var captionText = document.getElementById("caption");
    modal.style.display = "block";
    modalImg.src = image.src;
    captionText.innerHTML = image.alt;

	// Get the <span> element that closes the modal
	var span = document.getElementsByClassName("closeImg")[0];

	// When the user clicks on <span> (x), close the modal
	span.onclick = function() { 
	    modal.style.display = "none";
	}
	//escape key close the modal
	document.onkeydown = function(e){
	    e = e || window.event;
	    if(e.keyCode == 27){ //Esc
	        modal.style.display = "none";
	    }
	};
	//outside modal close the modal
	window.onclick = function(e){
		if(e.target == modal){
			modal.style.display ="none";
		}
	}
}
/*End enlarge img*/