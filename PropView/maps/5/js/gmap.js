var lCurrentCenterPhotoIndex = 2;
var lMinCenterPhotoIndex = 2;
var lMaxCenterPhotoIndex = 2;
var radian = Math.PI / 2;
var deltaRadian = Math.PI / 2 * 0.1;
var bMoving = false;

var count_bar_per_step = 5;
var pixel_per_box = 150;

// functions for moving animation
function onClickRight5()
{
	if(!bMoving){
		if (lCurrentCenterPhotoIndex-5 < lMinCenterPhotoIndex) {
			
			if(lCurrentCenterPhotoIndex > lMinCenterPhotoIndex){
				
				acceleratedMoveR(lCurrentCenterPhotoIndex - lMinCenterPhotoIndex);
			}
			lCurrentCenterPhotoIndex = lMinCenterPhotoIndex;
			
		}else{
			lCurrentCenterPhotoIndex = lCurrentCenterPhotoIndex - 5;
			acceleratedMoveR(5);
		}
	}
}

function onClickLeft5()
{
	if (!bMoving){
		if (lCurrentCenterPhotoIndex+5 > lMaxCenterPhotoIndex) {
			
			if(lCurrentCenterPhotoIndex < lMaxCenterPhotoIndex){
				
				acceleratedMoveL(lMaxCenterPhotoIndex - lCurrentCenterPhotoIndex);
			}
			
			lCurrentCenterPhotoIndex = lMaxCenterPhotoIndex;
			
		}else{
			lCurrentCenterPhotoIndex = lCurrentCenterPhotoIndex + 5;
			acceleratedMoveL(5);
		}
	}
}

function onClickRight()
{
	if(!bMoving){
		if (lCurrentCenterPhotoIndex <= lMinCenterPhotoIndex) {
			lCurrentCenterPhotoIndex = lMinCenterPhotoIndex;
		}else{
			lCurrentCenterPhotoIndex = lCurrentCenterPhotoIndex - 1;
			acceleratedMoveR(1);
		}
	}
}

function onClickLeft()
{
	if (!bMoving){
		if (lCurrentCenterPhotoIndex >= lMaxCenterPhotoIndex) {
			lCurrentCenterPhotoIndex = lMaxCenterPhotoIndex;
		}else{
			lCurrentCenterPhotoIndex = lCurrentCenterPhotoIndex + 1;
			acceleratedMoveL(1);
		}
	}
}

function onClickMarker(index){
	if(!bMoving){
		if(index<=lMinCenterPhotoIndex){
			if(lCurrentCenterPhotoIndex>lMinCenterPhotoIndex){
				acceleratedMoveR(lCurrentCenterPhotoIndex - lMinCenterPhotoIndex);
				
				lCurrentCenterPhotoIndex = lMinCenterPhotoIndex;
			}		
			
			
		}else if (index>=lMaxCenterPhotoIndex){
			if(lCurrentCenterPhotoIndex<lMaxCenterPhotoIndex){
				acceleratedMoveL(lMaxCenterPhotoIndex - lCurrentCenterPhotoIndex);
				
				lCurrentCenterPhotoIndex = lMaxCenterPhotoIndex;
			}
			
			
		}else if(index<lCurrentCenterPhotoIndex){
			acceleratedMoveR(lCurrentCenterPhotoIndex - index);
			
			lCurrentCenterPhotoIndex = eval(index);
		}else if(index>lCurrentCenterPhotoIndex){
			acceleratedMoveL(index - lCurrentCenterPhotoIndex);
			
			lCurrentCenterPhotoIndex = eval(index);
		}
	}	
}

function smoothOpacity(e)
{
	var targ;
	if (!e) var e = window.event;
	if (e.target) targ = e.target;
	else if (e.srcElement) targ = e.srcElement;
	if (targ.nodeType == 3) // defeat Safari bug
		targ = targ.parentNode;
	
	var index = targ.getAttribute("index");
	var pointName = targ.getAttribute("photoID");
	
	var img_photo = document.getElementById("img_photo"+pointName);
	
	img_photo.className = "img_hover";
	
}

function clearSmoothOpacity(e)
{
	var targ;
	if (!e) var e = window.event;
	if (e.target) targ = e.target;
	else if (e.srcElement) targ = e.srcElement;
	if (targ.nodeType == 3) // defeat Safari bug
		targ = targ.parentNode;
	
	var index = targ.getAttribute("index");
	var pointName = targ.getAttribute("photoID");
	
	var img_photo = document.getElementById("img_photo"+pointName);
	
	if(pointName==current_select_photo_id){
		img_photo.className = "img_selected";
		
	}else{
		img_photo.className = "img_normal";
	}
}

function acceleratedMoveL(delBox){
	
	var div_slide_bar = document.getElementById("div_slide_bar");
	var left = Number(div_slide_bar.style.left.replace("px",""));
	var delPixel = pixel_per_box * delBox;
	var calculatedPosition = left - delPixel;
	
	if (delBox==1) {
		move_object_quickly("div_slide_bar", delPixel, "-", calculatedPosition);
	} else {
		move_object_slowly("div_slide_bar", delPixel, "-", calculatedPosition);
	}
}

function acceleratedMoveR(delBox){
	var div_slide_bar = document.getElementById("div_slide_bar");
	var left = Number(div_slide_bar.style.left.replace("px",""));
	var delPixel = pixel_per_box * delBox;
	var calculatedPosition = left + delPixel;
	
	if (delBox==1) {
		move_object_quickly("div_slide_bar", delPixel, "+", calculatedPosition);
	} else {
		move_object_slowly("div_slide_bar", delPixel, "+", calculatedPosition);
	}
}

function move_object_slowly(obj_id, delPixel, op, calculatedPosition){
	
	if(op=="-"){
		delPixel = -delPixel;
	}
	
	bMoving = true;
	new Effect.Move (obj_id,{ x: delPixel, y: 0, mode: 'relative', duration: 0.5});
	var t = setTimeout("bMoving = false", 500);
}

function move_object_quickly(obj_id, delPixel, op, calculatedPosition){
	
	if(op=="-"){
		delPixel = -delPixel;
	}

	bMoving = true;
	new Effect.Move (obj_id,{ x: delPixel, y: 0, mode: 'relative', duration: 0.1});
	var t = setTimeout("bMoving = false", 100);
}

