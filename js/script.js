function navigation(){
	if(document.getElementById('navmenu').style.display=='block'){
		document.getElementById('navmenu').style.display='none';
	}
	else{
		document.getElementById('navmenu').style.display='block';
	}
}
window.onscroll=function(){displayTop()};
function displayTop(){
	if (document.body.scrollTop > 120 || document.documentElement.scrollTop > 120) {
		document.getElementById('top').style.display='block';
	}
	else{
		document.getElementById('top').style.display='none';
	}
}

function goTop(){
	location.href="#header";
}

function alterInput(){
	if(document.sform.searchby.value=="Book Name"){
		document.getElementById('searchTag').innerHTML="Book Name : ";
	}
	if(document.sform.searchby.value=="Author Name"){
		document.getElementById('searchTag').innerHTML="Author Name : ";
	}
}
