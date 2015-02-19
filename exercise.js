/ I am still working to add description at the bottom of every single image


var count = 1;
var total = 5;  //the total number of images, Obviously you can ammend this 

function slide(x)
{
	var image = document.getElementById('img');
	count+=x;
	if(count > total){count=1;}

	if(count < 1){count = total;}
	image.src = "img" + count + ".jpg";
}

